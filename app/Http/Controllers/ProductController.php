<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    private $DEFAULT_IMAGE = 'images/generic.png';

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

        Product::create(
            $this->getProcessedData($request, $this->DEFAULT_IMAGE)
        );

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
        $product->update(
            $this->getProcessedData($request, $product->image)
        );

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

        $this->deleteProductImage($product->image);

        $product->delete();

        return redirect()->route('products.index');
    }

    public function getProcessedData($request, $productImage){
        $image = $request->image;
        $productName = $request->name;

        if($image){

            $this->deleteProductImage($productImage);

            $imageName = str_replace(' ', '', $productName).'-img_'.Carbon::now()->format('d-m-Y');
            $extension = '.'.$image->extension();
            $productImage = 'storage/'.$image->storeAs('products', $imageName.$extension, 'public');
        }

        return [
            'name' => $productName,
            'image' => $productImage,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category
        ];
    }

    public function deleteProductImage(string $productImage){
        if($productImage != $this->DEFAULT_IMAGE && File::exists($productImage))
            {
                File::delete($productImage);
            }
    }
}
