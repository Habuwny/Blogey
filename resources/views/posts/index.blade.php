@extends('layout')

@section('content')
  <div class="row">
    <div class="col-8">
      @forelse ($posts as $post)
        <p>
        <h3>
          @if ($post->trashed())
            <del>
              @endif
              <a class="{{ $post->trashed() ? 'text-muted': ''}}"
                 href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
              @if ($post->trashed())
            </del>
          @endif
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

          @if (!$post->trashed())

            @can('delete', $post)
              <form method="POST" class="fm-inline m-1"
                    action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')

                <input type="submit" value="Trash!" class="btn btn-danger"/>
              </form>
            @endcan
          @endif

        </div>
        </p>
      @empty
        <p>No blog posts yet!</p>
      @endforelse
    </div>
    <div class="col-4">
      <div class="container">
        <div class="row">
          <div class="card" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title">Most Commented </h5>
              <h6 class="card-subtitle mb-2 text-muted">What people currently taking about.</h6>
              <ul class="list-group list-group-flush">
                @foreach ( $mostCommented as $item )
                  <li class="list-group-item
               text-success font-weight-bold">
                    <a href="{{ route('posts.show', ['post'=>$post->id]) }}">
                      {{ $item->title }}

                    </a>
                  </li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="card" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title">Most Active </h5>
              <h6 class="card-subtitle mb-2 text-muted">Users with most written posts.</h6>
              <ul class="list-group list-group-flush">
                @foreach ( $mostActive as $item )
                  <li class="list-group-item
               text-success font-weight-bold">
                    {{ $item->name }}
                  </li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="card" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title">Most Active Last Month</h5>
              <h6 class="card-subtitle mb-2 text-muted">Users with most written posts in last month.</h6>
              <ul class="list-group list-group-flush">
                @foreach ( $mosActiveLastMonth as $item )
                  <li class="list-group-item
               text-success font-weight-bold">
                    {{ $item->name }}
                  </li>
                @endforeach

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection('content')