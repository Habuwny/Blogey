@extends('layout')

@section('content')
  <form method="post" enctype="multipart/form-data"
        action="{{ route('users.update', ['user'=>$user->id]) }}"
        class="form-horizontal">
    @csrf
    @method('put')

    <div class="row">
      <div class="col-4">
        <img src="{{ $user->image ? $user->image->url() :''}}" class="img-thumbnail avatar" alt="{{$user->name}} image"/>
        <div class="card mt-4">
          <div class="card-body">
            <h6>Upload a different photo</h6>
            <input class="form-control-file" type="file" name="avatar" />
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="form-group">
          <label>Name: </label>
          <input class="form-control" value="" type="text" name="name">
        </div>


        <x-errors />
        <div class="form-group">
          <label></label>
          <input class="btn btn-primary" value="Save Changes" type="submit">
        </div>

      </div>
    </div>
  </form>
@endsection