@extends('layouts.app')

@section('content')

<div class="col-lg-12">
    <h1 class="my-3">Create Products</h1>
    @if($errors->any())
        @include('particles.error')
    @endif
    <div class="row">
        <form action="{{ route('products.store') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control border-info @error('name') border-danger @enderror" name="name"
                    value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control border-info @error('price') border-danger @enderror"
                    name="price" value="{{ old('price') }}" placeholder="$20.99">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea type="text" class="form-control border-info @error('description') border-danger @enderror"
                    placeholder="Product Description" name="description">
                    {{ old('description')  }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category"
                    class="form-control border-info @error('category') border-danger @enderror">
                    <option value="">Select Category</option>
                    @foreach ($categories as $categroy)
                    <option value="{{ $categroy->id }}" {{ old('category') == $categroy->id ? 'selected' : '' }}>
                        {{ $categroy->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Image:</label><br>
                <input type="file" class="" name="image">
            </div>
            <button class="btn btn-primary justify-center">Create</button>
        </form>
    </div>
    <br>
    <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
