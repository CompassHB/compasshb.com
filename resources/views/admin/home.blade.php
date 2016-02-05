@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h2 class="Setting__heading tk-seravek-web">Administration</h2>

  <p>
  	<strong>Shortcuts:</strong><br/>
  	<a href="/api/v1/cleareventcache/{{ env('EVENTBRITE_CALLBACK') }}">Force Eventbrite Sync (Clears all event page caches)</a><br/>
  	<a href="/api/v1/clearvideothumbcache/{{ env('EVENTBRITE_CALLBACK') }}">Force Video Thumbnail Sync (Clears latest sermon thumb cache)</a><br/>
  </p>

  <h3>New since last login</h3>
  @if (count($posts) > 0)
    @foreach($posts as $post)
      <p>{{ $post->title }} - Published {{ $post->published_at->diffForHumans() }}</p>
    @endforeach
  @else
    <p>Nothing new</p>
  @endif

</div>

@endsection
