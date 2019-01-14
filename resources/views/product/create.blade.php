@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>Product toevoegen</h2><br/>
      <form method="post" action="{{url('product')}}" enctype="multipart/form-data">
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
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Title">Titel:</label>
            <input type="text" class="form-control" name="title">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Description">Beschrijving:</label>
            <input type="text" class="form-control" name="description">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Catagory">Categorie:</label><br>
            <select id="productFilter" name="catagory">
              @foreach($catagories as $catagory)
              <option>{{$catagory->title}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Price">Prijs:</label><br>
            <input type="text" class="form-control" name="price">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  @endsection
