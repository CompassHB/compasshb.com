@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection


@section('content')
<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Prayer</h1>

  <div class="row">
    <div class="col-sm-6">
      <div class="thumbnail">
        <img src="https://i.vimeocdn.com/video/505459850_960x540.jpg" alt="If God's People Pray">
        <div class="caption">
          <h3>If God's People Pray</h3>
          <p>Why to Pray</p>
          <p><a href="{{ route('sermons.show', 'if-gods-people-pray') }}" class="btn btn-primary" role="button">Watch</a></p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="thumbnail">
        <img src="{{ route('sermons.show', 'when-gods-people-pray') }}" alt="When God's People Pray">
        <div class="caption">
          <h3>When God's People Pray</h3>
          <p>How to Pray</p>
          <p><a href="https://vimeo.com/119068075" class="btn btn-primary" role="button">Watch</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title tk-seravek-web">Distinctive #5</h3>
    </div>
    <div class="panel-body">
      <p>We understand that the mission, the goals and the values at Compass Bible Church are humanly impossible. We do not inherently possess the wherewithal to make disciples or aid them in knowing, loving and serving Christ. These are works of God and we will always rely on him as we ardently ask him to accomplish these biblical objectives among us.</p>
      <p>Colossians 4:2-6</p>
      <p><a href="{{ route('distinctives') }}">8 Distinctives</a></p>
    </div>
  </div>

</div>

@endsection
