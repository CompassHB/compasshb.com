@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

<h1 class="tk-seravek-web">Admin</h1>
<p>Admin page for posting and scheduling site content.</p><br/>

{{-- Sermons --}}
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title tk-seravek-web" id="sermons">Sermons</h3>
  </div>
  <div class="panel-body">
    <p>All sermons and links to edit the content or post new ones.</p>
    <p><a href="{{ route('sermons.create') }}" class="btn btn-default">New Sermon</a></p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
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
          <td>{{ $sermon->sku }}</td>
          <td><a href="{{ route('sermons.edit', $sermon->slug) }}">{{ $sermon->title }}</a></td>
          <td>{{ $sermon->text }}</td>
          <td>{{ date_format($sermon->published_at, 'Y-m-d l') }}</td>
          <td>{!! $sermon->worksheet ? '<span class="glyphicon glyphicon-ok"></span>' : '' !!}
                 {!! $sermon->bulletin ? '<span class="glyphicon glyphicon-asterisk"></span>' : '' !!}</td>
          <td>{{ $sermon->published_at->lt(\Carbon\Carbon::now()) ? 'Published' : 'Scheduled' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{!! $sermons->render() !!}

{{-- Series --}}
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title tk-seravek-web" id="series">Sermon Series</h3>
  </div>
  <div class="panel-body">
    <p>All series and links to edit the content or post new ones.</p>
    <p><a href="{{ route('series.create') }}" class="btn btn-default">New Series</a></p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($series as $s)
        <tr>
          <td><a href="{{ route('series.edit', $s->slug) }}">{{ $s->title }}</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{!! $series->render() !!}

{{-- Blogs --}}
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title tk-seravek-web" id="blogs">Blogs/Videos</h3>
  </div>
  <div class="panel-body">
    <p>All blogs and links to edit the content or post new ones.</p>
    <p><a href="{{ route('blog.create') }}" class="btn btn-default">New Blog</a></p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Publish Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($blogs as $blog)
        <tr>
          <td><a href="{{ route('blog.edit', $blog->slug) }}">{{ $blog->title }}</a></td>
          <td>{{ date_format($blog->published_at, 'Y-m-d l') }}</td>
          <td>{{ $blog->published_at->lt(\Carbon\Carbon::now()) ? 'Published' : 'Scheduled' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{!! $blogs->render() !!}

@endsection
