@extends('layouts.app')
@section('css')
{{-- css for social icons --}}
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
@section('page-title',$profile->full_name)
@section('content')
	<div class="row">
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
			<div class="panel panel-default" >
				<div class="panel-body" style="min-height: 45vh">
					<div class="media" style="margin-top: 15px;">
						<div style="align-content:center;">
							<img class="thumbnail img-responsive" src="
							     @if($profile->profile_image == null)
							{{ asset('assets/uploads/default-user-1.png') }}
							@else
							{{ asset(STATIC_DIR.'storage/'.$profile->profile_image) }}
							@endif " width="300px" height="300px">
						</div>
						<div class="media-body">
							<hr>
							<p><strong>Joined date: </strong> {{ $profile->join_date ?? '' }}</p>
							<hr>
							<p><strong>Contact Number: </strong> {{ $profile->contact }}</p>
							<hr>
							<p><strong>Permanent Address: </strong> {{ $profile->permanent_add }}</p>
							<hr>
							<p><strong>Temporary Address: </strong> {{ $profile->temporary_add }}</p>
							<hr>
							<p><strong>Email Address: </strong> {{ $profile->email }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white post panel-shadow" >
						<div class="panel-body">
							<h1 class="panel-title pull-left" style="font-size:30px;">{{ $profile->full_name }}</h1>
							<a class="btn btn-link btn-sm" href="{{ route('password.edit') }} ">Change password</a>
							<a class="btn btn-link btn-sm" href="{{ route('staff.edit', Auth::user()->id) }} "> Edit profile</a>
							<i class="fa fa-gear fa-fw"></i>
							<br><br>
							<strong><small>({{ $profile->user_name }})</small>  </strong>
							<br><hr>

							<div class="col-md-12">
								<ul class="social-network social-circle">
									<li><a href="{{ $profile->facebook_link }}" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="{{ $profile->google_link }}" target="_blank" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="{{ $profile->twitter_link }}" target="_blank" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="{{ $profile->linkedin_link }}" target="_blank" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="white-box">
				<div class="row" style="min-height: 44vh">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
								<tr>
									<th style="width: 70px;">Task ID</th>
									<th>Title</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								{{-- @if ($assigned_completed->count()>0)
									@foreach($assigned_completed as $COMPLETED)
										<tr>
											<td>{{ $COMPLETED->id }}</td>
											<td>{{ $COMPLETED->name }}</td>
											<td>{{ $COMPLETED->created_at }}</td>
											<td>
												<a href="{{ route('task.view',$COMPLETED->id) }}" class="btn btn-default btn-block">View</a>
											</td>
										</tr>
									@endforeach
								@else --}}
									<tr>
										<td colspan="4" class="text-center">No items found.</td>
									</tr>
								{{-- @endif --}}
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>

@endsection
