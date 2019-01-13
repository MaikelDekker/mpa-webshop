@extends('layouts.app')

@section('content')
<div class="container">
    <h1 id="title"></h1>

    <h2>Orders in db</h2>
    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ordered at</th>
      </tr>
    </thead>
      <tbody id="cartProducts">
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->created_at}}</td>
                <td><a class="btn btn-success" href="{{action('OrderController@show', $order['id'])}}">Bestelde artikelen inzien</a>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endsection
