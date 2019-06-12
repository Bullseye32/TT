<div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span>
                    <span class="hide-menu">TaskTracker</span></h3>
            </div>
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ route('home') }} " class="waves-effect @if(Request::is('home')) active @endif" >
                        <i data-icon="7" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.view',Auth::user()->id) }} " class="waves-effect @if(Request::is('profile/*')) active @endif">
                        <i class="fa fa-user fa-fw"></i>
                        <span class="hide-menu">My Profile</span>
                    </a>
                </li>

                {{-- staff management --}}
                <li>

                    <a href="javascript:void(0)" class="waves-effect @if(Request::is('staff/*')) active @endif">
                            <i class="glyphicon glyphicon-tasks fa-fw"></i>
                            <span class="hide-menu">Staff Management
                                <span class="fa arrow fa-fw"></span>
                            </span>
                        </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('staff.register') }}" class="@if(Request::is('staff/register')) active @endif">
                                <i class="fa fa-plus fa-fw"> </i>
                                <span class="hide-menu">Register Staff</span>
                            </a>
                        </li>
                        <li>
                                <a href="{{ route('staff.show') }}" class="@if(Request::is('staff/list')) active @endif">
                                    <i class="fa fa-list fa-fw"> </i>
                                    <span class="hide-menu">Staff List</span>
                                    @if(isset($staff))
                                        <span class="label label-rouded label-purple pull-right">
                                            {{ $staff->count() }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                    </ul>
                </li>

                {{-- task management --}}
                <li>
                    <a href="javascript:void(0)" class="waves-effect">
                        <i class="glyphicon glyphicon-tasks fa-fw"></i>
                        <span class="hide-menu">Task Management<span class="fa arrow fa-fw"></span></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="javascript:void(0)">
                                <i data-icon="/" class="glyphicon glyphicon-pencil fa-fw"></i>
                                <span class="hide-menu">Create new task</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i data-icon="7" class="glyphicon glyphicon-share fa-fw"></i>
                                <span class="hide-menu">Assign Task</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="waves-effect"><i data-icon="&#xe008;" class="glyphicon glyphicon-eye-open fa-fw"></i><span class="hide-menu">View all task</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">N</i><span class="hide-menu">Normal</span></a> </li>
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">i</i><span class="hide-menu">Important</span></a> </li>
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">U</i><span class="hide-menu">Urgent</span></a> </li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0)"><i data-icon="7" class="glyphicon glyphicon-check fa-fw"></i><span class="hide-menu">Completed Task</span></a> </li>
                    </ul>
                </li>

                {{-- telephone directory --}}
                <li>
                    <a href="#" class="@if(Request::is('telephone/*')) active @endif ">
                        <i class="glyphicon glyphicon-phone-alt fa-fw"></i> Telephone Directory<span class="fa arrow fa-fw"></span></a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('telephone.register') }} " class="@if(Request::is('telephone/register')) active @endif" ><i class="fa fa-plus fa-fw"></i> Add New Contact</a>
                        </li>

                        <li>
                            <a href="{{ route('telephone.list') }} " class="@if(Request::is('telephone/list')) active @endif "><i class="	glyphicon glyphicon-earphone fa-fw"></i> Show Telephone List</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
