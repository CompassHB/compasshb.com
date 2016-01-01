@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Women</h1>

  <?php $i = 0; ?>
  @foreach ($sermons as $sermon)
  <div class="col-md-4" {!! ($i % 3) ? 'style="margin-top: 20px;"' : 'style="clear: left; margin-top: 20px;"' !!}>
    <a href="{{ route('sermons.show', $sermon->alias) }}" style="background-image: url({{ $sermon->image }}); background-size: cover; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="{{ route('videos.show', $sermon->alias) }}" >{{ $sermon->title }}</a></h4>
      <p>{{ $sermon->text }}<br/>
      {{ date_format($sermon->published_at, 'l, F j, Y') }}<br/>
      {{ $sermon->teacher }}</p>
    </a>
  </div>
  <?php ++$i; ?>
  @endforeach

  <br style="clear: both"/>

    <br/><br/>

</div>

@endsection
