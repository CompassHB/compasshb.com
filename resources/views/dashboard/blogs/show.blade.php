@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

	@if (empty($blog->video))
	<style>.videocontainer {display: none;}</style>
	@endif

	<h1 class="tk-seravek-web">{{ $blog->title }}</h1>
	<p>{{ $blog->byline }}</p>
	<div class="videocontainer">{!! $blog->iframe !!}</div>


  @if ($blog->video)
    <br/><hr/>
    <h3>Subtitles and Transcripts</h3>
    <p>Select lanaguage:
    @foreach ($languages as $language)
      <a href="/blog/{{ $blog->slug }}/{{ $language }}">{{ $language }}</a>,
    @endforeach
    </p>
    <hr/>
  @endif

  <div id="transcript">
    {!! $texttrack !!}
  </div>

  @unless($texttrack)
  <p>{!! $blog->body !!}</p>
  @endunless

<br/><br/><br/>
  @include('layouts.scripts-transcript')

@endsection
