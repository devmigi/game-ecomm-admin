<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSectionItem;
use App\Models\Product;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display all PageSections
     *
     * @return \Illuminate\Http\Response
     */
    public function allSections()
    {
        $pageSections = PageSection::with('page')->get();

        return view('admin.pages.sections.all', ['pageSections' => $pageSections]);
    }

    /**
     * Show the form for adding new PageSection
     *
     * @return \Illuminate\Http\Response
     */
    public function addSection()
    {
        $pages = Page::all();

        return view('admin.pages.sections.add', ['pages' => $pages]);
    }

    /**
     * Save a new Page Section
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveSection(Request $request)
    {
        $pageSection = new PageSection();
        $pageSection->type = $request->type;
        $pageSection->title = trim($request->title);
        $pageSection->page_id = $request->page;
        $pageSection->description = trim($request->description);
        $pageSection->active = true;
        $pageSection->save();

        return redirect()->route('admin.pages.sections')->with('success', 'New Section Added!');
    }


    /**
     * Show the form for editing the Page Section.
     *
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function editSection(PageSection $pageSection)
    {
        $pages = Page::all();

        return view('admin.pages.sections.edit', ['pageSection' => $pageSection, 'pages' => $pages]);
    }


    /**
     * Update the PageSection in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function updateSection(Request $request, PageSection $pageSection)
    {
        $pageSection->type = $request->type;
        $pageSection->title = trim($request->title);
        $pageSection->page_id = $request->page;
        $pageSection->description = trim($request->description);
        $pageSection->save();

        return redirect()->route('admin.pages.sections.edit', ['pageSection' => $pageSection->id])->with('success', 'Page Section Updated!');
    }



    /***********************************************************/

    /**
     * Display all PageSection Items
     *
     * @return \Illuminate\Http\Response
     */
    public function allSectionItems(PageSection $pageSection)
    {
        $pageSection->load('items.image');

        return view('admin.pages.items.all', ['pageSection' => $pageSection]);
    }

    /**
     * Show the form for adding new PageSectionItem
     *
     * @return \Illuminate\Http\Response
     */
    public function addSectionItem(PageSection $pageSection)
    {
        $products = Product::all();
        $categories = Category::all();

        return view('admin.pages.items.add', ['pageSection' => $pageSection, 'products' => $products, 'categories' => $categories]);
    }

    /**
     * Save a new PageSectionItem
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveSectionItem(Request $request, PageSection $pageSection)
    {
        $pageSectionItem = new PageSectionItem();
        $pageSectionItem->page_section_id = $pageSection->id;
        $pageSectionItem->item_type = $request->type;

        if($request->type == 'category' && !empty($request->category)){
            $pageSectionItem->item_id = $request->category;
        }
        else if($request->type == 'product' && !empty($request->product)){
            $pageSectionItem->item_id = $request->product;
        }
        else{
            dd('Item Id not selected');
            exit;
        }


        if ($request->image && $request->file('image')->isValid()) {
            $file = FileService::saveUploadedFile($request->image, 'images/pages');

            $pageSectionItem->image_id = $file->id;
        }
        else if($pageSection->type == 'product_carousel' && !empty($request->product)){
            $product = Product::where('id', $request->product)->with('images')->first();
            $pageSectionItem->image_id =  $product->images[0]->image_id;
        }


        $pageSectionItem->title = $request->title;
        $pageSectionItem->subtitle = $request->subtitle;
        $pageSectionItem->active = true;
        $pageSectionItem->save();

        return redirect()->route('admin.pages.sections.items', ['pageSection' => $pageSection->id])->with('success', 'New Item Added!');
    }


    /**
     * Show the form for editing the Page Section.
     *
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function editSectionItem(PageSection $pageSection, PageSectionItem $pageSectionItem)
    {
        $products = Product::all();
        $categories = Category::all();

        return view('admin.pages.items.edit', [
            'pageSection' => $pageSection,
            'pageSectionItem' => $pageSectionItem,
            'products' => $products,
            'categories' => $categories
        ]);
    }


    /**
     * Update the PageSection in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PageSection  $pageSection
     * @return \Illuminate\Http\Response
     */
    public function updateSectionItem(Request $request, PageSection $pageSection, PageSectionItem $pageSectionItem)
    {
        $pageSectionItem->item_type = $request->type;

        if($request->type == 'category' && !empty($request->category)){
            $pageSectionItem->item_id = $request->category;
        }
        else if($request->type == 'product' && !empty($request->product)){
            $pageSectionItem->item_id = $request->product;
        }

        if ($request->image && $request->file('image')->isValid()) {
            $file = FileService::saveUploadedFile($request->image, 'images/pages');
        }

        if(!empty($file)){
            $pageSectionItem->image_id = $file->id;
        }
        $pageSectionItem->title = $request->title;
        $pageSectionItem->subtitle = $request->subtitle;
        $pageSectionItem->active = $request->active;
        $pageSectionItem->save();

        return redirect()->route('admin.pages.sections.items', ['pageSection' => $pageSection->id])->with('success', 'Section Item Updated!');
    }

}
