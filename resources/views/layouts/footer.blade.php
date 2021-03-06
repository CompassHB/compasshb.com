
  <footer id="footer" class="container-fluid">

    @if (!Auth::check())

  <div class="row">

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
        <a href="{{ route('college') }}">College</a><br/>
        <a href="{{ route('sundayschool') }}">Bible Class</a><br/>
      </p><br/>

    </div>


    <div class="col-md-2">
      <h4 class="tk-seravek-web">Resources</h4>
      <p>
        <a href="{{ route('read.index') }}">Scripture of the Day</a><br/>
        <a href="{{ route('sermons.index') }}">Sermons</a><br/>
        <a href="/worship">Worship</a><br/>
        <a href="{{ route('blog.index') }}">Videos</a><br/>
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
      <p><a href="{{ route('give') }}" title="Give" class="btn btn-primary" style="padding: 10px 60px">Give</a></p>

        <h4 class="tk-seravek-web">Contact</h4>
          <p>
            <i class="material-icons">map</i> 5082 Argosy, Huntington Beach, CA 92649<br/>
            <i class="material-icons">phone</i> (714) 895-0034<br/>
            <i class="material-icons">email</i> <a href="mailto:info@compasshb.com">info@compasshb.com</a><br/>
          </p>
    </div>
  </div>

@endif

  <div class="row" style="padding: 15px 30px; background-color: #222; min-height: 50px;">
    <span style="float: right; color: #AAA; font-weight: normal; font-size: 1.25em">© 2014-{{ date('Y') }} Compass Bible Church Huntington Beach</span>
  </div>

</footer>
</div>

   <!-- Search - Open panel -->
  <div id="toggle-search" class="search-panel">
    <a href="/" class="search-panel__close js--toggle-search-mode" title="Exit the search mode">
      <i class="material-icons">stop</i>
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
