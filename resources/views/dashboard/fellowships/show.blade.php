@extends('layouts.master')

@section('side')
    @include('layouts.side.ministries')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">{{ $event->name->text }}</h1>

	<div class="row">
	    <img src='{{ $event->logo->url }}' style="height: 250px;" /><br/><br/>
	    <div class="col-sm-4">
	    	<ul style="list-style: none; margin: 0; padding: 0;">
		    	<li><strong>Hosted by:</strong> {{ $event->organizer_id }}</li>
		    	<li><strong>Venue:</strong> {{ $event->venue_id }}</li>
		    	<li><strong>Start:</strong> {{ date("g:iA", strtotime($event->start->local)) }}</li>
		    	<li><strong>End:</strong> {{ date("g:iA", strtotime($event->end->local)) }}</li>
				<li><br/>
				<a href="http://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}&t={{ $event->name->text }}">Facebook</a>&nbsp;&nbsp;
			    <a href="http://twitter.com/share?text=Compass Bible Church Event: {{ $event->name->text }}&url={{ Request::url() }}&hashtags=compasshb">Twitter</a>&nbsp;&nbsp;
			    <a href="https://plus.google.com/share?url={{ Request::url() }}" onclick="javascript:window.open(this.href,
	  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google</a>&nbsp;&nbsp;
			    <a href="mailto:?subject=Compass Bible Church Huntington Beach: Events {{ $event->name->text }}&body={{ Request::url() }}">Email</a></li>
			</ul>
	    </div>
	    <div class="col-sm-8">
		    <p style="clear: both">{!! $event->description->html !!}</p>

{{-- 		    @if (!$event->ticket_classes[0]->hidden)
		    <p><a href="{{ $event->url }}?ref=ebtnebregn" target="_blank"><img src="https://www.eventbrite.com/custombutton?eid={{ $event->id }}" alt="{{ $event->name->text }}" /></a></p>
		    @endif --}}
	    </div>
    </div>

    <br/><br/>
{{--     <img src="http://maps.google.com/maps/api/staticmap?zoom=11&size=650x150&sensor=false&markers=color:0x497F9B|{{ $event->venue->latitude }},{{ $event->venue->longitude }}" style="width: 650px; height: 150px;" /> --}}

</div>

@endsection
