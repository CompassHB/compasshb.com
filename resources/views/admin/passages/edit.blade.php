@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')
    <h1 class="tk-seravek-web">Edit Passage: {{ $passage->title }}</h1>

    {!! Form::model($passage, ['method' => 'PATCH', 'action' => ['PassagesController@update', $passage->alias]]) !!}
        @include('admin.passages.form', ['submitButtonText' => 'Update Passage'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection