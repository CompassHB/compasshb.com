@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h1 class="Setting__heading tk-seravek-web">Study</h1>

    <style>
        .study
        {
            list-style: none;
        }

        .study li
        {
            float: left;
            background-color: #EEEEEE;
            height: 1em;
            width: 1em;
            padding: 0;
            margin: 1px 1px 0;
        }

        .study li a
        {
            display: block;
            color: #000;
        }

        .study li i.material-icons
        {
            font-size: .75em;
        }

        .study li.ref-1
        {
            background-color: #eeeeee;
        }

        .study li.ref-2
        {
            background-color: #d6e58a;
        }

        .study li.ref-3
        {
            background-color: #8ec56a;
        }

        .study li.ref-4
        {
            background-color: #48a245;
        }

        .study li.ref-5
        {
            background-color: #226727;
        }

    </style>
    <ul class="study">
        {!! $table !!}
    </ul>

    <br style="clear: both"/>
</div>

@endsection
