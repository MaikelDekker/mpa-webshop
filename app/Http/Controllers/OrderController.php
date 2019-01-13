<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
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
    public function create()
    {
        if(Auth::check()){
            $order= new \App\Order;
            $order->customerID = Auth::id();
            $order->save();

            $cart = request()->session()->get('cart');
            foreach($cart as $productInCart)
            {
                $product= new \App\OrderDetail;
                $product->orderID = $order->id;
                $product->title = $productInCart->title;
                $product->amount = $productInCart->amount;
                $product->price = $productInCart->price * $productInCart->amount;
                $product->save();
            }
            return redirect()->route('product.index');
        }else
        {
            return redirect('login');
        }
    }
    public function store(Request $request)
    {
        $order= new \App\Order;
        $order->save();
        return redirect()->route('order.index');
    }
    public function show($id)
    {
        $order = \App\Order::find($id);
        $orderDetails = \App\OrderDetail::where('OrderID', $id)->get();
        $totalPrice = 0;
        foreach($orderDetails as $orderDetail)
        {
            $totalPrice = $totalPrice + $orderDetail->price;
        }

        return view('order.show',compact('order', 'id', 'orderDetails', 'totalPrice'));
    }
    public function edit($id)
    {
        $order = \App\Order::find($id);
        $catagories=\App\Catagory::all();
        return view('order.edit',compact('order', 'catagories', 'id'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'catagory' => 'required',
        ]);
        $order= \App\Order::find($id);
        $order->title=$request->get('title');
        $order->description=$request->get('description');
        $order->catagory=$request->get('catagory');
        $order->price=$request->get('price');
        $order->save();
        return redirect()->route('order.index');
    }
    public function destroy($id)
    {
        $order = \App\Order::find($id);

        $order->delete();
        return redirect()->route('order.index');
    }
}
