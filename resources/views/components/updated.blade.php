<p>
  {{ $title}}  {{ $date->diffForHumans()  }}
  @if ( isset($name) )
    <strong class="font-weight-bolder text-dark"> by</strong> <span
      class="font-weight-bolder text-success">{{ $name }}</span>
  @endif

</p>