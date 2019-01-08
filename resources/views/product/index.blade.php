@extends('layouts.app')

@section('content')
<div class="container">
    <h1 id="title"></h1>
    
    <p>Filter op catagory</p>
    <select id="productFilter" onchange="FilterProducts('productFilter', '3');">
      <option value="" selected="selected"></option>
      @foreach($catagories as $catagory)
      <option value="{{$catagory->title}}"><?php echo $catagory->title?></option>
      @endforeach
    </select>

    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Catagory</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
      <tbody>
        
          @foreach($products as $product)
          <tr>
            <td>{{$product['id']}}</td>
            <td>{{$product['title']}}</td>
            <td>{{$product['description']}}</td>
            <td>{{$product['catagory']}}</td>
            
            <td><a href="{{action('ProductController@show', $product['id'])}}" class="btn btn-warning">Show</a></td>
            <td><a href="{{action('ProductController@edit', $product['id'])}}" class="btn btn-warning">Edit</a></td>
            <td>
              <form action="{{action('ProductController@destroy', $product['id'])}}" method="post">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <th><a href="{{ route('product.create') }}">Add new product</a></th>
</div>
<script type="text/javascript" src="{{ URL::asset('js/javascript.js') }}"></script>
@endsection
