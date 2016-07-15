@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">

  <h1 class="Setting__heading tk-seravek-web">{{ $series->name }}</h1>

  <p><img src="{{ $series->acf->series_image->url }}" width="300"/><br/>{!! $series->description !!}</p>

  <hr/>

  @foreach ($sermons as $sermon)
  <div class="col-md-4">
    <a href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url }}); background-size: cover; background-position: center center; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('sermons.show', $sermon->slug) }}" >{{ $sermon->title->rendered }}</a></h4>
      <p>{{ $sermon->acf->text }}<br/>
      {{-- date_format($sermon->published_at, 'l, F j, Y') --}}<br/>
      {{ $sermon->_embedded->author[0]->name }}</p>
    </a>
  </div>
  @endforeach

<br style="clear: both"/>

</div>

@endsection
