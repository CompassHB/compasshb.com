@if (Auth::check())
<header class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('admin.index') }}">
                        <img src="/CBC-HB-logo.png" id="logo" alt="Compass Bible Church Huntington Beach"/>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::User()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left">
                              <li><a href="/settings">Your Settings</a></li>
                                <li><a href="/logout">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>
</header>
@else
  <header class="container-fluid">
      <div class="row">
          <nav class="navbar navbar-default navbar-static-top">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="{{ route('home') }}">
                          <img src="/CBC-HB-logo.png" id="logo" alt="Compass Bible Church Huntington Beach"/>
                      </a>
                  </div>
                  <div class="collapse navbar-collapse" id="navbar">
                      <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                              <a href="{{ route('who-we-are') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Who We Are <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="{{ route('who-we-are') }}"><i class="material-icons">person</i> Who We Are</a></li>
                                  <li><a href="{{ route('distinctives') }}"><i class="material-icons">flag</i> 8 Distinctives</a></li>
                                  <li><a href="{{ route('believe') }}"><i class="material-icons">library_books</i> What We Believe</a></li>
                                  <li><a href="{{ route('evangelism') }}">Ice Cream Evangelism</a></li>
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="{{ route('kids') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ministries <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="{{ route('kids') }}"><i class="material-icons">child_care</i>  Kids Ministry</a></li>
                                  <li><a href="{{ route('youth') }}"><i class="material-icons">group</i>  Youth Ministry</a></li>
                                  <li><a href="{{ route('college') }}"><i class="material-icons">domain</i>  College Ministry</a></li>
                                  <li><a href="{{ route('sundayschool') }}"><i class="material-icons">free_breakfast</i>  Bible Class</a></li>
                                  <li><a href="{{ route('men') }}"><i class="material-icons">account_box</i>  Mens Ministry</a></li>
                                  <li><a href="{{ route('women') }}"><i class="material-icons">account_circle</i>  Womens Ministry</a></li>
                              </ul>
                          </li>
                          <li><a href="{{ route('sermons.index') }}">Sermons</a></li>
                          <li class="dropdown">
                              <a href="{{ route('blog.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resources <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="{{ route('read.index') }}"><i class="material-icons">library_books</i> Scripture of the Day</a></li>
                                  <li><a href="{{ route('blog.index') }}"><i class="material-icons">announcement</i> Videos</a></li>
                                  <li><a href="/worship"><i class="material-icons">music_note</i> Songs</a></li>
                                  <li><a href="{{ route('events.index') }}"><i class="material-icons">event</i> Events</a></li>
                                  <li><a href="https://compasshb.smugmug.com/PhotoArchive"><i class="material-icons">camera</i> Photos</a></li>
                                  <li><a href="{{ route('give') }}"><i class="material-icons">card_giftcard</i> Give Online</a></li>
                              </ul>
                          </li>
                          <li><a href="{{ route('search') }}" aria-label="Search" id="toggle-search-show"><i class="material-icons">search</i></a>
                          </li>
                      </ul>
                  </div>
          </nav>
      </div>
  </header>
@endif
