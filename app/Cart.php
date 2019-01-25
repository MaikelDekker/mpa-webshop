<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //Get products from session variable 'cart'. If the cart variable(products in cart) is not empty, calculate the total price.
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $totalPrice = 0;
        $productsInCart = request()->session()->get('cart');
        if($productsInCart != null && $productsInCart != "array(0) { }")
        {
            foreach($productsInCart as $productInCart)
            {
                $totalPrice = $totalPrice + ($productInCart->amount * number_format($productInCart->price, 2));
                $productInCart->totalPrice = (number_format($productInCart->price, 2) * $productInCart->amount);
            }
        }
        return array($totalPrice, $productsInCart);
    }
    //Add product to cart if it doesn't exist in the cart yet. If it does exist, add one to the amount.
    public function addToCart($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $product = \App\Product::find($id);
        $addedToCart = false;
        $productsInCart = request()->session()->get('cart');
        if($productsInCart != null && $productsInCart != "array(0) { }"){
            foreach($productsInCart as $productInCart)
            {
                if($productInCart->id == $id)
                {
                    $productInCart->amount++;
                    $addedToCart = true;
                }
            }
        }
        if($addedToCart == false)
        {
            request()->session()->push('cart', $product);
        }
    }
    //Update the cart. Alter product amount according to the entered value in amount input.
    public function updateCart($request, $id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $productsInCart = request()->session()->get('cart');
        foreach($productsInCart as $productInCart)
        {
            if($productInCart->id == $id)
            {
                if($request->amount <= 0 || $request->amount == '')
                {
                    $this->removeFromCart($id);
                }else
                {
                    $productInCart->amount = $request->amount;
                }
            }
        }
    }
    //Remove product from the cart.
    public function removeFromCart($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $productsInCart = request()->session()->get('cart');
        foreach($productsInCart as $key => $productInCart)
        {
            if($productInCart->id == $id)
            {
                request()->session()->pull('cart.'.$key, 'default');
            }
        }
    }
}
