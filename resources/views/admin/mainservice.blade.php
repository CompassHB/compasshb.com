@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h2 class="Setting__heading tk-seravek-web">
    Sermons
    <span class="Label utility-right">
      <a href="{{ route('sermons.create') }}" class="btn btn-default">New Sermon</a>
      <a href="{{ route('series.create') }}" class="btn btn-default">New Series</a>
      <a href="{{ route('blog.create') }}" class="btn btn-default">New Blog</a>
    </span>
  </h2>

  {{-- Sermons --}}
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sermon</th>
          <th>Text</th>
          <th>Publish Date</th>
          <th>Worksheet<br/> & Bulletin</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sermons as $sermon)
          <tr>
            <td><a href="{{ route('sermons.edit', $sermon->alias) }}">{{ $sermon->title }}</a></td>
            <td>{{ $sermon->text }}</td>
            <td>{{ date_format($sermon->published_at, 'l, F j, Y') }}</td>
            <td>{!! $sermon->worksheet ? '<i class="material-icons">done</i>' : '' !!}
                   {!! $sermon->bulletin ? '<i class="material-icons">done_all</i>' : '' !!}</td>
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

  {{-- Blogs --}}
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Blog</th>
          <th>Publish Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($blogs as $blog)
          <tr>
            <td><a href="{{ route('blog.edit', $blog->alias) }}">{{ $blog->title }}</a></td>
            <td>{{ date_format($blog->published_at, 'Y-m-d l') }}</td>
            <td>{{ $blog->published_at->lt(\Carbon\Carbon::now()) ? 'Published' : 'Scheduled' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!! $blogs->render() !!}
</div>

@endsection
