@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection


@section('content')
    <h1 class="tk-seravek-web">Edit Series: {{ $series->title }}</h1>

    {!! Form::model($series, ['method' => 'PATCH', 'action' => ['SeriesController@update', $series->alias]]) !!}
        @include('admin.series.form', ['submitButtonText' => 'Update Series'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection