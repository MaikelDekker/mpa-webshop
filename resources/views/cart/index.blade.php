@extends('layouts.app')

@section('content')
<div class="container">
    <h1 id="title"></h1>

    <h2>Producten in winkelwagen</h2>
    @if($productsInCart != null)
    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>Naam</th>
        <th>Catagorie</th>
        <th>Hoeveelheid</th>
        <th>Prijs</th>
        <th colspan="1">Actie</th>
      </tr>
    </thead>
      <tbody id="cartProducts">
        @foreach($productsInCart as $productInCart)
            <tr>
                <td>{{$productInCart->title}}</td>
                <td>{{$productInCart->catagory}}</td>
                <td><form method="post" action="{{action('CartController@updateCart', $productInCart->id)}}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="number" min="0" name="amount" value="{{$productInCart->amount}}">
                    <button type="submit" class="btn btn-success">Update</button>
                    </form></td>
                <td>${{number_format($productInCart->totalPrice, 2)}} (${{$productInCart->price}} per stuk)</td>
                <td><a href="{{action('CartController@removeFromCart', $productInCart->id)}}" class="btn btn-danger">Verwijderen</a></td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Totale prijs: ${{number_format($totalPrice, 2)}}</td>
            <td><a href="{{action('OrderController@create')}}" class="btn btn-success">Plaats bestelling</a></td>
        </tr>
        @else
        <br><p>Uw winkelwagen is leeg!</p>
        @endif
      </tbody>
    </table>
</div>
@endsection
