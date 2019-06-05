<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <!-- Toggle icon for mobile view -->
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <!-- Logo icon image, you can use font-icon also --><b>
                <!--This is dark logo icon--><img src="{{asset('assets/plugins/images/admin-logo.png') }} " alt="home" class="dark-logo" />
                <!--This is light logo icon--><img src="{{asset('assets/plugins/images/admin-logo-dark.png') }} " alt="home" class="light-logo" />
             </b>
                <!-- Logo text image you can use text also --><span class="hidden-xs">
                <!--This is dark logo text--><img src="{{ asset('assets/plugins/images/admin-text.png') }} " alt="home" class="dark-logo" />
                <!--This is light logo text--><img src="{{asset('assets/plugins/images/admin-text-dark.png') }} " alt="home" class="light-logo" />
             </span> </a>
        </div>
        <!-- /Logo -->
       
        <!-- This is the message dropdown -->
        <ul class="nav navbar-top-links navbar-right pull-right">
            <!-- /.Task dropdown -->
            <!-- /.dropdown -->
            <li>
                <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                    <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ asset('assets/plugins/images/users/varun.jpg') }} " alt="user-img" width="36" class="img-circle"><b class="hidden-xs">Mukesh</b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="{{ asset('assets/plugins/images/users/varun.jpg') }} " alt="user" /></div>
                            <div class="u-text"><h4>Mukesh Rai</h4><p class="text-muted">Mukesh@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                    <li role="separator" class="divider"></li>

                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>