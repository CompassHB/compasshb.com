@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')
    <h1 class="tk-seravek-web">Edit Sermon: {{ $sermon->title }}</h1>

    {!! Form::model($sermon, ['method' => 'PATCH', 'route' => ['sermons.update', $sermon->alias], 'files' => true]) !!}
        @include('admin.sermons.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection