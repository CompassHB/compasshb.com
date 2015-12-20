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
	    <li class="{{ setActive('series') }}">
				<a href="{{ route('series.index') }}">Series</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('songs') }}">
				<a href="{{ route('songs.index') }}">Worship</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('events') }}">
				<a href="{{ route('events.index') }}">Events</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('pray') }}">
				<a href="{{ route('pray') }}">Prayer</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	    <li class="{{ setActive('blog') }}">
				<a href="{{ route('blog.index') }}">Blog</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
      <li class="{{ setActive('giving') }}">
				<a href="{{ route('giving') }}">Give</a>
				<i class="material-icons">keyboard_arrow_right</i>
			</li>
	</ul>
</section>
