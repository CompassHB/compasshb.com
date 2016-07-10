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
  	<a href="/api/v1/clearvideothumbcache/{{ env('EVENTBRITE_CALLBACK') }}">Force Video Thumbnail Sync (Clears latest sermon thumb cache)</a><br/>
  </p>

</div>

@endsection
