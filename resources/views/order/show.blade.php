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
        <th>Naam</th>
        <th>Hoeveelheid</th>
        <th>Prijs</th>
      </tr>
    </thead>
      <tbody>
        @foreach($orderProducts as $orderProduct)
            <tr>
                <td>{{$orderProduct->title}}</td>
                <td>{{$orderProduct->amount}}</td>
                <td>${{$orderProduct->price}} (${{number_format(($orderProduct->price / $orderProduct->amount), 2)}} per stuk)</td>
            </tr>
        @endforeach
        <td>Totale prijs: ${{$totalPrice}}</td>
      </tbody>
    </table>
  </div>
<script type="text/javascript" src="{{ URL::asset('js/javascript.js') }}"></script>
@endsection
