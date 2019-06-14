<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
{{-- <html lang="en"> --}}

@include('partials._head')

<body class="fix-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper">

        <!-- Top Navigation -->
            @include('partials._nav')
        <!-- End Top Navigation -->

        <!-- Left navbar-header -->
            @include('partials._sidebar')
        <!-- Left navbar-header end -->


        <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <!-- .page title -->
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">@yield('page-title')</h4> </div>
                        <!-- /.page title -->
                    </div>
                    <!-- .row -->
                   @yield('content')
                    <!-- .row -->
                </div>
                <!-- /.container-fluid -->
                @include('partials._footer')
            </div>
    </div>
    <!-- /#wrapper -->

    @include('partials._script')
    @yield('script')

</body>

</html>
