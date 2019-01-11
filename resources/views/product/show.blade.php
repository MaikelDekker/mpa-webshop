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
        <th>Title</th>
        <th>Description</th>
        <th>Catagory</th>
        <th>Prijs</th>
      </tr>
    </thead>
      <tbody>
        <tr>
          <td><?php echo $product->title ?></td>
          <td><?php echo $product->description ?></td>
          <td><?php echo $product->catagory ?></td>
          <td><?php echo $product->price ?></td>
        </tr>
      </tbody>
    </table>
  </div>
<script type="text/javascript" src="{{ URL::asset('js/javascript.js') }}"></script>
@endsection
