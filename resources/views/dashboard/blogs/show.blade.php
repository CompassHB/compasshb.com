@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

  <div class="Setting Box Box--Large Box--bright utility-flex">
    <h1 class="Setting__heading tk-seravek-web">{{ $blog->title->rendered }}</h1>


      <p>{!! $blog->content->rendered !!}</p>


<br/><br/><br/>
  @include('layouts.scripts-transcript')

</div>

@endsection
