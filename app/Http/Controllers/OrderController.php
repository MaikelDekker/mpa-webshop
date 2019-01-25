<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    //If logged in, then get all orders of the current customer. If not logged in, redirect to login screen.
    public function index()
    {
        if(Auth::check()){
            $orders = \App\Order::where('user_id', Auth::id())->get();
            return view('order.index',compact('orders'));
        }else
        {
            return redirect('login');
        }
    }
    //If logged in, then create a new order, add all products that were in the cart to the order and forget the cart. If not logged in, redirect to login screen.
    public function create()
    {
        if(Auth::check()){
            $order= new \App\Order;
            $order->user_id = Auth::id();
            $order->save();

            $productsInCart = request()->session()->get('cart');
            foreach($productsInCart as $productInCart)
            {
                $orderProduct= new \App\OrderProduct;
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $productInCart->id;
                $orderProduct->title = $productInCart->title;
                $orderProduct->amount = $productInCart->amount;
                $orderProduct->price = number_format($productInCart->price * $productInCart->amount, 2);
                $orderProduct->save();
            }
            request()->session()->forget('cart');
            return redirect()->route('order.show', $order->id);
        }else
        {
            return redirect('login');
        }
    }
    //show order and calculate total price
    public function show($id)
    {
        $orderProducts = \App\OrderProduct::where('order_id', $id)->get();
        $totalPrice = 0;
        foreach($orderProducts as $orderProduct)
        {
            $totalPrice = $totalPrice + $orderProduct->price;
        }
        $totalPrice = number_format($totalPrice, 2);
        return view('order.show',compact('orderProducts', 'totalPrice'));
    }
}
