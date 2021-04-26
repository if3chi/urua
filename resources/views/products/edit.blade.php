@extends('app')

@section('content')

<div class="col-lg-12">
    <h1 class="my-3">Edit Product</h1>
    @if($errors->any())
        @include('particles.error')
    @endif

    <div class="row">
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control border-info @error('name') border-danger @enderror" name="name"
                    value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control border-info @error('price') border-danger @enderror"
                    name="price" value="{{ $product->price }}" placeholder="$20.99">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea type="text" class="form-control border-info @error('description') border-danger @enderror"
                    placeholder="Product Description" name="description" value="">
                    {{ old('description') ? old('description') : $product->description }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category"
                    class="form-control border-info @error('category') border-danger @enderror">
                    <option value="">Select Category</option>
                    @foreach ($categories as $categroy)
                    <option value="{{ $categroy->id }}" {{ $product->category_id == $categroy->id ? 'selected' : '' }}>
                        {{ $categroy->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Image:</label><br>
                <input type="file" class="" name="image">
            </div>
            <button class="btn btn-primary justify-center">Update</button>
        </form>
    </div>
    <br>
    <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
