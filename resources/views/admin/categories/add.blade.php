@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Add New Category</span>
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
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="parent">Parent Category</label>
                                    <select id="parent" class="form-control" name="parent">
                                        <option selected value="">NA</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="details">Category Description</label>
                                    <textarea class="form-control" rows="4" id="details" name="details" placeholder="Category Description"></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="keywords">Keywords</label>
                                    <textarea class="form-control" rows="4" id="keywords" name="keywords" placeholder="Keywords"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-small">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="image">Category Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>
                            </div>

                            <div id="image-preview"></div>

                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 px-5">Add Category</button>

        </form>
    </section>

@endsection


@section('scripts')
    <script>

    </script>
@endsection
