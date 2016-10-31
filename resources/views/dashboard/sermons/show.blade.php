@extends('layouts.master')

@section('side')
@include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
    <h1 class="Setting__heading tk-seravek-web">{{ $sermon->title->rendered }}</h1>

    @if ($sermon->acf->series)
    <p><a href="/series/men/{{ $sermon->acf->series->slug }}" >{{{ $sermon->acf->series->name or '' }}}</a></p><br/>
    @endif

    <!-- div class="videocontainer"></div -->
    <p>
    @if ($sermon->acf != null)
            Text: {!! $sermon->acf->text !!} |
        @endif
        <a href="{{  Request::url() }}/download.mp4">Download</a> | <a href="{{ $sermon->acf->worksheet->url or '#' }}">Worksheet</a></p>
    <div>{!! $sermon->content->rendered !!}</div>



    <br/><br/><br/>
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

            <p><div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button_count"></div></p>

            <p><a href="https://twitter.com/share" class="twitter-share-button" data-via="CompassHB" data-dnt="true">Tweet</a></p>

            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        </div>
    </div>

    @include('layouts.scripts-transcript')

</div>

@endsection
