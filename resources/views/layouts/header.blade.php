<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">

	@include('layouts.opengraph')

    <title>{{{ $title or 'Compass HB' }}} - Compass Bible Church</title>

    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Droid+Serif" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body>
<div class="page-container">
