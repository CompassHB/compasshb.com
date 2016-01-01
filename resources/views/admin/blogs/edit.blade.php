@extends('layouts.master')

@section('side')
  @include('layouts.side.admin')
@endsection

@section('content')
    <h1 class="tk-seravek-web">Edit Blog: {{ $blog->title }}</h1>

    {!! Form::model($blog, ['method' => 'PATCH', 'action' => ['BlogsController@update', $blog->alias]]) !!}
        @include('admin.blogs.form', ['submitButtonText' => 'Update Blog'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection