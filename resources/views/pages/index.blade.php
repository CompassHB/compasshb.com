@extends('layouts.master')

@section('content')

<div class="drawer row">
  @if($broadcast)
  <div style="width: 75%; margin: 0 auto 10px auto">
    <h2 class="tk-seravek-web" style="float: left; color: #FFF">Live Stream</h2>
    <br style="clear: both"/>
    <div id="boxcast-widget-gnskfahu15wlwpvroe22"></div><script type="text/javascript" charset="utf-8">(function(d, s, c, o) {var js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];var h = (('https:' == document.location.protocol) ? 'https:' : 'http:');js.src = h + '//js.boxcast.com/v3.min.js';js.onload = function() { boxcast.noConflict()('#boxcast-widget-'+c).loadChannel(c, o); };js.charset = 'utf-8';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'gnskfahu15wlwpvroe22', {"showTitle":0,"showDescription":0,"showHighlights":0,"showRelated":false,"defaultVideo":"closest","market":"church","showCountdown":true}));</script>
    <br/>
  </div>
  @endif

  <div class="col-sm-9">
  <div class="Box--shadow--big" style="width: 100%">
    <span class="Box--shadow--wrap">
      <a class="clickable latestsermon" href="{{ route('sermons.show', $sermons[0]->slug) }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $sermons[0]->_embedded->{'wp:featuredmedia'}[0]->source_url or '#' }}); background-position: center;">
      <p
style="position: absolute; text-transform: none; top: -20px; left: 45px; padding: 4px 10px; font-size: 1.1em; background-color: #DD3F2E">Latest Sermon</p>
        <br/><br/>
        <h1 class="tk-seravek-web">{{ $sermons[0]->title->rendered }}</h1>
        <p style="padding: 20px;">{{ $sermons[0]->acf->series->name or '' }}</p>
        <p><i class="material-icons" style="font-size: 3em">play_circle_outline</i></p>
        <div style="position: absolute; bottom: 0; left: 0; text-align: left; padding: 30px; color: #BBB">{{ $sermons[0]->_embedded->author[0]->name }}<br/>{{ $sermons[0]->acf->text }}<br/>{{ date('F j, Y', strtotime($sermons[0]->date)) }}</div>
      </a>
    </span>
  </div>
</div>


  @if($passage)
  <div class="col-sm-3">
  <div class="Box--shadow" style="width: 100%">
    <span class="Box--shadow--wrap">
    <a class="clickable boxer" href="{{ route('read.index') }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $scripture_logo }});">
      <h4 class="tk-seravek-web">{{ $passage->title->rendered }}</h4>
      <p>Scripture of the Day</p>
      </a>
    </span>
  </div>
</div>
  @endif

  @foreach(array_slice($featuredevents, 0,2) as $event)
  <div class="col-sm-3">
  <div class="Box--shadow" style="width: 100%">
    <span class="Box--shadow--wrap">
    <a class="clickable featuredblog boxer" href="/events/{{ $event->slug }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $event->_embedded->{'wp:featuredmedia'}[0]->source_url }});">
      <h4 class="tk-seravek-web">{{ $event->title->rendered }}</h4>
      <p> {{ date("F j", strtotime($event->_EventStartDate)) }}</p>
    </a>
  </span>
</div>
</div>
  @endforeach
</div>

<div class="row commission">
  <div class="col-sm-10 col-sm-offset-1">
    <p>
        <span class="title">Compass HB exists to make disciples of Jesus Christ</span><br/>by
        <span class="participle">reaching</span> as many people as possible for Christ,
        <span class="participle">teaching</span> them to be like Christ, and
        <span class="participle">training</span> them to serve Christ.<br/>
        <a href="{{ route('who-we-are') }}" class="btn btn-default">Find out more about Compass HB</a>
    </p>
  </div>
</div>

{{-- Directions --}}
<div class="row" style="background: none; background-color: #f7f7f7; padding-top: 30px; padding-bottom: 30px;">
  <div class="col-sm-10 col-sm-offset-1">
    <div class="col-md-4 text-center">
      <h2 class="tk-seravek-web">
          Saturdays at 5:00pm <br/>
          Sundays at 9am and 11am
     </h2>
      <br/>
      <p>5082 Argosy Avenue<br/>Huntington Beach, CA 92649</p>
      <br/>
    </div>
    <div class="col-md-4 text-center" style="">
      <h2 class="tk-seravek-web">Directions</h2>
      <br/>
      <a href="https://www.google.com/maps?ll=33.74078,-118.040232&z=10&t=m&hl=en-US&gl=US&mapclient=embed&q=5082+Argosy+Ave+Huntington+Beach,+CA+92649"><img data-src="https://compasshb.smugmug.com/photos/i-WWb58Jn/0/M/i-WWb58Jn-M.png" width="300" height="262" alt="Map to Compass HB" class="lazyload"/></a>
    </div>
    <div class="col-md-4 text-center">
      <h2 class="tk-seravek-web">Midweek</h2>
      <br/>
      <h5>Home Fellowship Groups</h5>
      <p>Tuesday, Wednesday, Thursday, and Friday</p>
      <br/>
      <h5><a href="{{ route('kids') }}#awana">Awana for kids</a></h5>
      <p>Wednesday</p>
      <br/>
      <h5><a href="{{ route('youth') }}">The United for Youth</a></h5>
      <p>Thursday</p>
    </div>
  </div>
