@extends('layouts.dashboard.master')

@section('content')

	<h1 class="tk-seravek-web">Sermons</h1>

  <?php $i = 0; ?>
  @foreach ($sermons as $sermon)
  <div class="col-md-4" {!! ($i % 3) ? 'style="margin-top: 20px;"' : 'style="clear: left; margin-top: 20px;"' !!}>
    <a href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: url({{ $sermon->image }}); background-size: cover; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('sermons.show', $sermon->slug) }}" >{{ $sermon->title }}</a></h4>
      <p>{{ $sermon->text }}<br/>
      {{ date_format($sermon->published_at, 'l, F j, Y') }}<br/>
      {{ $sermon->teacher }}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach

  <br style="clear: both"/>

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

      <p><div class="fb-share-button" data-href="{{ URL::to('/') }}" data-layout="button_count"></div></p>

  <p><a href="https://twitter.com/share" class="twitter-share-button" data-via="CompassHB" data-dnt="true">Tweet</a></p>

   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    </div>
  </div>

@endsection