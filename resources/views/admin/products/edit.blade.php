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

        .product-image > .remove{
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
            <span class="text-uppercase page-subtitle">Edit Product - <strong>{{ $product->name }}</strong></span>
        </div>
    </div>


    <section>

        <div class="row">

            <div class="col-md-8">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="update">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-small">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" placeholder="Product Name" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="category">Category</label>
                                            <select id="category" class="form-control" name="category" required>
                                                <option selected disabled value="">Select Category..</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? "selected" : "" }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="details">Product Description</label>
                                            <textarea class="form-control" rows="5" id="details" name="details" placeholder="Product Description">{{ $product->details }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="keywords">Search Keywords</label>
                                            <textarea class="form-control" rows="3" id="keywords" name="keywords" placeholder="Keywords">{{ $product->keywords }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card card-small">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-lg-4 col-6">
                                            <label for="mrp">MRP <small>(in Rs.)</small></label>
                                            <input type="number" class="form-control" id="mrp" name="mrp" value="{{ $product->mrp ?? '' }}" placeholder="MRP" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="cost_price">Cost Price <small>(in Rs.)</small></label>
                                            <input type="number" class="form-control" id="cost_price" name="cost_price" value="{{ $product->cost_price }}" placeholder="Cost Price" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="selling_price">Selling Price <small>(in Rs.)</small></label>
                                            <input type="number" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" placeholder="Selling Price" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="selling_price_cap">Min. Selling Price Cap<small>(in Rs.)</small></label>
                                            <input type="number" class="form-control" id="selling_price_cap" name="selling_price_cap" value="{{ $product->selling_price_cap }}" placeholder="Selling Price Cap" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="trading_price">Trading Price <small>(in Rs.)</small></label>
                                            <input type="number" class="form-control" id="trading_price" name="trading_price" value="{{ $product->trading_price ?? '' }}" placeholder="Trading Price" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="trading_price_cap">Max. Trading Price Cap <small>(in Rs.)</small></label>
                                            <input type="number" class="form-control" id="trading_price_cap" name="trading_price_cap" value="{{ $product->trading_price_cap ?? '' }}" placeholder="Trading Price Cap" required>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card card-small">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-lg-4 col-6">
                                            <label for="inventory">Inventory</label>
                                            <input type="number" class="form-control" id="inventory" name="inventory" value="{{ $product->inventory }}" placeholder="Inventory" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="inventory_cap">Max. Inventory Cap</label>
                                            <input type="number" class="form-control" id="inventory_cap" name="inventory_cap" value="{{ $product->inventory_cap }}" placeholder="Max. Inventory Cap" required>
                                        </div>

                                        <div class="form-group col-lg-4 col-6">
                                            <label for="available_from">Available From</label>
                                            <input type="date" class="form-control" id="available_from" name="available_from" value="{{ date("Y-m-d", strtotime($product->available_from)) }}" placeholder="Available From" required>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card card-small">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-lg-3 col-6">
                                            <label for="length">Length <small>(in cm.)</small></label>
                                            <input type="text" class="form-control" id="length" name="length" value="{{ $product->length }}" placeholder="Length" required>
                                        </div>

                                        <div class="form-group col-lg-3 col-6">
                                            <label for="width">Width <small>(in cm.)</small></label>
                                            <input type="text" class="form-control" id="width" name="width" value="{{ $product->width }}" placeholder="Width" required>
                                        </div>

                                        <div class="form-group col-lg-3 col-6">
                                            <label for="height">Height <small>(in cm.)</small></label>
                                            <input type="text" class="form-control" id="height" name="height" value="{{ $product->height }}" placeholder="Height" required>
                                        </div>

                                        <div class="form-group col-lg-3 col-6">
                                            <label for="weight">Weight <small>(in grams)</small></label>
                                            <input type="number" class="form-control" id="weight" name="weight" value="{{ $product->weight }}" placeholder="Weight" required>
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
                                            <label for="images">Update Product Image</label>
                                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                                        </div>
                                    </div>

                                    <div id="images-preview">
                                    </div>

                                    <div>
                                        @foreach($product->images as $productImage)
                                            <div class="product-image">
                                                <i class="material-icons remove" data-id="{{ $productImage->id }}" data-product="{{ $product->id }}">highlight_off</i>
                                                <img src="{{ asset($productImage->image->path) }}" class="img-thumbnail">
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-5 px-5">Update Product</button>

                </form>

            </div>

            <div class="col-md-4">
                <div class='card card-small mb-3'>
                    <div class='card-body p-3 pt-4'>
                        <form method="post">
                            @csrf
                            <input type="hidden" name="type" value="live">
                            @if($product->active)
                                <input type="hidden" name="active" value="0">
                                <button type="submit" class="mb-2 btn btn-pill btn-block btn-danger mr-2">
                                    <i class="material-icons mr-1">cloud</i>
                                    Make it Inactive
                                </button>
                            @else
                                <input type="hidden" name="active" value="1">
                                <button type="submit" class="mb-2 btn btn-pill btn-block btn-success mr-2">
                                    <i class="material-icons mr-1">cloud_done</i>
                                    Make It Live
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

                <div class='card card-small mb-3'>
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Product Versions</h6>
                    </div>
                    <div class='card-body p-3 mb-3'>
                        @if(count($versions) > 0)
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="type" value="version">
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <select id="version" class="form-control form-control-lg" name="version" required>
                                            <option selected disabled>Create New Version..</option>
                                            @foreach($versions as $version)
                                                <option value="{{ $version->id }}">{{ $version->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group col-md-5">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <div class="mt-1">
                            @foreach($productVersions as $productVersion)
                                <p class="mb-2 p-2"  style="background: rgba(22, 22, 2, .12)" >
                                    <a href="{{ route('admin.products.edit', ['product' => $productVersion->id]) }}">{{ $productVersion->name }}</a>
                                </p>
                            @endforeach
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </section>

@endsection


@section('scripts')
@endsection
