@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header row no-gutters py-3">
        <div class="col-12 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Page Section Items : <strong class="text-primary">{{ $pageSection->page->name }} | {{ $pageSection->type }}</strong></span>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                @if(count($pageSection->items) > 0)
                    <ul class="list-group list-group-horizontal">
                        @foreach($pageSection->items as $item)
                            <a href="{{ route('admin.pages.sections.items.edit', ['pageSection' => $pageSection->id, 'pageSectionItem' => $item->id]) }}">
                                <li class="list-group-item" style="margin: 10px; {{ !$item->active ? 'opacity:0.3;' : '' }}">
                                    <img src="{{ $item->image->web_url }}" width="100" class="img-responsive">
                                </li>
                            </a>
                        @endforeach

                        <li class="list-group-item" style="margin: 10px">
                            <br><br>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.pages.sections.items.add', ['pageSection' => $pageSection->id]) }}"> Add More</a>
                        </li>
                    </ul>
                @else
                    <div class="p-4 pt-5">No Items in this Section</div>
                    <div class="px-4 pb-5">
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.pages.sections.items.add', ['pageSection' => $pageSection->id]) }}"> Add New Section Item</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->

@endsection


@section('scripts')
@endsection
