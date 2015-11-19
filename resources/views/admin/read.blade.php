@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h2 class="Setting__heading tk-seravek-web">
    Scripture of the Day
    <span class="Label utility-right">
      <a href="{{ route('read.create') }}" class="btn btn-default">New Passage</a>
    </span>
  </h2>

  {{-- Scripture of the Day --}}
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Passage</th>
          <th>Publish Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($passages as $index => $passage)
          <tr>
            <td><a href="{{ route('read.edit', $passage->slug) }}">{{ $passage->title }}</a></td>
            <td>{{ date_format($passage->published_at, 'l, F j, Y') }}</td>
            <td>{{ $passage->published_at->lt(\Carbon\Carbon::now()) ? 'Published' : 'Scheduled' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!! $passages->render() !!}
</div>

@endsection
