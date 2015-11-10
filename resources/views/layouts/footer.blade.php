<footer id="footer" class="container-fluid" style="background-color: #FFF;">

  <div class="row" style="background-image: url('https://compasshb.smugmug.com/photos/i-pgR29VG/0/X3/i-pgR29VG-X3.png'); background-repeat: repeat-x; background-size: 850px; background-position: center top; padding: 80px 40px 40px 40px; line-height: 2em; padding-top: 40px; background-color: #FFF;">

    {{-- Compass Bible Church --}}
    <div class="col-md-2">
      <img src="/CBC-HB-logo.png" alt="Compass Bible Church Huntington Beach" style="height: 40px;"/>
    </div>

    {{-- Ministries --}}
    <div class="col-md-2">
      <h4 class="tk-seravek-web">Ministries</h4>
      <p>
        <a href="{{ route('kids') }}">Kids</a><br/>
        <a href="{{ route('youth') }}">Youth</a><br/>
        <a href="https://www.facebook.com/collegecompassHB">College</a><br/>
        <a href="{{ route('sundayschool') }}">Adult Sunday School</a><br/>
      </p><br/>

    </div>


    <div class="col-md-2">
      <h4 class="tk-seravek-web">Resources</h4>
      <p>
        <a href="{{ route('read.index') }}">Read</a><br/>
        <a href="{{ route('events.index') }}">Events</a><br/>
        <a href="{{ route('sermons.index') }}">Sermons</a><br/>
        <a href="{{ route('fellowship.index') }}">Fellowship</a><br/>
        <a href="{{ route('songs.index') }}">Worship</a><br/>
        <a href="{{ route('blog.index') }}">Blog</a><br/>
        <a href="{{ route('pray') }}">Pray</a><br/>
      </p>
    </div>

    <div class="col-md-2">
      <h4 class="tk-seravek-web">Social</h4>
      <p>
        <a href="https://www.facebook.com/compasshb" title="Facebook">Facebook</a><br/>
        <a href="https://instagram.com/compasshb" title="Instagram">Instagram</a><br/>
        <a href="https://twitter.com/compasshb" title="Twitter">Twitter</a><br/>
        <a href="https://vimeo.com/compasshb" title="Vimeo">Vimeo</a><br/>
        <a href="https://appsto.re/us/n_WA6.i">iPhone App</a><br/>
        <a href="https://play.google.com/store/apps/details?id=com.compasshb.mobile">Android App</a>
      </p>
    </div>

    {{-- Contact Us --}}
    <div class="col-md-4 " style="border-left: 1px solid #EEE; padding-left: 40px;">
      <p><a href="{{ route('give') }}" title="Give" class="btn btn-primary" style="padding: 10px 60px">Give</a></p><br/>
      <p><strong>The word of the Lord sounded forth...</strong><br/><em>- 1 Thessalonians 1:8</em></p>
      <p><a href="{{route('sermons.show', 'our-mission-statement')}}">Our Mission Statement</a></p><br/>

        <h4 class="tk-seravek-web">Contact</h4>
          <p>
            <i class="glyphicon glyphicon-globe"></i> 5082 Argosy, Huntington Beach, CA 92649<br/>
            <i class="glyphicon glyphicon-phone"></i> (714) 895-0034<br/>
            <i class="glyphicon glyphicon-envelope"></i> <a href="mailto:info@compasshb.com">info@compasshb.com</a>
          </p>
    </div>
  </div>

  <div class="row" style="padding: 15px 30px; background-color: #222; min-height: 50px; font-weight: bold">
    <a href="{{ route('who-we-are') }}" style="color: #FFF; padding-right: 10px;">Who We Are</a>
    <a href="{{ route('distinctives') }}" style="color: #FFF; padding-right: 10px;">8 Distinctives</a>
    <a href="{{ route('believe') }}" style="color: #FFF; padding-right: 10px;">What We Believe</a>
    <a href="{{ route('evangelism') }}" style="color: #FFF; padding-right: 10px;">Ice Cream Evangelism</a>
    <a href="{{ route('events.index') }}" style="color: #FFF; padding-right: 10px;">Events</a>
    <a href="https://github.com/compasshb" style="color: #FFF; padding-right: 10px;">GitHub</a>
    <a href="{{ route('search') }}" style="color: #FFF; padding-right: 10px;">Search</a>
    <span style="float: right; color: #AAA; font-weight: normal">© 2014-{{ date('Y') }} Compass Bible Church</span>
  </div>

</footer>
</div>

   <!-- Search - Open panel -->
  <div id="toggle-search" class="search-panel">
    <a href="/" class="search-panel__close js--toggle-search-mode" title="Exit the search mode">
      <i class="glyphicon glyphicon-remove"></i>
    </a>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <form action="/search/">
            <input type="text" class="search-panel__form  js--search-panel-text" name="q" placeholder="Begin typing to search">
            <p class="search-panel__text">Press enter to see results or esc to cancel.</p>
          </form>
        </div>
      </div>
    </div>
  </div>

@include('layouts.scripts')

</body>
</html>
