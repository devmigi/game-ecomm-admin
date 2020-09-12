@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Add New Page Section</span>
        </div>
    </div>


    <section>
        <form id="add-new-category" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="page">Page Name</label>
                                    <select id="page" class="form-control" name="page" required>
                                        <option value="" selected disabled>Select Page</option>
                                        @foreach($pages as $page)
                                            <option value="{{ $page->id }}">{{ $page->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="type">Section Type</label>
                                    <select id="type" class="form-control" name="type" required>
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="item_slider">Item Slider</option>
                                        <option value="item_grid">Item Grid</option>
                                        <option value="product_carousel">Product Carousel</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="title">Page Section Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Section Title">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="description">Section Description</label>
                                    <textarea class="form-control" rows="4" id="description" name="description" placeholder="Category Description"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-3 px-5">Add Section</button>

        </form>
    </section>

@endsection


@section('scripts')
    <script>

    </script>
@endsection
