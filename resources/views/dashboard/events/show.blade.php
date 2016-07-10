@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">{{ $events->title->rendered }}</h1>

    <h4>{{ date("l F j, Y", strtotime($events->date)) }}</h4><br/><br/>

	<div class="row">
		@if (isset($events->_embedded->{'wp:featuredmedia'}[0]->source_url))
	    <img src='{{ $events->_embedded->{'wp:featuredmedia'}[0]->source_url }}' style="height: 250px;" /><br/><br/>
	    @endif
	    <div>
		    <p style="clear: both">{!! $events->content->rendered !!}</p>
	    </div>
		<div>
			{{--	    	@if (!$event->ticket_classes[0]->hidden)
		    <p><a href="{{ $event->url }}?ref=ebtnebregn" target="_blank" class="btn btn-warning">Click Here to Register</a></p>
		    @endif --}}
			<ul style="list-style: none; margin: 0; padding: 0;">
				{{--	<li><strong>Hosted by:</strong> {{ $event->organizer->name }}</li>
                    <li><strong>Venue:</strong> {{ $event->venue->name }}</li>
                    <li><strong>Start:</strong> {{ date("g:iA", strtotime($event->start->local)) }}</li>
                    <li><strong>End:</strong> {{ date("g:iA", strtotime($event->end->local)) }}</li> --}}
				<li><br/>
					<a href="http://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}&t={{ $events->title->rendered }}">Facebook</a>&nbsp;&nbsp;
					<a href="http://twitter.com/share?text=Compass Bible Church Event: {{ $events->title->rendered }}&url={{ Request::url() }}&hashtags=compasshb">Twitter</a>&nbsp;&nbsp;
					<a href="https://plus.google.com/share?url={{ Request::url() }}" onclick="window.open(this.href,
	  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google</a>&nbsp;&nbsp;
					<a href="mailto:?subject=Compass Bible Church Huntington Beach: Events {{ $events->title->rendered }}&body={{ Request::url() }}">Email</a></li>
			</ul>

		</div>
    </div>

    <br/><br/>
{{--     <img src="http://maps.google.com/maps/api/staticmap?zoom=11&size=650x150&sensor=false&markers=color:0x497F9B|{{ $event->venue->latitude }},{{ $event->venue->longitude }}" style="width: 650px; height: 150px;" /> --}}

</div>

@endsection
