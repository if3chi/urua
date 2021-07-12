@extends('layouts.base')

@section('content')

<div class="col-lg-12">
    <h1 class="my-3">Create Categories</h1>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="row">
        <form action="{{ route('categories.store') }}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <button class="btn btn-primary text-center">Save</button>
        </form>
    </div>
    <br>
    <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
