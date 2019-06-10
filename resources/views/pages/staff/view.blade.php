@extends('layouts.app')
@section('page-title','Staff Details')

@section('css')
<style>

    /* footer social icons */
    ul.social-network {
        list-style: none;
        display: inline;
        margin-left:0 !important;
        padding: 0;
    }
    ul.social-network li {
        display: inline;
        margin: 0 5px;
    }


    /* footer social icons */
    .social-network a.icoRss:hover {
        background-color: #F56505;
    }
    .social-network a.icoFacebook:hover {
        background-color:#3B5998;
    }
    .social-network a.icoTwitter:hover {
        background-color:#33ccff;
    }
    .social-network a.icoGoogle:hover {
        background-color:#BD3518;
    }
    .social-network a.icoVimeo:hover {
        background-color:#0590B8;
    }
    .social-network a.icoLinkedin:hover {
        background-color:#007bb7;
    }
    .social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
    .social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i {
        color:#fff;

    }
    a.socialIcon:hover, .socialHoverClass {
        color:#44BCDD;

    }

    .social-circle li a {
        display:inline-block;
        position:relative;
        margin:0 auto 0 auto;
        -moz-border-radius:50%;
        -webkit-border-radius:50%;
        border-radius:50%;
        text-align:center;
        width: 50px;
        height: 50px;
        font-size:20px;
        background-color: #D3D3D3;
    }
    .social-circle li i {
        margin:0;
        line-height:50px;
        text-align: center;

    }

    .social-circle li a:hover i, .triggeredHover {
        -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        -ms--transform: rotate(360deg);
        transform: rotate(360deg);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -o-transition: all 0.2s;
        -ms-transition: all 0.2s;
        transition: all 0.2s;

    }
    .social-circle i {
        color: #fff;
        -webkit-transition: all 0.8s;
        -moz-transition: all 0.8s;
        -o-transition: all 0.8s;
        -ms-transition: all 0.8s;
        transition: all 0.8s;

    }


    .popupunder{
        width: 300px;
        position:fixed;
        top: 10px;
        right: 10px;
        z-index: 10;
        border: 0;
        padding: 20px;
    }
    .popupunder.alert-success{
        border: 1px solid #198b49;
        background:#27AE60;
        color:#fff;
    }
    .popupunder .close{
        font-size: 10px;
        position:absolute !important;
        right: 2px;
        top: 3px;
    }
</style>
@endsection

@section('content')
		<br>

<div class="container">
  <div class="col-lg-6-offset-4">
 	 <div class="col-lg-6">
  	<div class="panel panel-default">

	  <div class="panel-body">


	    	<strong>Full Name : </strong>{{ $staff->full_name }}
	    	<hr>
	    	<strong>Contact Number : </strong>{{ $staff->contact }}
	    	<hr>
	    	<strong>Joined Date : </strong>{{ $staff->join_date }}
	    	<hr>
	    	<strong>Department : </strong>{{ $staff->department }}
	    	<hr>
	    	<strong>User Name : </strong>{{ $staff->user_name }}
	    	<hr>
            <strong>Permanent Address : </strong>{{ $staff->permanent_add }}
            <hr>
            <strong>Temporary Address : </strong>{{ $staff->temporary_add }}
            <hr>
            <strong>Social Media link </strong>  <div class="col-md-12">
                    <ul class="social-network social-circle">
                       @if (isset($staff->facebook_link))
                            <li><a href="{{ $staff->facebook_link }}" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                       @endif
                        @if (isset($staff->twitter_link))
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if (isset($staff->google_link))
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if (isset($staff->linkedin_link))
                            <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            <hr>


	    </div>
	    </div>
	    </div>
	    <div class="col-lg-6">

                 <div class="media">
                        <div align="center">
                            <img class="thumbnail img-responsive"
                                 @if($staff->profile_image == null)
                                 src="{{ asset(STATIC_DIR.'assets/uploads/default-user-1.png') }}"
                                 @else
                                 src="{{ asset(STATIC_DIR.'storage/'.$staff->profile_image) }}"
                                 @endif
                                 width="300px" height="300px"
                            >
                        </div>

                    </div>

	    </div>

        {{-- only executes if admin user is logged in --}}
        @if (Auth::user()->isAdmin()=='admin')
        {{-- {{ Auth::user() }} --}}

            <div class="col-lg-12">
                    <div class="col-lg-12">
                        <h2>Task Assigned to {{ $staff->full_name }}</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Task ID</th>
                                        <th>Title</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @foreach($assigned as $data) --}}
                                    <tr>
                                        {{-- <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->created_at }}</td>
                                         <td class="center">
                                            @if($data->status==0)
                                                <p class="list-group-item-text">
                                                  <span class="label label-success">New</span>
                                                </p>
                                            @elseif($data->status==1)
                                                <p class="list-group-item-text">
                                                  <span class="label label-success">Opened</span>
                                                </p>
                                            @elseif($data->status==2)
                                                <p class="list-group-item-text">
                                                  <span class="label label-danger">Pending</span>
                                                </p>
                                            @elseif($data->status==3)
                                                <p class="list-group-item-text">
                                                  <span class="label label-success">Completed</span>
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('task.view',$data->id) }}" class="btn btn-default">View</a>
                                            <a href="{{ route('task.edit',$data->id) }}" class="btn btn-default">Edit</a>

                                           {{--   <form action="{{ route('task.delete',$data->id) }}" method="post">
                                             {{ csrf_field() }}
                                                    <button onclick="myFunction()" class="btn btn-danger btn-block">Delete</button>

                                            </form> --}}
                                            {{--<a href="{{ route('task.delete',$data->id) }}" class="btn btn-default">Delete </a>--}}
                                        {{-- </td> --}} --}}
                                    </tr>
                                {{-- @endforeach --}}

                                </tbody>
                            </table>

                            <div>
                            	{{-- <strong>Showing {{ $assigned->firstItem() }} to {{ $assigned->lastitem() }} of {{ $assigned->total() }} entries </strong> --}}
                            </div>
                            <div align="center">
                            	 {{-- {{ $assigned->links() }} --}}
                            </div>

                        </div>
                    </div>
            </div>
        @endif

	  </div>
	</div>

@endsection
