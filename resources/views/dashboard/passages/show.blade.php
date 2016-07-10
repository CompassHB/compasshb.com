@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<link rel="canonical" href="{{ route('read.show', $passage->slug) }}/" />

  <p>{!! $postflash !!}</p>

  <div class="Setting Box Box--Large Box--bright utility-flex">
    <h1 class="Setting__heading tk-seravek-web">{{ $passage->title->rendered }}</h1>

      {!! $passage->verses !!}

      <strong>Bible Overview</strong><br/>{!! $passage->content->rendered !!}

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

    	@include('dashboard.passages.comments')

    </div>
@endsection
