@extends('layout')

@section('content')
    <h1>Contact</h1>
    <p>Hello this is contact!</p>

    @can('home.secret')
        <a href="{{ route('secret') }}">Go To Special Email</a>
        <h1>Special Contact</h1>
    @endcan
@endsection