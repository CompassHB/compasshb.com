@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Sermon Series</h1>

  <?php $i = 0; ?>
  @foreach ($series as $item)
  <div class="col-md-4" {!! ($i % 3) ? '' : 'style="clear: left"' !!}>
    <a href="{{ route('series.show', $item->slug) }}" style="background-image: url({{ $item->slug }}); background-size: cover; width: 200px; height: 125px; display: block; background-position: center center;"></a>
    <a href="{{ route('series.show', $item->slug) }}">
      <h4 class="tk-seravek-web"><a href="{{ route('series.show', $item->slug) }}" >{{ $item->name }}</a></h4></a>
      <p>{!! $item->description !!}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach
  <br style="clear: left"/>
</div>

@endsection
