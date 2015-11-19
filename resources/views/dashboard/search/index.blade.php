@extends('layouts.master')

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Search Results</h1>

  <?php $empty = empty($results['hits']['hits']); ?>
  @if ($empty)
    <p>No results found for: {{ $query }}</p>
  @endif

  @foreach ($results['hits']['hits'] as $result)
    <p>
      <strong>
        <a href="{{ makeRouteFromSlug($result['_type'], $result['_source']['slug']) }}">{{ $result['_source']['title'] }}</a>
      </strong><br/>
      <small>{{ $result['_type'] }}</small>
    </p>
    @endforeach

</div>

@endsection
