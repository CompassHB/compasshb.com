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
                              <a href="{{ route('sermons.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="/auth/logout">Log Out</a></li>
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
                                  <li><a href="{{ route('who-we-are') }}"><span class="glyphicon glyphicon-user"></span> Who We Are</a></li>
                                  <li><a href="{{ route('distinctives') }}"><span class="glyphicon glyphicon-flag"></span> 8 Distinctives</a></li>
                                  <li><a href="{{ route('believe') }}"><span class="glyphicon glyphicon-book"></span> What We Believe</a></li>
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="{{ route('kids') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ministries <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="{{ route('kids') }}"><span class="glyphicon glyphicon-pencil"></span>  Kids Ministry</a></li>
                                  <li><a href="{{ route('youth') }}"><span class="glyphicon glyphicon-sunglasses"></span>  Youth Ministry</a></li>
                                  <li><a href="{{ route('college') }}"><span class="glyphicon glyphicon-education"></span>  College Ministry</a></li>
                                  <li><a href="{{ route('sundayschool') }}"><span class="glyphicon glyphicon-blackboard"></span>  Adult Sunday School</a></li>
                                  <li><a href="{{ route('fellowship.index') }}"><span class="glyphicon glyphicon-header"></span> Home Fellowship Groups</a></li>
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="{{ route('sermons.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sermons <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-left">
                                  <li><a href="{{ route('sermons.index') }}">Sermons</a></li>
                                  <li><a href="{{ route('read.index') }}">Scripture of the Day</a></li>
                                  <li role="separator" class="divider"></li>
                                  <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                  <li><a href="{{ route('songs.index') }}">Songs</a></li>
                                  <li><a href="{{ route('events.index') }}">Events</a></li>
                                  <li role="separator" class="divider"></li>
                                  <li><a href="{{ route('give') }}">Give</a></li>
                              </ul>
                          </li>
                          <li><a href="{{ route('evangelism') }}">Ice Cream Evangelism</a></li>
                          <li><a href="{{ route('search') }}" aria-label="Search" id="toggle-search-show"><span class="glyphicon glyphicon-search"></span></a>
                          </li>
                      </ul>
                  </div>
          </nav>
      </div>
  </header>
@endif
