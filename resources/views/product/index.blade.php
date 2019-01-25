@extends('layouts.app')

@section('content')
<div class="container">
    <h1 id="title"></h1>

    <h2>Producten</h2><br>
    <p>Filter op categorie</p>
    <select id="productFilter" onchange="FilterProducts('productFilter', '2');">
      <option value="" selected="selected"></option>
      @foreach($catagories as $catagory)
      <option value="{{$catagory->title}}">{{$catagory->title}}</option>
      @endforeach
    </select>

    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>Naam</th>
        <th>Beschrjving</th>
        <th>Categorie</th>
        <th>Prijs</th>
        <th colspan="4">Actie</th>
      </tr>
    </thead>
      <tbody>

          @foreach($products as $product)
          <tr>
            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->catagory}}</td>
            <td>${{$product->price}}</td>

            <td><a href="{{action('CartController@addToCart', $product->id)}}" class="btn btn-warning">Toevoegen aan winkelwagen</a></td>
            <td><a href="{{action('ProductController@show', $product->id)}}" class="btn btn-warning">Show</a></td>
            <td><a href="{{action('ProductController@edit', $product->id)}}" class="btn btn-warning">Edit</a></td>
            <td>
              <form action="{{action('ProductController@destroy', $product->id)}}" method="post">
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
