<br/><br/>

<section class="Settings utility-flex-container">
  <nav id="main-nav" class="Box Box--Large Box--bright">
		<ul>
	    <li class="{{ setActive('read') }}">
				<a href="{{ route('read.index') }}">Scripture of the Day</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('sermons') }}">
				<a href="{{ route('sermons.index') }}">Sermons</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('songs') }}">
				<a href="/worship">Worship</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('blog') }}">
				<a href="{{ route('blog.index') }}">Videos</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
      <li class="{{ setActive('giving') }}">
				<a href="{{ route('giving') }}">Give</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	</ul>
  </nav>
</section>
