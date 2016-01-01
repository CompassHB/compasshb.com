@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h2 class="Setting__heading tk-seravek-web">
    Worship Songs
    <span class="Label utility-right">
      <a href="{{ route('songs.create') }}" class="btn btn-default">New Song</a>
    </span>
  </h2>

  {{-- Worship Songs --}}
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Songs</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($songs as $song)
          <tr>
            <td><a href="{{ route('songs.edit', $song->alias) }}">{{ $song->title }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {!! $songs->render() !!}
</div>

@endsection
