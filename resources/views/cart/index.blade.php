@extends('layouts.app')

@section('content')
<div class="container">
    <h1 id="title"></h1>

    <h2>Producten in winkelwagen</h2>
    @if($products != null)
    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Catagory</th>
        <th>Amount</th>
        <th>Price</th>
        <th colspan="1">Action</th>
      </tr>
    </thead>
      <tbody id="cartProducts">
        @foreach($products as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->catagory}}</td>
                <td><input type="number" name="amount" value="{{$product->amount}}">
                <a href="{{action('CartController@updateCart', $product['id'])}}" style="margin-left:20px;" class="btn btn-warning">Update</a></td>
                <td>${{$product->price}}</td>
                <td><a href="{{action('CartController@removeFromCart', $product['id'])}}" class="btn btn-danger">Verwijderen</a></td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Totale prijs: ${{$totalPrice}}</td>
            <td><a href="{{action('OrderController@create')}}" class="btn btn-success">Plaats bestelling</a></td>
        </tr>
        @else
        <br><p>Uw winkelwagen is leeg!</p>
        @endif
      </tbody>
    </table>
</div>
@endsection
