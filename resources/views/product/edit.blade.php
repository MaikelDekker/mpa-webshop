@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Product bewerken</h2><br  />
      <form method="post" action="{{action('ProductController@update', $id)}}">
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
      <input name="_method" type="hidden" value="PATCH">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="title">Titel</label>
          <input type="text" class="form-control" name="title" value="{{$product->title}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="description">Beschrijving</label>
          <input type="text" class="form-control" name="description" value="{{$product->description}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="catagory">Categorie</label><br>
          <select id="productFilter" name="catagory">
              <option selected="selected">{{$product->catagory}}</option>
              @foreach($catagories as $catagory)
              <option>{{$catagory->title}}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="price">Prijs</label>
          <input type="text" class="form-control" name="price" value="{{$product->price}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4" style="margin-top:60px">
          <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
        </div>
      </div>
    </form>
  </div>
@endsection
