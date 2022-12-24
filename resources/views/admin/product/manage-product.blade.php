@extends('admin.master')
@section('title')
    Add Product
@endsection
@section('content')
<main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Products List</h1>
                <div class="mb-4">
                        <a class="btn btn-success btn-sm" href="{{ route('add.product') }}">Add Products</a>
                        <h4>{{ session('massage') }}</h4>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Brand Name</th>
                                <th>Product Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->brand_name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ substr($product->description,0,25) }}</td>
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="" width="100" height="100">
                                </td>
                                <td>{{ $product->status ==1 ? 'Published' : 'Unpublished' }}</td>
                                <td class="d-flex">
                                    <form action="{{ route('edit.product') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button type="submit" class="btn btn-primary btn-sm mx-1">EDIT</button>
                                    </form>
                                    @if($product->status == 1)
                                    <a href="{{ route('status',['id'=>$product->id]) }}" class="btn btn-warning btn-sm mx-1">Unpublished</a>
                                    @else

                                    <a href="{{ route('status',['id'=>$product->id]) }}" class="btn btn-success btn-sm mx-1">Published</a>
                                    @endif
                                    <form action="{{ route('delete.product') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <button type="submit" class="btn btn-danger btn-sm mx-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
@endsection

