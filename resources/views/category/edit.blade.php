@extends('app')

@section('content')

<div class="col-lg-12">
    <h1 class="my-3">Update Categories</h1>
    <div class="row">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
            </div>
            <button class="btn btn-primary text-center">Update</button>
        </form>
    </div>
    <br>
    <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
