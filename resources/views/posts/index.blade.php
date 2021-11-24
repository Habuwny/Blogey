@extends('layout')

@section('content')
  @forelse ($posts as $post)
    <p>
    <h3>
      <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
    </h3>
    <p>
      Added {{ $post->created_at->diffForHumans() }}
      <strong class="font-weight-bolder text-dark"> by</strong> <span
        class="font-weight-bolder text-success">{{$post->user->name}}</span>
    </p>

    @if($post->comments_count)
      <p>{{ $post->comments_count }} comments</p>
    @else
      <p>No comments yet!</p>
    @endif

    <div class="d-flex ">
      @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
           class="btn btn-primary m-1">
          Edit
        </a>
      @endcan

      @can('delete', $post)
        <form method="POST" class="fm-inline m-1"
              action="{{ route('posts.destroy', ['post' => $post->id]) }}">
          @csrf
          @method('DELETE')

          <input type="submit" value="Trash!" class="btn btn-danger"/>
        </form>
      @endcan
    </div>
    </p>
  @empty
    <p>No blog posts yet!</p>
  @endforelse
@endsection('content')