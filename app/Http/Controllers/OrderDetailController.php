<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails=\App\OrderDetailController::all();
        return view('orderDetail.index',compact('orderDetails'));
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        $orderDetail= new \App\OrderDetailController;
        $orderDetail->save();
        return redirect()->route('orderDetail.index');
    }
    public function show($id)
    {
        $orderDetail = \App\OrderDetailController::find($id);

        return view('orderDetail.show',compact('orderDetail', 'id'));
    }
    public function edit($id)
    {
        $orderDetail = \App\OrderDetailController::find($id);
        $catagories=\App\Catagory::all();
        return view('orderDetail.edit',compact('orderDetail', 'catagories', 'id'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'catagory' => 'required',
        ]);
        $orderDetail= \App\OrderDetailController::find($id);
        $orderDetail->title=$request->get('title');
        $orderDetail->description=$request->get('description');
        $orderDetail->catagory=$request->get('catagory');
        $orderDetail->price=$request->get('price');
        $orderDetail->save();
        return redirect()->route('orderDetail.index');
    }
    public function destroy($id)
    {
        $orderDetail = \App\OrderDetailController::find($id);

        $orderDetail->delete();
        return redirect()->route('orderDetail.index');
    }
}
