@extends('layout')

@section('content')
  <h1>
    {{ $post->title }}
    @php ( $time = now()->diffInMinutes($post->created_at) < 50)
      <x-badge  name="Naw!" type="success" :show="$time"/>
  </h1>
  <p>{{ $post->content }}</p>

  <x-updated :name="$post->user->name" :date="$post->created_at"/>
  <x-updated title="Updated" :date="$post->updated_at"/>
  <p>Currently read by {{$counter}} people</p>
  <h4>Comments</h4>

  @forelse($post->comments as $comment)
    <p>
      {{ $comment->content }}
    </p>
    <x-updated  :date="$comment->created_at"/>
  @empty
    <p>No comments yet!</p>
  @endforelse
@endsection