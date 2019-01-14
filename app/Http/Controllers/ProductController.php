<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products=\App\Product::all();
        $catagories=\App\Catagory::all();
        return view('product.index',compact('products', 'catagories'));
    }
    public function create()
    {
        $catagories=\App\Catagory::all();
        return view('product.create', compact('catagories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'catagory' => 'required',
            'price' => 'required',
        ]);
        $product= new \App\Product;
        $product->title=$request->get('title');
        $product->description=$request->get('description');
        $product->catagory=$request->get('catagory');
        $product->price=$request->get('price');
        $product->amount=1;
        $product->save();
        return redirect()->route('product.index');
    }
    public function show($id)
    {
        $product = \App\Product::find($id);
        return view('product.show',compact('product', 'id'));
    }
    public function edit($id)
    {
        $product = \App\Product::find($id);
        $catagories=\App\Catagory::all();
        return view('product.edit',compact('product', 'catagories', 'id'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'catagory' => 'required',
            'price' => 'required',
        ]);
        $product= \App\Product::find($id);
        $product->title=$request->get('title');
        $product->description=$request->get('description');
        $product->catagory=$request->get('catagory');
        $product->price=$request->get('price');
        $product->save();
        return redirect()->route('product.index');
    }
    public function destroy($id)
    {
        $product = \App\Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
