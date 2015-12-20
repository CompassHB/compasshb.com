@extends('layouts.master')

@section('side')
    @include('layouts.side.ministries')
@endsection

@section('content')

<h1 class="tk-seravek-web">Sunday School</h1>
<p>Meets Sundays at 9AM at church for breakfast and teaching.</p><br/>

<h3class="tk-seravek-web">Current Series: {{ $series->first()->title }}</h3>
<p>{{ $series->first()->body }}</p>
<table class="table table-striped">
	<thead>
    	<tr>
        	<th>Title</th>
        	<th>Teacher</th>
        	<th>Date</th>
      	</tr>
    </thead>
    <tbody>
    @foreach ($sermons as $sermon)
      	<tr>
        	<td><a href="{{ route('sermons.show', $sermon->slug) }}">{{ $sermon->title }}</a></td>
        	<td>{{ $sermon->teacher }}</td>
        	<td>{{ date_format($sermon->published_at, 'l, F j, Y') }}</td>
      	</tr>
     @endforeach
    </tbody>
</table>

<h3 class="tk-seravek-web">All Sunday School Series</h3>
@foreach ($series as $s)
<div class="col-sm-6 col-md-4" style="height: 300px;">
    <div class="thumbnail" style="width: 310px; height: 150px; background-image: url('{{ $s->image }}'); background-size: cover; background-position: top center; padding-top: 150px">
    	<div class="caption">
        	<h3><a href="{{ route('series.show', $s->slug) }}">{{ $s->title }}</a></h3>
        	<p>{{ $s->body }}</p>
      	</div>
    </div>
</div>
@endforeach

<br style="clear: both"/><br/><br/><br/><br/><br/><br/><br/>
@endsection
