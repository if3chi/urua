@extends('layouts.app')

@section('content')

<div class="col-lg-12">
    <h1 class="my-3">Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Add New Product</a>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th class="w-25">Image</th>
                    <th>Name</th>
                    <th class="w-25">Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>
                        <div class="rounded">
                            <img src="{{ asset($product->image) }}" alt="product image" width="62" height="62"
                                class="border w-25 mh-25">
                        </div>
                    </td>
                    <td class="align-middle">{{ $product->name }}</td>
                    <td class="align-middle">{{ $product->price }}</td>
                    <td class="align-middle">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
                        {{-- <a href="#" class="btn btn-danger" onclick="document.getElementById('deleteproduct').submit()">Delete</a> --}}
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="deleteproduct"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <input value="Delete" type="submit" class="btn btn-danger"
                                onclick="return confirm('Your are deleting...\nThis product: {{ $product->name }}\nThis cannot be undone, Are sure?')">
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td>No product listed, Create one.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $products->links() }}
        </div>
    </div>
    <br>
    <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
