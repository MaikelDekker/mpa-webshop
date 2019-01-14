@extends('layouts.app')

@section('content')
  <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif
    <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>Titel</th>
        <th>Beschrijving</th>
        <th>Categorie</th>
        <th>Prijs</th>
      </tr>
    </thead>
      <tbody>
        <tr>
          <td>{{$product->title}}</td>
          <td>{{$product->description}}</td>
          <td>{{$product->catagory}}</td>
          <td>${{$product->price}}</td>
        </tr>
      </tbody>
    </table>
  </div>
<script type="text/javascript" src="{{ URL::asset('js/javascript.js') }}"></script>
@endsection
