@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<h1 class="tk-seravek-web">Admin</h1>
<p>Admin page for posting and scheduling site content.</p>
<br/><br/>
<p>
	<strong>Shortcuts:</strong><br/>
	<a href="/api/v1/cleareventcache/{{ env('EVENTBRITE_CALLBACK') }}">Force Eventbrite Sync (Clears all event page caches)</a><br/>
	<a href="/api/v1/clearvideothumbcache/{{ env('EVENTBRITE_CALLBACK') }}">Force Video Thumbnail Sync (Clears latest sermon thumb cache)</a><br/>

	</p>

@endsection