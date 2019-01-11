<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        session_start();
        $products = request()->session()->get('cart');
        if($products == null || $products == "array(0) { }")
        {
            request()->session()->forget('cart');
        }
        return view('cart.index',compact('products'));
    }
    public function addToCart($id)
    {
        session_start();
        $product = \App\Product::find($id);
        $addedToCart = false;
        $cart = request()->session()->get('cart');
        foreach((object)$cart as $productInCart)
        {
            if($productInCart->id == $id)
            {
                $productInCart->amount++;
                $addedToCart = true;
            }
        }
        if($addedToCart == false)
        {
            request()->session()->push('cart', $product);
        }
        return redirect()->route('product.index');
    }
    public function show($id)
    {

    }
    public function edit($id)
    {

    }
    public function updateCart(Request $request, $id)
    {
        session_start();
        $cart = request()->session()->get('cart');
        foreach((object)$cart as $productInCart)
        {
            if($productInCart->id == $id)
            {
                $productInCart->amount = $amount;
            }
        }
        return redirect('cart');
    }
    public function removeFromCart($id)
    {
        session_start();
        $cart = request()->session()->get('cart');
        foreach((object)$cart as $key => $productInCart)
        {
            if($productInCart->id == $id)
            {
                request()->session()->pull('cart.'.$key, 'default');
            }
        }
        return redirect('cart');
    }
}
