<p>
  {{ $title}}  {{ $date->diffForHumans()  }}
  @if ( isset($name) )
    @if (isset($userId))
      <strong class="font-weight-bolder text-dark"> by</strong> <span
        class="font-weight-bolder text-success">
                <a href="{{ route('users.show', ['user'=>$userId]) }}">{{ $name }}</a>
            </span>
    @else
      <strong class="font-weight-bolder text-dark"> by</strong> <span
        class="font-weight-bolder text-success">{{ $name }}</span>
    @endif
  @endif

</p>