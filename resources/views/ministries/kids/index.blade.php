@extends('layouts.master')

@section('side')
    @include('layouts.side.ministries')
@endsection

@section('content')

      {!! $content !!}

@endsection
