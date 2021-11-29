@extends('layout')

@section('content')
  <div class="row">
    <div class="col-8">
      <h1>
        {{ $post->title }}
        @php ( $time = now()->diffInMinutes($post->created_at) < 50)
        <x-badge name="Naw!" type="success" :show="$time"/>
      </h1>
      <p>{{ $post->content }}</p>

      <x-updated :name="$post->user->name" :date="$post->created_at"/>
      <x-updated title="Updated" :date="$post->updated_at"/>
      <x-tags :tags="$post->tags"/>

      <p>Currently read by {{$counter}} people</p>
      <h4>Comments</h4>
      @include('comments._form')

      @forelse($post->comments as $comment)
        <p>
          {{ $comment->content }}
        </p>
        <x-updated :name="$comment->user->name" :date="$comment->created_at"/>
      @empty
        <p>No comments yet!</p>
      @endforelse
    </div>
    <div class="col-4">
      @include('posts._activity')
    </div>
@endsection