</div>


{{-- Parallax --}}
<div class="row">
    <div style="background-image: url(https://compasshb.smugmug.com/photos/i-WMM77kp/0/X3/i-WMM77kp-X3.jpg);padding-top: 250px; background-attachment: fixed; background-position: 50% 0; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-repeat: no-repeat;"></div>
</div>

{{-- Recent Sermons --}}
<div class="row" style="background: none; background-color: #fff; padding-bottom: 20px;">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="{{ route('sermons.index') }}" class="btn btn-default">Sermons</a></h2>
        @foreach($sermons as $sermon)
          <div class="col-sm-6 col-md-3">
          <div class="Box--shadow" style="width: 100%">
            <span class="Box--shadow--wrap">
              <a class="clickable featuredblog boxer" href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url or '#' }});">
                <h4 class="tk-seravek-web">{{ $sermon->title->rendered }}</h4>
                <p> {{ date('F j, Y', strtotime($sermon->date)) }}<br/>{{ $sermon->acf->text }}</p>
                <br/><br/>
              </a>
            </span>
        </div>
    </div>
        @endforeach
    </div>
</div>


{{-- Recent Videos --}}
<div class="row" style="background: none; background-color: #dddddd; padding-bottom: 20px;">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="{{ route('blog.index') }}" class="btn btn-default">Videos</a></h2>

        @foreach($videos as $video)
        <div class="col-sm-6 col-md-6">
        <div class="Box--shadow" style="width: 100%">
          <span class="Box--shadow--wrap">
            <a class="clickable featuredblog boxer" href="{{ route('blog.show', $video->slug) }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $video->_embedded->{'wp:featuredmedia'}[0]->source_url }});">
              <br/><br/>
              <h4 class="tk-seravek-web">{{ $video->title->rendered }}</h4>
              <p> {{ date("F j", strtotime($video->date)) }}</p>
              <br/><br/><br/><br/>
            </a>
          </span>
        </div>
      </div>
        @endforeach

    </div>
</div>

{{-- Photos --}}
<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="http://compasshb.smugmug.com/PhotoArchive" class="btn btn-default">Photos</a></h2>

        @foreach($images as $image)
        <div class="col-md-3" style="padding-bottom: 10px">
            <a href="{{ $image[0] }}"><img data-src="{{ $image[1] }}" class="lazyload" style="height: 175px;" alt="photos.compasshb.com"></a>
        </div>
        @endforeach
    </div>
</div>

{{-- Social Media --}}
<div class="row" style="background: none; background-color: #fff; padding-bottom: 40px;">
  <div class="col-xs-10 col-xs-offset-1">
    <div class="col-md-5">
            <h2 class="tk-seravek-web"><a href="https://www.facebook.com/CompassHB" class="btn btn-default">Facebook</a></h2>
      <div class="fb-like-box" data-href="https://www.facebook.com/CompassHB" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false"></div>
    </div>
    <div class="col-md-7">
        <h2 class="tk-seravek-web"><a href="https://www.twitter.com/compasshb" class="btn btn-default">Tweets</a></h2><br/>
        <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/BradMSmith/lists/compasshb" data-widget-id="566872417012690945" data-chrome="noheader">Tweets from https://twitter.com/BradMSmith/lists/compasshb</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </div>
</div>
<br/><br/>&nbsp;<br/><br/>
</div>

{{-- Instagram --}}
<div class="row" style="background: none; background-color: #fff; padding-bottom: 20px;">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="https://www.instagram.com/compasshb" class="btn btn-default">Instagram</a></h2>

        @foreach($instagrams as $instagram)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <a href="{{ $instagram['link'] }}">
                <img data-src="{{ $instagram['images']['standard_resolution']['url'] }}" class="lazyload" alt="Compass HB Instagram"/>
              </a>
              <p style="padding: 10px">{{ $instagram['caption']['text'] }} </p>
            </div>
        </div>
        @endforeach

    </div>
</div>

@stop
