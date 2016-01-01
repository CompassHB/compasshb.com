@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')
    <h1 class="tk-seravek-web">Edit Song: {{ $song->title }}</h1>

    {!! Form::model($song, ['method' => 'PATCH', 'action' => ['SongsController@update', $song->alias]]) !!}
        @include('admin.songs.form', ['submitButtonText' => 'Update Song'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection