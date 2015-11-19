@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">{{ $series->title }}</h1>

  <p>{!! $series->body !!}</p>

  @foreach ($sermons as $sermon)
  <div class="col-md-4">
    <a href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: url({{ $sermon->image }}); background-size: cover; background-position: center center; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('sermons.show', $sermon->slug) }}" >{{ $sermon->title }}</a></h4>
      <p>{{ $sermon->text }}<br/>
      {{ date_format($sermon->published_at, 'l, F j, Y') }}<br/>
      {{ $sermon->teacher }}</p>
    </a>
  </div>
  @endforeach

</div>

@endsection
