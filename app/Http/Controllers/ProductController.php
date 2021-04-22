<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Product;
use Carbon\Carbon;
use File;

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

        Product::create($this->getProcessedData($request, 'store'));

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        # TODO: implement
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('categories', 'product'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($this->getProcessedData($request, $product->image, 'update'));

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

    public function getProcessedData($request, $productImage = Null, String $action = 'store'){
        $image = $request->image;
        $imagePath = $action === 'store' ? $this->defaultProductImage : $productImage;
        $productName = $request->name;

        if($image){
            if($action === 'update' && ($imagePath != $this->defaultProductImage
                                            && File::exists($imagePath) ))
            {
                File::delete($imagePath);
            }

            $imageName = str_replace(' ', '', $productName).'_'.Carbon::now()->format('d-m-Y');
            $extension = '.'.$image->extension();
            $imagePath = 'storage/'.$image->storeAs('products', $imageName.$extension, 'public');
        }

        return [
            'name' => $productName,
            'image' => $imagePath,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category
        ];
    }
}
