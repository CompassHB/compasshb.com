@extends('layouts.master')

@section('content')
    <style type="text/css" media="all" id="siteorigin-panels-grids-wp_head">/* Layout 50 */ #pgc-50-0-0 , #pgc-50-1-0 , #pgc-50-2-0 , #pgc-50-3-0 , #pgc-50-4-0 { width:38.197% } #pgc-50-0-1 , #pgc-50-1-1 , #pgc-50-2-1 , #pgc-50-3-1 , #pgc-50-4-1 { width:61.803% } #pg-50-0 , #pg-50-1 , #pg-50-2 , #pg-50-3 , #pl-50 .panel-grid-cell .so-panel { margin-bottom:30px } #pg-50-0 .panel-grid-cell , #pg-50-1 .panel-grid-cell , #pg-50-2 .panel-grid-cell , #pg-50-3 .panel-grid-cell , #pg-50-4 .panel-grid-cell { float:left } #pl-50 .panel-grid-cell .so-panel:last-child { margin-bottom:0px } #pg-50-0 , #pg-50-1 , #pg-50-2 , #pg-50-3 , #pg-50-4 { margin-left:-15px;margin-right:-15px } #pg-50-0 .panel-grid-cell , #pg-50-1 .panel-grid-cell , #pg-50-2 .panel-grid-cell , #pg-50-3 .panel-grid-cell , #pg-50-4 .panel-grid-cell { padding-left:15px;padding-right:15px } @media (max-width:780px){ #pg-50-0 .panel-grid-cell , #pg-50-1 .panel-grid-cell , #pg-50-2 .panel-grid-cell , #pg-50-3 .panel-grid-cell , #pg-50-4 .panel-grid-cell { float:none;width:auto } #pgc-50-0-0 , #pgc-50-1-0 , #pgc-50-2-0 , #pgc-50-3-0 , #pgc-50-4-0 { margin-bottom:30px } #pl-50 .panel-grid { margin-left:0;margin-right:0 } #pl-50 .panel-grid-cell { padding:0 }  } </style>
    <br/><br/><br/>

  <div class="Setting Box Box--Large Box--bright utility-flex">

      <h1 class="Setting__heading tk-seravek-web">{{ $page->title->rendered }}</h1>
      {!! $page->content->rendered !!}

  </div>
    <link rel='stylesheet' id='siteorigin-panels-front-css'  href='http://api.compasshb.com/wp-content/plugins/siteorigin-panels/css/front.css?ver=2.4.9' type='text/css' media='all' />
    <link rel='stylesheet' id='sow-image-default-1c389ca87c1a-css'  href='http://api.compasshb.com/wp-content/uploads/siteorigin-widgets/sow-image-default-1c389ca87c1a.css?ver=4.5.3' type='text/css' media='all' />

    <br/><br/><br/>
@endsection
