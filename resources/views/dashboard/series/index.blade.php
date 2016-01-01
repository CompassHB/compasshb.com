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
    <a href="{{ route('series.show', $item->alias) }}" style="background-image: url({{ $item->image }}); background-size: cover; width: 200px; height: 125px; display: block; background-position: center center;"></a>
    <a href="{{ route('series.show', $item->alias) }}">
      <h4 class="tk-seravek-web"><a href="{{ route('series.show', $item->alias) }}" >{{ $item->title }}</a></h4></a>
      <p>{!! $item->body !!}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach
  <br style="clear: left"/>
</div>

@endsection
