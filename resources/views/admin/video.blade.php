@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h2 class="Setting__heading tk-seravek-web">
    Videos
    <span class="Label utility-right">
      <a href="{{ route('videos.create') }}" class="btn btn-default">New Video</a>
      <a href="{{ route('series.create') }}" class="btn btn-default">New Series</a>
    </span>
  </h2>

  {{-- Sunday School Messages --}}
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Ministry</th>
          <th>Message</th>
          <th>Text</th>
          <th>Publish Date</th>
          <th>Worksheet</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sermons as $sermon)
          <tr>
            <td>{{ $sermon->ministryId }}</td>
            <td><a href="{{ route('videos.edit', $sermon->alias) }}">{{ $sermon->title }}</a></td>
            <td>{{ $sermon->text }}</td>
            <td>{{ date_format($sermon->published_at, 'l, F j, Y') }}</td>
            <td>{!! $sermon->worksheet ? '<i class="material-icons">done</i>' : '' !!}</td>
            <td>{{ $sermon->published_at->lt(\Carbon\Carbon::now()) ? 'Published' : 'Scheduled' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!! $sermons->render() !!}

  {{-- Series --}}
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Series</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($series as $s)
          <tr>
            <td><a href="{{ route('series.edit', $s->alias) }}">{{ $s->title }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!! $series->render() !!}
</div>

@endsection
