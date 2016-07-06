@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">{{ $song->title->rendered }}</h1>

	<div class="videocontainer">
    {!! $song->iframe !!}
  </div>

  @if (isset($song->acf->audio_url))
	<p><a href="{{ $song->acf->audio_url }}" class="btn btn-default">Download MP3</a></p>
  @endif

  <div id="transcript">
    {!! $texttrack !!}
  </div>

  <br/><br/>


  @unless($texttrack)
  <p>{!! $song->content->rendered !!}</p>
  @endunless

    @include('layouts.scripts-transcript')

</div>

@endsection
