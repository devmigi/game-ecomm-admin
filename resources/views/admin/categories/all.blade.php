@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Categories</span>
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
                            <th scope="col" class="border-0">Name</th>
                            <th scope="col" class="border-0">Slug</th>
                            <th scope="col" class="border-0">Details</th>
                            <th scope="col" class="border-0">Image</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->details }}</td>
                                <td>
                                    @if($category->image)
                                        <a href="{{ asset($category->image->path) }}" target="_blank">
                                            <img src="{{ asset($category->image->path) }}" height="30">
                                        </a>
                                    @else
                                        NA
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">
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
