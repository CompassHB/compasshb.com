<br/><br/><br/><br/>
<section class="Settings utility-flex-container">
  <nav id="main-nav" class="Box Box--Large Box--bright">
    <ul>
      <li class="{{ setActive('admin/mainservice') }}">
        <a href="{{ route('admin.mainservice') }}">Main Service</a>

        <i class="material-icons">keyboard_arrow_right</i>
      </li>
      <li class="{{ setActive('admin/read') }}">
        <a href="{{ route('admin.read') }}">Scripture of the Day</a>

        <i class="material-icons">keyboard_arrow_right</i>
      </li>
      <li class="{{ setActive('admin/video') }}">
        <a href="{{ route('admin.video') }}">Post a Video</a>

        <i class="material-icons">keyboard_arrow_right</i>
      </li>
      <li class="{{ setActive('admin/songs') }}">
        <a href="{{ route('admin.songs') }}">Worship</a>

        <i class="material-icons">keyboard_arrow_right</i>
      </li>
    </ul>
  </nav>
</section>
