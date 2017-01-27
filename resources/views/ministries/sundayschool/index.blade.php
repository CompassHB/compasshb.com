@extends('layouts.master')

@section('side')
    @include('layouts.side.ministries')
@endsection

@section('content')

<h1 class="tk-seravek-web">Bible Class</h1>
<p>Meets Sundays at 9AM at church for breakfast and teaching.</p><br/>

<h3 class="tk-seravek-web">Current Series: {{ $series[0]->name }}</h3>
<p>{{ $series[0]->description }}</p>
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
        	<td><a href="/sundayschool/messages/{{ $sermon->slug }}">{{ $sermon->title->rendered }}</a></td>
        	<td>{{ $sermon->_embedded->author[0]->name }}</td>
        	<td>{{ date('l, F j, Y', strtotime($sermon->date)) }}</td>
      	</tr>
     @endforeach
    </tbody>
</table>

<br/><br/>
<h3 class="tk-seravek-web">All Bible Class Series</h3>
@foreach ($series as $s)
<div class="col-sm-6 col-md-4" style="height: 300px;">
    <div class="thumbnail" style="width: 310px; height: 150px; background-image: url('{{ $s->acf->series_image->url or '' }}'); background-size: cover; background-position: top center; padding-top: 150px">
    	<div class="caption">
        	<h3><a href="/sundayschool/series/{{ $s->slug }}">{{ $s->name }}</a></h3>
      	</div>
    </div>
</div>
@endforeach

<br style="clear: both"/><br/><br/><br/><br/><br/><br/><br/>
@endsection
