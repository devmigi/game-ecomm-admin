@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header row no-gutters py-3">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Products</span>
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
                            <th scope="col" class="border-0">Preview</th>
                            <th scope="col" class="border-0">Product Name</th>
                            <th scope="col" class="border-0">Slug</th>
                            <th scope="col" class="border-0">MRP</th>
                            <th scope="col" class="border-0">Selling Price</th>
                            <th scope="col" class="border-0">Trading Price</th>
                            <th scope="col" class="border-0"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                        @if(!empty($product->images[0]))
                                            <img src="{{ asset($product->images[0]->image->web_url) }}" style="height: 60px;" class="img-thumbnail">
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>{{ $product->slug }}</td>
                                <td>{{ $product->mrp }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->trading_price }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
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
