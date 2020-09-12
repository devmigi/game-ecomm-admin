<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ADMIN Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified'])->name('admin.')->namespace('Admin')->group(function () {
    Route::get('/profile', function () {
        return view('dashboard');
    });

    /**
     * Categories Routes
     */
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@all')->name('categories');
        Route::get('/add', 'CategoryController@add')->name('categories.add');
        Route::post('/add', 'CategoryController@save');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('categories.edit');
        Route::post('/{category}/edit', 'CategoryController@update');
    });

    /**
     * Products Routes
     */
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@all')->name('products');
        Route::get('/add/{product?}/{version?}', 'ProductController@add')->name('products.add');
        Route::post('/add/{product?}/{version?}', 'ProductController@save');
        Route::get('/{product}/edit', 'ProductController@edit')->name('products.edit');
        Route::post('/{product}/edit', 'ProductController@update');

        Route::delete('/{product}/image/{id}', 'ProductController@removeImage');

//        Route::get('/{product}/add/{version}', 'ProductVersionController@add')->name('products.versionAdd');
//        Route::get('/{product}/version/{id}/edit', 'ProductVersionController@edit');
//        Route::post('/{product}/version/{id}/edit', 'ProductVersionController@update');
    });

    /**
     * Page Management Routes
     */
    Route::prefix('pages')->group(function () {
        // page sections
        Route::get('/sections', 'PageController@allSections')->name('pages.sections');

        Route::get('/sections/add', 'PageController@addSection')->name('pages.sections.add');
        Route::post('/sections/add', 'PageController@saveSection');

        Route::get('/sections/{pageSection}/edit', 'PageController@editSection')->name('pages.sections.edit');
        Route::post('/sections/{pageSection}/edit', 'PageController@updateSection');

        // page section items
        Route::get('/sections/{pageSection}/items', 'PageController@allSectionItems')->name('pages.sections.items');

        Route::get('/sections/{pageSection}/items/add', 'PageController@addSectionItem')->name('pages.sections.items.add');
        Route::post('/sections/{pageSection}/items/add', 'PageController@saveSectionItem');

        Route::get('/sections/{pageSection}/items/{pageSectionItem}/edit', 'PageController@editSectionItem')->name('pages.sections.items.edit');
        Route::post('/sections/{pageSection}/items/{pageSectionItem}/edit', 'PageController@updateSectionItem');
    });



    /**
     * Customer Routes
     */
    Route::prefix('customers')->group(function () {
        Route::get('/', 'CustomerController@all')->name('users');
    });


});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

