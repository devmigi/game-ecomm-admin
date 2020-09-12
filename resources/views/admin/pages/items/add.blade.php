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
                                        @if($pageSection->type == 'product_carousel')
                                            <option value="product" selected>Product</option>
                                        @else
                                            <option value="" selected disabled>Select Type</option>
                                            <option value="product">Product</option>
                                            <option value="category">Category</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group col-md-12 product-selection d-none">
                                    <label for="product">Product</label>
                                    <select id="product" class="form-control" name="product">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 category-selection d-none">
                                    <label for="category">Category</label>
                                    <select id="category" class="form-control" name="category">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="title"> Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="subtitle"> Title</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sub Title">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-group col">
                                <label for="image">Item Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            </div>

                            <div id="image-preview"></div>

                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-3 px-5">Add Section Item</button>

        </form>
    </section>


@endsection


@section('scripts')
    <script>
        var section_type = "{{ $pageSection->type }}";

        $(document).ready(function(){
            if(section_type == 'product_carousel'){
                $('.product-selection').removeClass('d-none');
                $('.category-selection').addClass('d-none');
                $('#image').prop('required',false);
            }

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
