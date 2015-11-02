@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

<h1 class="tk-seravek-web">Admin</h1>
<p>Admin page for posting and scheduling site content.</p><br/>

{{-- Scripture of the Day --}}
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title tk-seravek-web" ="scriptureoftheday">Scripture of the Day</h3>
  </div>
  <div class="panel-body">
    <p>Here is a list of all of the scripture of the day passages and links to edit the content or post new ones.</p>
    <p><a href="{{ route('read.create') }}" class="btn btn-default">New Passage</a></p>
  </div>
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

@endsection
