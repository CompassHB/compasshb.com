@extends('layouts.master')

@section('side')
    @include('layouts.side.ministries')
@endsection

@section('content')
<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Home Fellowship Groups</h1>

<br/><p>We want every adult in our church to be  part of a home fellowship group! We have groups Tuesday, Wednesday, Thursday and Friday nights ready for you to join! Stop by the Compass Connect table for more information or email info@compasshb.com</p><br/>

<div class="row">
  @foreach ($hfg as $group)
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="{{ $group->logo->url }}" alt="{{ $group->name->text }}"/>
        <div class="caption">
          <h5 class="tk-seravek-web">
            <a href='/fellowship/{{ $group->id }}/{{ str_slug($group->name->text, "-") }}/'>{{ $group->name->text }}</a>
          </h5>
          <p>Next meeting: {{ date("F j", strtotime($group->start->local)) }}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title tk-seravek-web">About</h3>
  </div>
  <div class="panel-body">
    <p>Worksheet questions are designed for the application of this week's sermon. Take some time to thoughtfully write out the answers. It is also helpful to discuss in a home fellowship group. If you would like more information on a home fellowship group, email info@compassHB.com.</p>
    <p><a href="mailto:info@compasshb.com" class="btn btn-primary"><i class="material-icons">email</i>  Sign Up</a></p>
  </div>
</div>

<br/>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Latest Sermon and Worksheet</h3>
  </div>
  <div class="panel-body">
    <p>The materials on this page are to help you prepare for home fellowship group discussions.</p>
    <p><a href="{{ route('sermons.index') }}" class="btn btn-primary">Latest Sermon</a></p>
   </div>
</div>

</div>

@endsection
