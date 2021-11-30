@extends('layout')

@section('content')
  <div class="row">
    <div class="col-8">
      @if ($post->image)
        <div
          style="background-image: url('{{ $post->image->url() }}');
            min-height: 500px;
            color: white;
            text-align: center;
            background-attachment: fixed "
        >
          <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
            @else
              <h1>
                @endif
                {{ $post->title }}
                @php ( $time = now()->diffInMinutes($post->created_at) < 50)
                <x-badge name="Naw!" type="success" :show="$time"/>
                @if ($post->image)
              </h1>
        </div>
        @else
        </h1>
      @endif
      <p>{{ $post->content }}</p>
      {{--          <img src="{{ $post->image->url() }}" alt="post-img"/>--}}

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