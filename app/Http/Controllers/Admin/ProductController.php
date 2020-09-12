<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Models\Version;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display all Products
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $products = Product::all();

        return view('admin.products.all', ['products' => $products]);
    }

    /**
     * Show the form for adding new Product
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Product $product = null, Version $version = null)
    {
        if(!empty($product->parent_id)){
            return redirect()->route('admin.products.add', ['product' => $product->parent_id, 'version' => $version->id]);
        }

        if(!$version){
            $version = Version::first();
        }

        $categories = Category::all();

        return view('admin.products.add', ['categories' => $categories, 'copyProduct' => $product, 'version' => $version]);
    }

    /**
     * Save a newly created product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->sku = $request->sku;
        $product->category_id = !empty($request->category) ? $request->category : null;
        $product->version_id = !empty($request->version) ? $request->version : Version::first()->id;
        $product->parent_id = !empty($request->parent_id) ? $request->parent_id : null;
        $product->rating = !empty($request->rating) ? $request->rating : null;

        $product->details = $request->details;
        $product->keywords = $request->name . ', ' .$request->keywords;

        $product->mrp = $request->mrp;
        $product->cost_price = $request->cost_price;
        $product->selling_price = $request->selling_price;
        $product->selling_price_cap = $request->selling_price_cap;
        $product->trading_price = $request->trading_price;
        $product->trading_price_cap = $request->trading_price_cap;

        $product->inventory = $request->inventory;
        $product->inventory_cap = $request->inventory_cap;
        $product->available_from = date("Y-m-d H:i:s", strtotime($product->available_from));

        $product->weight = $request->weight;
        $product->length = $request->length;
        $product->width = $request->width;
        $product->height = $request->height;

        $product->created_by = Auth::id();
        $product->save();

        $productImages = [];
        // add uploaded images
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image){
                $file = FileService::saveUploadedFile($image, 'images/products');

                $productImages[] = new ProductImage(array(
                    'image_id' => $file->id,
                    'type' => 'product',
                    'priority' => 1,
                    'active' => true
                ));
            }
        }
        // copy images from existing selected product
        if ($request->has('copyImages') && is_array($request->copyImages)) {
            foreach ($request->copyImages as $imageId){
                $productImages[] = new ProductImage(array(
                    'image_id' => $imageId,
                    'type' => 'product',
                    'priority' => 1,
                    'active' => true
                ));
            }
        }
        // save images
        if(count($productImages) > 0){
            $product->images()->saveMany($productImages);
        }

        // clear cache
        Cache::forget("products.all");
        Cache::forget("products.{$product->id}");
        Cache::forget("categories.{$product->category_id}.products");

        return redirect()->route('admin.products.edit', ['product' => $product->id])
            ->with('success', 'New Product Created Successfully.');

    }


    /**
     * Show the form for editing the Product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        if($product->parent_id){
            $productVersions = Product::where('parent_id', $product->parent_id)->orWhere('id', $product->parent_id)->get();
        }
        else{
            $productVersions = Product::where('parent_id', $product->id)->orWhere('id', $product->id)->get();
        }
        $versions = Version::whereNotIn('id', $productVersions->pluck('version_id'))->get();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'versions' => $versions,
            'productVersions' => $productVersions
        ]);
    }

    /**
     * Update the product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($request->type == 'live'){
            $product->active = $request->active;
            $product->save();
        }
        else if($request->type == 'version'){
            $parentProductId = ($product->parent_id) ? $product->parent_id : $product->id;
            return redirect()->route('admin.products.add', ['product' => $parentProductId, 'version' => $request->version]);
        }
        else if($request->type == 'update'){
            $product->name = $request->name;
            $product->details = $request->details;
            $product->keywords = $request->keywords;
            $product->category_id = !empty($request->category) ? $request->category : $product->category_id;

            $product->mrp = $request->mrp;
            $product->cost_price = $request->cost_price;
            $product->selling_price = $request->selling_price;
            $product->selling_price_cap = $request->selling_price_cap;
            $product->trading_price = $request->trading_price;
            $product->trading_price_cap = $request->trading_price_cap;

            $product->inventory = $request->inventory;
            $product->inventory_cap = $request->inventory_cap;
            $product->available_from = date("Y-m-d H:i:s", strtotime($request->available_from));

            $product->weight = $request->weight;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;

            $product->updated_by = Auth::id();
            $product->save();

            $productImages = [];
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image){
                    $file = FileService::saveUploadedFile($image, 'images/products');

                    $productImages[] = new ProductImage(array(
                        'image_id' => $file->id,
                        'type' => 'product',
                        'priority' => 1,
                        'active' => true
                    ));
                }

                // save images
                $product->images()->saveMany($productImages);
            }
        }

        Cache::forget("products.all");
        Cache::forget("products.{$product->id}");
        Cache::forget("categories.{$product->category_id}.products");

        return redirect()->route('admin.products.edit', ['product' => $product->id])
            ->with('success', 'Product details updated.');
    }


    public function removeImage($productId, $imageId){
        // $deleted = ProductImage::where('product_id', $productId)->where('id', $imageId)->delete();

        $productImage = ProductImage::where('product_id', $productId)->where('id', $imageId)->with('image')->first();
        $imagePath = $productImage->image->path;

        $deleted = $productImage->delete();

        if($deleted){
            try{
                Storage::delete($imagePath);
            }
            catch(\Exception $e){
                // unable to delete file from storage
            }

            $res = array(
                'success' => $deleted,
                'message' => 'deleted',
                'data' => null
            );
        }


        return response()->json($res);
    }

}
