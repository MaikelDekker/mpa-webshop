@extends('layouts.app')

@section('content')
  <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif
    <h2>Artikelen in bestelling</h2>
    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>id</th>
        <th>order</th>
        <th>titel</th>
        <th>amount</th>
        <th>price</th>
      </tr>
    </thead>
      <tbody>
        @foreach($orderDetails as $orderDetail)
            <tr>
                <td>{{$orderDetail->id}}</td>
                <td>{{$orderDetail->orderID}}</td>
                <td>{{$orderDetail->title}}</td>
                <td>{{$orderDetail->amount}}</td>
                <td>${{$orderDetail->price}}</td>
            </tr>
        @endforeach
        <td>Totale prijs: ${{$totalPrice}}</td>
      </tbody>
    </table>
  </div>
<script type="text/javascript" src="{{ URL::asset('js/javascript.js') }}"></script>
@endsection
