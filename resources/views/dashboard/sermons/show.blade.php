@extends('layouts.dashboard.master')

@section('content')

	<h1 class="tk-seravek-web">{{ $sermon->title }}</h1>
  @if ($sermon->series)
    <p><a href="{{ route('series.show', $sermon->series->slug) }}" >{{{ $sermon->series->title or '' }}}</a></p><br/>
  @endif

  <div class="videocontainer">{!! $sermon->iframe !!}</div>
  <p>Text: {!! $sermon->text !!}</p>

  <p>
  @if ($sermon->worksheet != null)
  <a href="{{ $sermon->worksheet }}" class="btn btn-default">Worksheet</a>
  @endif

  @if ($sermon->bulletin != null)
  <a href="{{ $sermon->bulletin }}" class="btn btn-default">Bulletin</a>
  @endif
  </p>

  <p>{!! $sermon->excerpt !!}</p>

  <hr/>

  <div id="transcript">
    {!! $texttrack !!}
  </div>

  @unless($texttrack)
  <p>{!! $sermon->body !!}</p>
  @endunless

  <br/>
    <form action="https://transcribe.compasshb.com/en/videos/create/" method="POST">
    <input type="hidden" name="video_url" value="{{ $sermon->video }}"/>
    <p style="float: right"><input type="submit" value="Transcribe" class="btn btn-default"/></p>
  </form>

  <br/><br/>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title tk-seravek-web">Links</h3>
    </div>
    <div class="panel-body">
      <p><a href="{{ route('series.index') }}">View Sermon Series</a></p><br/>
      <p><a href="https://www.compasshb.com/feed/sermonaudio/">Audio Podcast</a></p>
      <a href="https://itunes.apple.com/us/podcast/compass-hb-sermons/id938965423" target="_blank">
        <img src="{{ URL::to('/') }}/images/Subscribe_on_iTunes_Badge_US-UK_110x40_0824.png"
        width="110" height="40" alt="Subscribe on iTunes"/>
      </a>
      <br/><br/>
      <p><a href="http://feeds.compasshb.com/sermons">Subscribe via Feed</a></p>

      <p><div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button_count"></div></p>

  <p><a href="https://twitter.com/share" class="twitter-share-button" data-via="CompassHB" data-dnt="true">Tweet</a></p>

   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    </div>
  </div>

    @include('layouts.scripts-transcript')

@endsection