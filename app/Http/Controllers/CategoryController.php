<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => ucwords($request->name)
            ]);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category =  Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => ucwords($request->name)
        ]);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
