<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">

	@include('layouts.opengraph')

    <title>{{{ $title or 'Compass HB' }}} - Compass Bible Church</title>

    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Droid+Serif" type="text/css" rel="stylesheet" media="screen,projection">
    <link href='//fonts.googleapis.com/css?family=Fira+Sans:700' type='text/css' rel='stylesheet'>
    <link rel="stylesheet" id="wpex-style-css" href="https://api.compasshb.com/wp-content/themes/theme/style.css" type="text/css" media="all">
    <link rel='stylesheet' id='js_composer_front-css'  href='https://api.compasshb.com/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=4.12.1' type='text/css' media='all' />

</head>

<body>
<div class="page-container">
