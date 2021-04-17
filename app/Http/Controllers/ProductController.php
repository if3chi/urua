<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Product;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{

    public $defaultProductImage = 'images/generic.png';

    public function index()
    {
        $products = Product::latest()->paginate(3);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $image = $request->image;
        $imagePath = $this->defaultProductImage;
        $productName = $request->name;

        if($image){
            $date = Carbon::now()->format('d-m-Y');
            $imageName = str_replace(' ', '', $productName).'_'.$date;
            $extension = '.'.$image->extension();
            $imagePath = 'storage/'.$image->storeAs('products', $imageName.$extension, 'public');
        }

        Product::create([
            'name' => $productName,
            'image' => $imagePath,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category
        ]);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('categories', 'product'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $image = $request->image;
        $imagePath = $product->image;
        $productName = $request->name;

        if($image){
            if($imagePath != $this->defaultProductImage && File::exists($imagePath) )
            {
                $deleted = File::delete($imagePath);
            }

            $date = Carbon::now()->format('d-m-Y');
            $imageName = str_replace(' ', '', $productName).'_'.$date;
            $extension = '.'.$image->extension();
            $imagePath = 'storage/'.$image->storeAs('products', $imageName.$extension, 'public');
        }

        $product->update([
            'name' => $productName,
            'image' => $imagePath,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $productImage = $product->image;

        if($productImage != $this->defaultProductImage && File::exists($productImage)){
            File::delete($productImage);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
