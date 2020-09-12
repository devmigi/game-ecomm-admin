@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')

    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Edit Page Section - <strong class="text-primary">{{ $pageSection->page->name }} | {{ $pageSection->type }}</strong></span>
        </div>
    </div>


    <section>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-small">
                    <div class="card-body">

                        <form id="add-new-category" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="page">Page Name</label>
                                    <select id="page" class="form-control" name="page" required>
                                        <option value="" selected disabled>Select Page</option>
                                        @foreach($pages as $page)
                                            <option value="{{ $page->id }}"  {{ ($page->id == $pageSection->page_id) ? "selected" : "" }}>{{ $page->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="type">Section Type</label>
                                    <select id="type" class="form-control" name="type" required>
                                        <option value="item_slider"  {{ ($pageSection->type == 'item_slider') ? "selected" : "" }}>Item Slider</option>
                                        <option value="item_grid" {{ ($pageSection->type == 'item_grid') ? "selected" : "" }}>Item Grid</option>
                                        <option value="product_carousel" {{ ($pageSection->type == 'product_carousel') ? "selected" : "" }}>Product Carousel</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="title">Page Section Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $pageSection->title }}" placeholder="Section Title">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="description">Section Description</label>
                                    <textarea class="form-control" rows="4" id="description" name="description" placeholder="Category Description">{{ $pageSection->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-primary mt-3 px-5">Save Section</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="page-subtitle">
                    <span class="text-uppercase">Section Items</span>
                    <span class="float-right">
                        <a href="{{ route('admin.pages.sections.items.add', ['pageSection' => $pageSection->id]) }}" class="btn btn-primary btn-sm">
                            <i class="material-icons md-light">note_add</i> Add
                        </a>
                    </span>
                </div>


                <ul class="list-group">
                    @foreach($pageSection->items as $item)
                        <a href="{{ route('admin.pages.sections.items.edit', ['pageSection' => $pageSection->id, 'pageSectionItem' => $item->id]) }}">
                            <li class="list-group-item">{{ $item->item_type }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>

        </div>

    </section>

@endsection


@section('scripts')
    <script>

    </script>
@endsection

