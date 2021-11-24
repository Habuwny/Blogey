@extends('layout')
@section('content')
  <form method="post" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
      <label for="" id="">Name</label>
      <input name="name" value="{{ old('name') }}" required class="form-control{{ $errors->has('name')
              ? ' is-invalid':'' }}">
      @if ($errors->has('name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Email</label>
      <input name="email" value="{{ old('email') }}"
             required class="form-control {{ $errors->has('email') ? ' is-invalid':'' }}">
      @if ($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label for="" id="">Password</label>
      <input type="password" name="password" required class="form-control {{ $errors->has('password')
              ? ' is-invalid':'' }}"
      >
      @if ($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label for="" id="">Confirm Password</label>
      <input type="password" name="password_confirmation" required class="form-control">
{{--      @if ($errors->has('password'))--}}
{{--        <span class="invalid-feedback">--}}
{{--            <strong>{{ $errors->first('password') }}</strong>--}}
{{--          </span>--}}
{{--      @endif--}}
    </div>

    <button type="submit" class="btn btn-primary">Register</button>

  </form>
@endsection
