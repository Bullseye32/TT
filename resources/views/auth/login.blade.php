<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href=" {{asset('asssets/plugins/images/favicon.png')}} ">
<title>TaskTracker | Login</title>
<!-- Bootstrap Core CSS -->
<link href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css') }} " rel="stylesheet">
<!-- animation CSS -->
<link href="{{ asset('assets/css/animate.css') }} " rel="stylesheet">
<!-- Custom CSS -->
<link href=" {{ asset('assets/css/style.css') }} " rel="stylesheet">
<!-- color CSS -->
<link href=" {{ asset('assets/css/colors/default.css') }} " id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
      <div class="lg-info-panel">
              <div class="inner-panel">
                  <a href="javascript:void(0)" class="p-20 di"><img src="{{asset('assets/plugins/images/admin-logo.png') }} "></a>
                  <div class="lg-content">
                      <h2>Welcome to Task-Tracker</h2>
                      <p class="text-muted">Please login for Task-Management.</p>
                      <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Contact Admin</a>
                  </div>
              </div>
      </div>
      <div class="new-login-box">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Sign In to Admin</h3>
                    <small>Enter your details below</small>

                {{-- form starts --}}
                 
                <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('login') }} ">
                    @csrf

                    <div class="form-group  m-t-20">
                      <div class="col-xs-12">
                        <label for="email">Email Address</label>
                        <input class="form-control" type="text" required="" name="email" placeholder="Username">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required="" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <div class="checkbox checkbox-info pull-left p-t-0">
                          <input id="checkbox-signup" type="checkbox">
                          <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password</a> </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">{{ __('Login') }}</button>
                    </div>

                    </div>
                    {{-- fb & google login --}}
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
                      </div>
                    </div>
                    {{-- signup --}}
                    <div class="form-group m-b-0">
                      <div class="col-sm-12 text-center">
                        <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Register</b></a></p>
                      </div>
                    </div>
                </form>
                {{-- login-form ends --}}

                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <h3>Recover Password</h3>
                        <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                      </div>
                    </div>
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                      </div>
                    </div>
                </form>
        
                </div>
      </div>            
  
  
</section>
<!-- jQuery -->
<script src="{{asset('assets/plugins/bower_components/jquery/dist/jquery.min.js') }} "></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.min.js') }} "></script>
<!-- Menu Plugin JavaScript -->
<script src=" {{asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

<!--slimscroll JavaScript -->
<script src="{{asset('assets/js/jquery.slimscroll.js') }} "></script>
<!--Wave Effects -->
<script src="{{asset('assets/js/waves.js') }} "></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('assets/js/custom.min.js')}} "></script>
<!--Style Switcher -->
<script src="{{asset('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}} "></script>
</body>
</html>
