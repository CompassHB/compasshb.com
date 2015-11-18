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
    <link href="/build/css/app2.css" rel="stylesheet">

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts usually shouldn't come in <head> for performance, but this is
         a font, so we need to load in <head> to avoid flash of unstyled text -->
    <script src="//use.typekit.net/gdu1kdg.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
</head>

<body>
<div class="page-container">
