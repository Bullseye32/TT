<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="{{csrf_token()}} ">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/plugins/images/favicon.png') }} ">

    <title>TaskTracker | @yield('page-title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css' )}} " rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="{{asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }} " rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="{{asset('assets/css/animate.css') }} " rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }} " rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
         -->
    <link href="{{asset('assets/css/colors/megna-dark.css') }} " id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
@yield('css')

</head>
