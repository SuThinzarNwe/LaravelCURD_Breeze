@extends('students.layout')
@section('content')

@if (Session::has('success'))
<div class="alert alert-success">
  {{Session::get('success')}}<br><br>
  @php
  Session::forget('success');
  @endphp
</div>
@endif
<div class="container w-75">
  <div class="card mt-5">
    <div class="card-header bg-success-subtle">Edit Page</div>
    <div class="card-body">
      <!-- <form action="{{ url('/studentEdit/' .$student->id) }}" method="post" enctype="multipart/form-data"> -->
      <form action="{{ route('students.update',$student->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group">
              <strong>Name:</strong>
              <input type="text" name="name" value="{{ $student->name }}" class="form-control" placeholder="Name">
              @if($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
              <br>
              <br>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group">
              <strong>Image:</strong>
              <input type="file" name="image" class="form-control" placeholder="image" value="{{$student->image}}">
              @if($errors->has('image'))
              <span class="text-danger">{{ $errors->first('image') }}</span>
              @endif
              <br>
              <img src=" {{asset('storage/images/'.$student->image)}}" alt="Student Image" class="img-fluid img-thumbnail w-25">
              <br>
              <br>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 mb-3">

            <div class="form-group">
              <strong>Place:</strong>
              <select name="place_id" class="block w-full mt-1 rounded-md form-control" value="{{ $student->place->name }}>
                <option value=" {{$student->place->name}} ">Select Place</option>
                @foreach ($places as $place)
                <option value=" {{$place->id}}">{{$place->name}}</option>
                @endforeach
              </select>
              @if($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
              <br>
              <br>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group">
              <strong>Category:</strong>
              <label><strong>Select Category :</strong></label><br />
              <select name="cat[]" class="block w-full mt-1 rounded-md form-control" value="" id="example-getting-started" multiple="multiple">
                @foreach ($categories as $category)
                <option name="cat[]" value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
              @error('category_id')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
              @if($errors->has('name'))
              <span class=" text-danger">{{ $errors->first('name') }}</span>
              @endif
              <br>
              <br>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endSection