<?php

namespace App\Http\Controllers;

use App\Catagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
    public function index()
    {
        $catagories=\App\Catagory::all();
        return view('catagory.index',compact('catagories', 'catagories'));
    }
    public function create()
    {
        return view('catagory.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $catagory= new \App\Catagory;
        $catagory->title=$request->get('title');
        $catagory->save();       
        return redirect()->route('catagory.index');
    }
    public function show($id)
    {
        $catagory = \App\Catagory::find($id);

        return view('catagory.show',compact('catagory', 'id'));
    }
    public function edit($id)
    {
        $catagory = \App\Catagory::find($id);
        return view('catagory.edit',compact('catagory','id'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $catagory= \App\Catagory::find($id);
        $catagory->title=$request->get('title');
        $catagory->save();
        return redirect()->route('catagory.index');
    }
    public function destroy($id)
    {
        $catagory = \App\Catagory::find($id);

        $catagory->delete();
        return redirect()->route('catagory.index');
    }
}
