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
        <img src="{{ $song->thumbnail }}" alt="{{ $song->title }}"/>
        <div class="caption">
          <h5 class="tk-seravek-web">{{ $song->title }}</h5>
          <p>{{ $song->excerpt }}<br/><a href="{{ route('songs.show', $song->slug) }}" class="btn btn-default" role="button">Listen</a></p>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title tk-seravek-web">Audio Player</h3>
    </div>
    <div class="panel-body">
      <div id="myElement"></div>
    </div>
  </div>
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
            <span class="glyphicon glyphicon-expand"></span>
        @else
        <a href="#" class="list-group-item">
        @endif
            <strong>{{ $song['title'] }}</strong><br/>
            <small>{{ $song['author'] }}</small><br/>
        </a>
    @endforeach
    </ol>
</div>

<script src="//jwpsrv.com/library/jA0rDsOIEeS9zw4AfQhyIQ.js"></script>
<script>
    jwplayer("myElement").setup({
        playlist: "{{ route('feed.songs.xml') }}",
        width: 500,
        height: 30,
        autostart: true,
        repeat: true,
    });
</script>

</div>

@endsection
