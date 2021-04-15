@extends('app')

@section('content')

<div class="col-lg-12">
    <h1 class="my-3">Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">Create New Category</a>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
                            {{-- <a href="#" class="btn btn-danger" onclick="document.getElementById('deleteCategory').submit()">Delete</a> --}}
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" id="deleteCategory" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <input value="Delete" type="submit" class="btn btn-danger" onclick="return confirm('Your are deleting...\nCategory: {{ $category->name }}\nThis cannot be undone, Are sure?')">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center">No Category listed, Create one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br>
    <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
