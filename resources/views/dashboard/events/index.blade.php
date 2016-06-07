@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')
<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Events</h1>

    <?php $i = 0; ?>
  @foreach ($events as $event)
  <div class="col-md-4" {!! ($i % 3) ? 'style="margin-top: 20px;"' : 'style="clear: left; margin-top: 20px;"' !!}>
    <a href='/events/{{ $event->id }}/{{ str_slug($event->name->text, "-") }}/' class="btn btn-default" style="float: right"
	@if ($event->logo)
		style="background-image: url({{ $event->logo->url }}); background-size: cover; width: 200px; height: 125px; display: block;"
	@endif
	></a>
      <h4 class="tk-seravek-web">{{ $event->name->text }}</h4>
      <p>{{ date("l, F j, Y", strtotime($event->start->local)) }}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach

  <br style="clear: both"/>

    <div class="panel panel-default">
      <div class="panel-body">
        <p>The schedule of mid-week home fellowship groups is available at the <a href="/fellowship">Fellowship</a> page.</p>
      </div>
    </div>

</div>
@endsection

