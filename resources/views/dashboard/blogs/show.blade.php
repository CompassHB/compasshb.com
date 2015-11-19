@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

	@if (empty($blog->video))
	<style>.videocontainer {display: none;}</style>
	@endif

  <div class="Setting Box Box--Large Box--bright utility-flex">
    <h1 class="Setting__heading tk-seravek-web">{{ $blog->title }}</h1>

	<p>{{ $blog->byline }}</p>
	<div class="videocontainer">{!! $blog->iframe !!}</div>


  @if ($languages)
    <p>Choose your language:
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

</div>

@endsection
