<p>
  @foreach ($tags as $item)
    <a href="{{ route('posts.tags.index', ['tag'=>$item->id]) }}"
       class="badge badge-success badge-lg ">{{ $item->name }}</a>
  @endforeach
</p>