@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Page Sections</span>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">

                <div class="card-body p-0 pb-3 text-left">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Page</th>
                            <th scope="col" class="border-0">Type</th>
                            <th scope="col" class="border-0">Title</th>
                            <th scope="col" class="border-0">Description</th>
                            <th scope="col" class="border-0">Active</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($pageSections as $pageSection)
                            <tr>
                                <td>{{ $pageSection->id }}</td>
                                <td>{{ $pageSection->page->name }}</td>
                                <td>
                                    <a href="{{ route('admin.pages.sections.items', ['pageSection' => $pageSection->id]) }}">
                                        {{ $pageSection->type }}
                                    </a>
                                </td>

                                <td>{{ $pageSection->title }}</td>
                                <td>{{ $pageSection->description }}</td>

                                <td>
                                    @if($pageSection->active)
                                        <span>Enabled</span>
                                    @else
                                        <span>Disabled</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.pages.sections.edit', ['pageSection' => $pageSection->id]) }}">
                                        <i class="material-icons md-light">edit</i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->

@endsection


@section('scripts')
@endsection
