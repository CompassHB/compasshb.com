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
    <a href='/events/{{ $event->slug }}'
	@if (isset($event->_embedded->{'wp:featuredmedia'}[0]->source_url))
		style="background-image: url({!! $event->_embedded->{'wp:featuredmedia'}[0]->source_url !!}); background-size: cover; width: 200px; height: 125px; display: block;"
	@endif
></a>
      <h4 class="tk-seravek-web">{{ $event->title->rendered }}</h4>
      <p>{{ date("l, F j, Y", strtotime($event->_EventStartDate)) }}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach

  <br style="clear: both"/>

    <div class="panel panel-default">
      <div class="panel-body">
        
      </div>
    </div>

</div>
@endsection

