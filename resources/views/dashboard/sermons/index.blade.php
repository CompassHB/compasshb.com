@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Sermons</h1>

  <?php $i = 0; ?>
  @foreach ($sermons as $sermon)
  <div class="col-md-4" {!! ($i % 3) ? 'style="margin-top: 20px;"' : 'style="clear: left; margin-top: 20px;"' !!}>
    <a href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url}}); background-size: cover; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('sermons.show', $sermon->slug) }}" >{{ $sermon->title->rendered }}</a></h4>
      <p>{{ $sermon->acf->text or '' }}<br/>
      {{ date('l, F j, Y', strtotime($sermon->date)) }}<br/>
      {{ $sermon->_embedded->author[0]->name }}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach

  <?php // sermons 2 hack
  $i = 0; ?>
  @foreach ($sermons2 as $sermon)
  <div class="col-md-4" {!! ($i % 3) ? 'style="margin-top: 20px;"' : 'style="clear: left; margin-top: 20px;"' !!}>
    <a href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url}}); background-size: cover; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('sermons.show', $sermon->slug) }}" >{{ $sermon->title->rendered }}</a></h4>
      <p>{{ $sermon->acf->text or '' }}<br/>
      {{ date('l, F j, Y', strtotime($sermon->date)) }}<br/>
      {{ $sermon->_embedded->author[0]->name }}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach
  
  <?php // sermons 3 hack
  $i = 0; ?>
  @foreach ($sermons3 as $sermon)
  <div class="col-md-4" {!! ($i % 3) ? 'style="margin-top: 20px;"' : 'style="clear: left; margin-top: 20px;"' !!}>
    <a href="{{ route('sermons.show', $sermon->slug) }}" style="background-image: url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url}}); background-size: cover; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('sermons.show', $sermon->slug) }}" >{{ $sermon->title->rendered }}</a></h4>
      <p>{{ $sermon->acf->text or '' }}<br/>
      {{ date('l, F j, Y', strtotime($sermon->date)) }}<br/>
      {{ $sermon->_embedded->author[0]->name }}</p>
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
        <img src="https://compasshb.smugmug.com/photos/i-2fpjmf5/0/Th/i-2fpjmf5-Th.png"
        width="110" height="40" alt="Subscribe on iTunes"/>
      </a>
      <br/><br/>
      <p><a href="http://feeds.compasshb.com/sermons">Subscribe via Feed</a></p>

      <p><div class="fb-share-button" data-href="{{ URL::to('/') }}" data-layout="button_count"></div></p>

  <p><a href="https://twitter.com/share" class="twitter-share-button" data-via="CompassHB" data-dnt="true">Tweet</a></p>

   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    </div>
  </div>
</div>

@endsection
