<div class="card" style="width: 100%;">
  <div class="card-body">
    <h5 class="card-title">{{ $title}}</h5>
    <h6 class="card-subtitle mb-2 text-muted">
      {{ $subtitle }}
    </h6>
    <ul class="list-group list-group-flush">
      @if ( $link )
        @foreach ( $items as $item )
          <li class="list-group-item">
            <a href="{{ route('posts.show', ['post'=>$item->id])}}">
              {{ $item->title }}
            </a>
          </li>
        @endforeach
      @else
        @foreach ( $items as $item )
          <li class="list-group-item">
            {{ $item->name }}
          </li>
        @endforeach
      @endif

    </ul>
  </div>
</div>
