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
    <a href="/messages/women/{{ $sermon->slug }}" style="background-image: url({{ $sermon->_embedded->{'wp:featuredmedia'}[0]->source_url  }}); background-size: cover; width: 200px; height: 125px; display: block;"></a>
      <h4 class="tk-seravek-web"><a href="/women/messages/{{ $sermon->slug }}" >{{ $sermon->title->rendered }}</a></h4>
    <p>{{ $sermon->acf->text or '' }}<br/>
      {{ isset($sermon->acf->series->name) ? $sermon->acf->series->name : ''  }}<br/>
      {{ date('l, F j, Y', strtotime($sermon->date)) }}<br/>
      {{ $sermon->_embedded->author[0]->name }}</p>

    </a>
  </div>
  <?php ++$i; ?>
  @endforeach

  <br style="clear: both"/>

    <br/><br/>

</div>

@endsection
