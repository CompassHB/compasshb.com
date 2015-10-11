@extends('layouts.master')

@section('content')

<div class="drawer row">
  @if($broadcast)
  <div style="width: 75%; margin: 0 auto 10px auto">
    <h2 class="tk-seravek-web" style="float: left; color: #FFF">Live Stream</h2>
    <br style="clear: both"/>
    <div id="boxcast-widget-{{$broadcast->channel_id}}"></div>
    <script src="https://assets.boxcast.com/widget.js" 
            data-action="boxcast-widget-load"
            data-handle="{{$broadcast->channel_id}}"
            data-options="version=3"
            async>
    </script>
    <br/>
  </div>
  @endif

  <div class="col-sm-9" style="padding: 0; background-color: #E5E4E2; margin-bottom: 11px">
    <div style="padding: 6px; background-color: #555;">
      <a class="clickable latestsermon" href="{{ route('sermons.show', $prevsermon->slug) }}" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $prevsermon->othumbnail }}); background-position: center;">
      <p
style="position: absolute; text-transform: none; top: -13px; right: 55px; padding: 4px 10px; font-size: 1.1em; background-color: #DD3F2E">Latest Sermon</p>
        <br/><br/>
        <h1 class="tk-seravek-web">{{ $prevsermon->title }}</h1>
        <p style="padding: 20px;">{{{ $prevsermon->series->title or '' }}}</p>
        <p><i class="glyphicon glyphicon-play-circle large-icon"></i></p>
        <div style="position: absolute; bottom: 0; left: 0; text-align: left; padding: 20px; color: #BBB">{{ $prevsermon->teacher }}<br/>{{ $prevsermon->text }}<br/>{{ $prevsermon->published_at->format('F j, Y') }}</div>
      </a>
    </div>
  </div>

  @if($passage)
  <div class="col-sm-3" style="margin: 0px 0px 11px 0px">
    <a class="clickable" href="{{ route('read.index') }}" style="display: block; text-transform: uppercase; color: #fff; padding: 10px;   border: 1px #555 solid; width: 100%; height: 132px; background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(https://compasshb.smugmug.com/photos/i-3BJkBgb/0/S/i-3BJkBgb-S.jpg); background-size: cover; background-position: center">
      <h4 class="tk-seravek-web">{{ $passage->title }}</h4>
      <p>Scripture of the Day</p>
    </a>
  </div>
  @endif

  @foreach(array_slice($fevents, 0,2) as $event)
  <div class="col-sm-3"  style="margin: 10px 0px">
    <a class="clickable featuredblog" href="/events/{{ $event->id }}/{{ str_slug($event->name->text, "-") }}/" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url({{ $event->logo->url }});">
      <h4 class="tk-seravek-web">{{ $event->name->text }}</h4>
      <p> {{ date("F j", strtotime($event->start->local)) }}</p>
    </a>
  </div>
  @endforeach
</div>

<div class="row" style="background-color: #497f9e; padding: 0 0 15px 0; border-top: 3px solid #F9F9F9">
  <div class="col-sm-10 col-sm-offset-1">
    <center>
    <h3 style="color: #FFF; text-align: center; margin-bottom: 5px" class="tk-seravek-web">Compass HB exists to make disciples of Jesus Christ</h3>
    <p style="color: #FFF; font-size: 1.25em">by <strong>reaching</strong> as many people as possible for Christ, <strong>teaching</strong> them to be like Christ, and <strong>training</strong> them to serve Christ.</p><br/>
    <p><a href="{{ route('who-we-are') }}" class="btn btn-default">Find out more about Compass HB</a></p>
    </center>
  </div>
</div>

{{-- Directions --}}
<div class="row" style="background: none; background-color: #f7f7f7; padding-top: 30px; padding-bottom: 30px;">
  <div class="col-sm-10 col-sm-offset-1">
    <div class="col-md-4 text-center">
      <h2 class="tk-seravek-web">Sundays at<br/> 9am and 11am</h2>
      <br/>
      <p>5082 Argosy Avenue</p>
      <p>Huntington Beach, CA 92649</p>
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
      <h4><a href="{{ route('fellowship.index') }}">Home Fellowship Groups</a></h4>
      <p>Tuesday, Wednesday, Thursday, and Friday</p>
      <br/>
      <h4><a href="{{ route('kids') }}#awana">Awana for kids</a></h4>
      <p>Wednesday</p>
      <br/>
      <h4><a href="{{ route('youth') }}">The United for Youth</a></h4>
      <p>Thursday</p>
    </div>
  </div>
</div>


{{-- Parallax --}}
<div class="row">
    <div style="background-image: url(https://compasshb.smugmug.com/PhotoArchive/Worship-Services/1st-Service-New-Building-01111/i-KLP4pcT/2/X2/150111_Wor_SS-093-X2.jpg);padding-top: 250px; background-attachment: fixed; background-position: 50% 0px; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-repeat: no-repeat;"></div>
</div>

{{-- Recent Sermons --}}
<div class="row" style="background: none; background-color: #fff; padding-bottom: 20px;">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="{{ route('sermons.index') }}">Sermons</a></h2>
        @foreach($sermons as $sermon)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img data-src="{{ $sermon->othumbnail }}" class="lazyload" alt="{{ $sermon->title }}"/>
                <div class="caption">
                    <h4>{{ $sermon->title }}</h4>
                    <p><small>{{ date_format($sermon->published_at, 'F j, Y') }}</small><br/>
                    {{ $sermon->text }}</p>
                    <p><a href="{{ route('sermons.show', $sermon->slug) }}" class="btn btn-primary" role="button">Watch</a></p>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <center><span class="glyphicon {{ $distinctives[0]['icon'] }}" style="font-size: 5em; padding: 25px;"></span></center>
                <div class="caption">
                    <h4>{{ $distinctives[0]['text'] }}</h4><br/>
                    <p><a href="{{ route('distinctives') }}" class="btn btn-primary" role="button">Our Eight Distinctives</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Recent Videos --}}
<div class="row" style="background: none; background-color: #dddddd; padding-bottom: 20px;">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="{{ route('blog.index') }}">Videos</a></h2>

        @foreach($videos as $video)
        <div class="col-sm-6 col-md-6">
            <div class="thumbnail">
                <img data-src="{{ $video->othumbnail }}" class="lazyload" alt="{{ $video->title }}"/>
                <div class="caption">
                    <h4>{{ $video->title }}</h4>
                    <p><small>{{ date_format($video->published_at, 'F j, Y') }}</small></p>
                    <p><a href="{{ route('blog.show', $video->slug) }}" class="btn btn-primary" role="button">Watch</a></p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

{{-- Photos --}}
<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="{{ route('photos') }}">Photos</a></h2>

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
            <h2 class="tk-seravek-web"><a href="https://www.facebook.com/CompassHB">Facebook</a></h2>
      <div class="fb-like-box" data-href="https://www.facebook.com/CompassHB" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false"></div>
    </div>
    <div class="col-md-7">
        <h2 class="tk-seravek-web"><a href="https://www.twitter.com/compasshb">Tweets</a></h2><br/>
        <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/BradMSmith/lists/compasshb" data-widget-id="566872417012690945" data-chrome="noheader">Tweets from https://twitter.com/BradMSmith/lists/compasshb</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    </div>
</div>
<br/><br/>&nbsp;<br/><br/>
</div>

{{-- Instagram --}}
<div class="row" style="background: none; background-color: #fff; padding-bottom: 20px;">
    <div class="col-xs-10 col-xs-offset-1">
        <h2 class="tk-seravek-web"><a href="https://www.instagram.com/compasshb">Instagram</a></h2>

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
