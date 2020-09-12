<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display all Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $categories = Category::with('image')->get();

        return view('admin.categories.all', ['categories' => $categories]);
    }

    /**
     * Show the form for adding new Category
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $categories = Category::all();

        return view('admin.categories.add', ['categories' => $categories]);
    }

    /**
     * Save a newly created Category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        if ($request->file('image')->isValid()) {
            $file = FileService::saveUploadedFile($request->image, 'images/categories');
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->details = $request->details;
        $category->keywords = $request->keywords;

        $category->image_id = !empty($file) ? $file->id : null;
        $category->parent_id = !empty($request->parent) ? $request->parent : null;
        $category->created_by = Auth::id();
        $category->save();

        // clear cache
        Cache::forget("categories.all");

        return redirect()->route('admin.categories')->with('success', 'New Category Added!');
    }


    /**
     * Show the form for editing the Category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('admin.categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the Category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->has('image')) {
            $file = FileService::saveUploadedFile($request->image, 'images/categories');
            $category->image_id =  $file->id;
        }

        $category->name = $request->name;
        // $category->slug = Str::slug($request->name, '');
        $category->details = $request->details;
        $category->keywords = $request->keywords;
        $category->parent_id = !empty($request->parent) ? $request->parent : null;
        $category->updated_by = Auth::id();

        $category->save();

        // clear cache
        Cache::forget("categories.all");
        Cache::forget("categories.{$category->id}");

        return redirect()->route('admin.categories.edit', ['category' => $category->id])->with('success', 'Category Updated!');
    }

}
