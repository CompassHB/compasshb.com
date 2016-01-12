@extends('layouts.master')

@section('side')
    @include('layouts.side.resources')
@endsection

@section('content')
    <h1 class="tk-seravek-web">A Tale of Goody Two Shoes</h1>

    <div class="well">
        <img src="https://compasshb.smugmug.com/photos/i-wVznLvW/0/S/i-wVznLvW-S.png" alt="Goody Two Shoes" style="float: left; padding: 5px;"/>
        <p><br/>"By all accounts, Goody Two-Shoes was a good person. Everyone thought highly of her and admired her kind heart...."</p>
        <h4 class="tk-seravek-web">Download</h4>
        <a href="/download/goody-two-shoes.pdf" class="btn btn-default">Download .PDF</a>
        <a href="/download/goody-two-shoes.epub" class="btn btn-default">Download iBooks</a>
        <a href="/download/goody-two-shoes.mobi" class="btn btn-default">Download Kindle</a>
        <br style="clear: both"/>

    </div>

@endsection
