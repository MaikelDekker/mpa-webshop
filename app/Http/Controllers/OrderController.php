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
            $orders = \App\Order::where('customerID', Auth::id())->get();
            return view('order.index',compact('orders'));
        }else
        {
            return redirect('login');
        }
    }
    //If logged in, then create a new order and add all products that were in the cart to the order. If not logged in, redirect to login screen.
    public function create()
    {
        if(Auth::check()){
            $order= new \App\Order;
            $order->customerID = Auth::id();
            $order->save();

            $productsInCart = request()->session()->get('cart');
            foreach($productsInCart as $productInCart)
            {
                $orderProduct= new \App\OrderProduct;
                $orderProduct->orderID = $order->id;
                $orderProduct->title = $productInCart->title;
                $orderProduct->amount = $productInCart->amount;
                $orderProduct->price = $productInCart->price * $productInCart->amount;
                $orderProduct->save();
            }
            return redirect()->route('order.show', $order->id);
        }else
        {
            return redirect('login');
        }
    }
    public function show($id)
    {
        $orderProducts = \App\OrderProduct::where('OrderID', $id)->get();
        $totalPrice = 0;
        foreach($orderProducts as $orderProduct)
        {
            $totalPrice = $totalPrice + $orderProduct->price;
        }
        return view('order.show',compact('orderProducts', 'totalPrice'));
    }
}
