<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductValidation;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products|max:255',
            'price' => 'required',
            'description' => 'required',
        ]);
        
        $product = new Product;
        
        $product->name = $request->json()->get('name');
        $product->price = $request->json()->get('price');
        $product->description = $request->json()->get('description');
        
        $product->save();

        return response()->json($product);
    }
    
    public function show($id)
    {
        $produc = Product::find($id);

        return response()->json($produc);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'unique:products,name,' . $id,
        ]);
        
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return response()->json('The product was removed successfully');
    }
}