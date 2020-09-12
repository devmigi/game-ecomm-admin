@extends('admin.layouts.app')

@section('styles')
    <style>
        #images-preview img{
            width: 120px;
            margin: 5px 10px;
        }

        .product-image{
            position: relative;
            display: inline-block;
            width: 120px;
            margin: 5px 10px;
        }

        .product-image > .remove-temp{
            position: absolute;
            top:-5px;
            right: -5px;
            color: #ff0000;
            font-size: 1.2em;
            background: #fff;
            border-radius: .6em;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Add New Product</span>
        </div>
    </div>


    <section>
        <form id="add-new-category" method="post" enctype="multipart/form-data">
            @csrf

            @if($copyProduct)
                <input type="hidden" name="parent_id" value="{{ $copyProduct->id }}">
                <input type="hidden" name="rating" value="{{ $copyProduct->rating }}">
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($copyProduct->name) ? $copyProduct->name . ' ' . $version->name : '' }}" placeholder="Product Name" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="version">Version</label>
                                    <select id="version" class="form-control" name="version" required>
                                        <option value="{{ $version->id }}" selected>{{ $version->name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sku">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{ isset($copyProduct->sku) ? strtoupper($copyProduct->sku .'-'. substr($version->name, 0, 3)) : '' }}" placeholder="SKU" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category">Category</label>
                                    <select id="category" class="form-control" name="category" required>
                                        <option selected disabled value="">Select Category..</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (isset($copyProduct->category_id) && $category->id == $copyProduct->category_id) ? "selected" : "" }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="details">Product Description</label>
                                    <textarea class="form-control" rows="5" id="details" name="details" placeholder="Product Description">{{ $copyProduct->details ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="keywords">Search Keywords</label>
                                    <textarea class="form-control" rows="3" id="keywords" name="keywords" placeholder="Keywords">{{ $copyProduct->keywords ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="images">Product Image</label>
                                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple {{ ($copyProduct) ? '' : 'required' }}>
                                </div>
                            </div>

                            <div id="images-preview"></div>

                            @if($copyProduct)
                                <div>
                                    @foreach($copyProduct->images as $productImage)
                                        <div class="product-image">
                                            <i class="material-icons remove-temp" data-id="{{ $productImage->id }}" data-product="{{ $copyProduct->id }}">highlight_off</i>
                                            <img src="{{ asset($productImage->image->path) }}" class="img-thumbnail">
                                            <input type="hidden" name="copyImages[]" value="{{ $productImage->image_id }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-4 col-6">
                                    <label for="mrp">MRP <small>(in Rs.)</small></label>
                                    <input type="number" class="form-control" id="mrp" name="mrp" value="{{ $copyProduct->mrp ?? '' }}" placeholder="MRP" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="cost_price">Cost Price <small>(in Rs.)</small></label>
                                    <input type="number" class="form-control" id="cost_price" name="cost_price" placeholder="Cost Price" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="selling_price">Selling Price <small>(in Rs.)</small></label>
                                    <input type="number" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="selling_price_cap">Min. Selling Price Cap<small>(in Rs.)</small></label>
                                    <input type="number" class="form-control" id="selling_price_cap" name="selling_price_cap" placeholder="Selling Price Cap" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="trading_price">Trading Price <small>(in Rs.)</small></label>
                                    <input type="number" class="form-control" id="trading_price" name="trading_price" value="{{ $copyProduct->trading_price ?? '' }}" placeholder="Trading Price" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="trading_price_cap">Max. Trading Price Cap <small>(in Rs.)</small></label>
                                    <input type="number" class="form-control" id="trading_price_cap" name="trading_price_cap" value="{{ $copyProduct->trading_price_cap ?? '' }}" placeholder="Trading Price Cap" required>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-4 col-6">
                                    <label for="inventory">Inventory</label>
                                    <input type="number" class="form-control" id="inventory" name="inventory" placeholder="Inventory" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="inventory_cap">Max. Inventory Cap</label>
                                    <input type="number" class="form-control" id="inventory_cap" name="inventory_cap" placeholder="Max. Inventory Cap" required>
                                </div>

                                <div class="form-group col-md-4 col-6">
                                    <label for="available_from">Available From</label>
                                    <input type="date" class="form-control" id="available_from" name="available_from" value="{{ isset($copyProduct->available_from) ? date("Y-m-d", strtotime($copyProduct->available_from)) : date("Y-m-d") }}" placeholder="Available From" required>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-3 col-6">
                                    <label for="length">Length <small>(in cm.)</small></label>
                                    <input type="text" class="form-control" id="length" name="length" value="{{ $copyProduct->length ?? '' }}" placeholder="Length" required>
                                </div>

                                <div class="form-group col-md-3 col-6">
                                    <label for="width">Width <small>(in cm.)</small></label>
                                    <input type="text" class="form-control" id="width" name="width" value="{{ $copyProduct->width ?? '' }}" placeholder="Width" required>
                                </div>

                                <div class="form-group col-md-3 col-6">
                                    <label for="height">Height <small>(in cm.)</small></label>
                                    <input type="text" class="form-control" id="height" name="height" value="{{ $copyProduct->height ?? '' }}" placeholder="Height" required>
                                </div>

                                <div class="form-group col-md-3 col-6">
                                    <label for="weight">Weight <small>(in grams)</small></label>
                                    <input type="number" class="form-control" id="weight" name="weight" value="{{ $copyProduct->weight ?? '' }}" placeholder="Weight" required>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-3 mb-5 px-5">Add Product</button>

        </form>
    </section>

@endsection


@section('scripts')
    <script>

    </script>
@endsection
