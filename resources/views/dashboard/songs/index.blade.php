@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')
<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Worship Songs</h1>

<p>Original worship songs from Compass HB.</p>

<div class="row">
  @foreach ($songs as $song)
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{{ isset($song->_embedded->{'wp:featuredmedia'}[0]->source_url) ? $song->_embedded->{'wp:featuredmedia'}[0]->source_url : '' }}" alt="{{ $song->title->rendered }}"/>
        <div class="caption">
          <h5 class="tk-seravek-web">{{ $song->title->rendered }}</h5>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="row">
    <ol class="list-group">
    @if(isset($setlist[0]))
        <a href="#" class="list-group-item disabled">
            <h4 class="list-group-item-heading">Last Week's Songs</h4>
            <p>{{ \Carbon\Carbon::parse($setlist[0]['date'])->format('l, F d') }}</p>
        </a>
    @endif
    @foreach($setlist as $song)
        @if (isset($song['link']))
        <a href="{{ $song['link'] }}" class="list-group-item">
            <i class="material-icons">expand_more</i>
        @else
        <a href="#" class="list-group-item">
        @endif
            <strong>{{ $song['title'] }}</strong><br/>
            <small>{{ $song['author'] }}</small><br/>
        </a>
    @endforeach
    </ol>
</div>

</div>

@endsection
