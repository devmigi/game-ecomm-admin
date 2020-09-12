@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Add Section Item : <strong class="text-primary">{{ $pageSection->page->name }} | {{ $pageSection->type }}</strong></span>
        </div>
    </div>


    <section>
        <form id="add-new-category" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-7">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="type">Item Type</label>
                                    <select id="type" class="form-control" name="type" required>
                                        <option value="" disabled>Select Type</option>
                                        @if($pageSection->type == 'product_carousel')
                                            <option value="product" selected>Product</option>
                                        @else
                                            <option value="product" {{ ($pageSectionItem->item_type == 'product') ? "selected" : "" }}>Product</option>
                                            <option value="category" {{ ($pageSectionItem->item_type == 'category') ? "selected" : "" }}>Category</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group col-md-12 product-selection {{ ($pageSectionItem->item_type == 'product') ? "" : "d-none" }}">
                                    <label for="product">Product</label>
                                    <select id="product" class="form-control" name="product">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ ($pageSectionItem->item_type == 'product' && $pageSectionItem->item_id == $product->id) ? "selected" : "" }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 category-selection {{ ($pageSectionItem->item_type == 'category') ? "" : "d-none" }}">
                                    <label for="category">Category</label>
                                    <select id="category" class="form-control" name="category">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($pageSectionItem->item_type == 'category' && $pageSectionItem->item_id == $category->id) ? "selected" : "" }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="title"> Title</label>
                                    <input type="text" class="form-control" id="title" value="{{ $pageSectionItem->title }}" name="title" placeholder="Title">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="subtitle"> Title</label>
                                    <input type="text" class="form-control" id="subtitle" value="{{ $pageSectionItem->subtitle }}" name="subtitle" placeholder="Sub Title">
                                </div>

                                <div class="form-group col-md-12">
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="radio1">
                                            <input type="radio" class="form-check-input" id="radio1" name="active" value="1"  {{ ($pageSectionItem->active) ? "checked" : "" }}>Active
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="radio2">
                                            <input type="radio" class="form-check-input" id="radio2" name="active" value="0"  {{ (!$pageSectionItem->active) ? "checked" : "" }}>Inactive
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-group col">
                                <label for="image" id="image-edit">Item Image <i class="material-icons remove" >edit</i></label>
                                <input type="file" class="d-none" id="image" name="image" accept="image/*" >
                            </div>

                            <div id="image-preview">
                                @if($pageSectionItem->image)
                                    <img src="{{ asset($pageSectionItem->image->path) }}" style="max-height: 300px" class="img-thumbnail">
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-3 px-5">Save Section Item</button>

        </form>
    </section>


@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#type').on('change', function() {
                if(this.value == 'product'){
                    $('.product-selection').removeClass('d-none');
                    $('.category-selection').addClass('d-none');
                }
                else if(this.value == 'category'){
                    $('.product-selection').addClass('d-none');
                    $('.category-selection').removeClass('d-none');
                }
                else{
                    $('.product-selection').addClass('d-none');
                    $('.category-selection').addClass('d-none');
                }
            });

        });

    </script>
@endsection
