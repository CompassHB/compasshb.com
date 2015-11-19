@include('layouts.header')
@include('layouts.nav')

  <div class="container-fluid">
    <div class="row">

      <!-- If there is a sidebar then create two clumns,
      otherwise only create one -->
      @if (trim($__env->yieldContent('side')))

        <!-- Main Content -->
        <div class="col-sm-9 col-sm-push-3" style="padding-top: 20px;">
          @yield('content')
        </div>

        <!-- Navigation Sidebar -->
        <div class="col-sm-3 col-sm-pull-9">
          @yield('side')
        </div>

      @else

        <!-- No sidebar -->
        <div class="col-sm-12">
          @yield('content')
        </div>

      @endif

    </div>
  </div>

@include('layouts.footer')
