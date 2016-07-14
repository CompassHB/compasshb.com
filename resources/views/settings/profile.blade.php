@extends('layouts.master')

@section('side')
<br/><br/>
<h2>Settings</h2>
<section class="Settings utility-flex-container">
  <nav id="main-nav" class="Box Box--Large Box--bright">
    <ul>
      <li class="{{ setActive('settings') }}">
        <a href="/settings">Profile</a>

        <i class="material-icons">keyboard_arrow_right</i>
      </li>
      <li class="security">
        <a href="#">Security</a>

        <i class="material-icons">keyboard_arrow_right</i>
      </li>
    </ul>
  </nav>
</section>

@endsection

@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="Setting Box Box--Large Box--bright utility-flex">
  <h2 class="Setting__heading tk-seravek-web">The Basics</h2>

  <h3>Name</h3>
  <h3>Email</h3>

</div>

@endsection
