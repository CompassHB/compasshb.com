@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<link rel="canonical" href="{{ route('read.show', $passage->slug) }}/" />

  <p>{!! $postflash !!}</p>
  
        <h4>Pray a Psalm a Day Videos</h4>
      <p>Watch the <a href="https://vimeo.com/channels/1364252">videos for Pray Psalm a Day here</a>. Uploaded daily.</p>

  <div class="Setting Box Box--Large Box--bright utility-flex">
    <h1 class="Setting__heading tk-seravek-web">{{ $passage->title->rendered }}</h1>

      {!! $passage->verses !!}

    <hr/>

    <p>
      {{ Lang::choice('passages.daily_sessions_count', $analytics['sessions']) }}
      {{ Lang::choice('passages.active_users_count', $analytics['activeUsers']) }}
    </p>

    <audio src="{{ $passage->audio }}" controls="controls" ></audio><br/>

      <h5 class="tk-seravek-web">This Week</h5>
        <ul>
        @foreach ($passages as $p)
          <li><a href="{{ route('read.show', $p->slug) }}">{{ $p->title->rendered }}</a></li>
        @endforeach
        </ul>
        
      <h4>Pray a Psalm a Day Videos</h4>
      <p>Watch the <a href="https://vimeo.com/channels/1364252">videos for Pray Psalm a Day here</a>. Uploaded daily.</p>

    	@include('dashboard.passages.comments')

    </div>
@endsection
