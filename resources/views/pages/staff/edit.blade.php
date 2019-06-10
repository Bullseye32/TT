@extends('layouts.app')
@section('page-title','Update Staff Details')

@section('content')
  <!-- Page Heading -->
           <br>

<div class="container">
    {{-- change password --}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <a href="{{ route('password.edit') }}" class="btn btn-primary"><i class=" fa fa-cogs"></i> Change Password</a>

            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 ">
                <form class="form-horizontal" method="post" action="{{ route('staff.edit',$staff->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <h2>
                            Personal Information:
                            <hr>
                        </h2>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label for="full_name" class="col-md-4 control-label">Full Name</label>

                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control" name="full_name" value="{{ $staff->full_name }}" required autofocus>

                                    @if ($errors->has('full_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="user_name" class="col-md-4 control-label">User Name</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control" readonly="" name="user_name" value="{{ $staff->user_name }}" required>

                                    @if ($errors->has('user_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                                <label for="contact" class="col-md-4 control-label">Contact Number</label>

                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control" name="contact" value="{{ $staff->contact }}"  autofocus>

                                    @if ($errors->has('contact'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('permanent_add') ? ' has-error' : '' }}">
                                <label for="permanent_add" class="col-md-4 control-label">Permanent Address</label>

                                <div class="col-md-6">
                                    <input id="permanent_add" type="text" class="form-control" name="permanent_add" value="{{ $staff->permanent_add }}"  autofocus>

                                    @if ($errors->has('permanent_add'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('permanent_add') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('temporary_add') ? ' has-error' : '' }}">
                                <label for="temporary_add" class="col-md-4 control-label">Temporary Address</label>

                                <div class="col-md-6">
                                    <input id="temporary_add" type="text" class="form-control" name="temporary_add" value="{{ $staff->temporary_add }}"  autofocus>

                                    @if ($errors->has('temporary_add'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('temporary_add') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ $staff->email }}"  autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('join_date') ? ' has-error' : '' }}">
                                <label for="join_date" class="col-md-4 control-label">Join date</label>

                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control" name="join_date" value="{{ $staff->join_date }}"  autofocus>

                                    @if ($errors->has('join_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('join_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('facebook_link') ? ' has-error' : '' }}">
                                <label for="social" class="col-md-4 control-label">Facebook Profile Link</label>

                                <div class="col-md-6">
                                    <input id="social" type="text" class="form-control" name="facebook_link" value="{{ $staff->facebook_link }}"  autofocus>

                                    @if ($errors->has('facebook_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('facebook_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('linkedin_link') ? ' has-error' : '' }}">
                                <label for="social" class="col-md-4 control-label">LinkedIn Profile Link</label>

                                <div class="col-md-6">
                                    <input id="social" type="text" class="form-control" name="linkedin_link" value="{{ $staff->linkedin_link }}"  autofocus>

                                    @if ($errors->has('linkedin_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('linkedin_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h2>File Upload:</h2>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                                <label for="profile_image" class="col-md-4 control-label">Profile Image</label>
                                <div class="col-md-6">
                                    <input id="profile_image" type="file" class="form-control" name="profile_image" value="{{ $staff->profile_image }}"  autofocus>
                                    @if ($errors->has('profile_image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('citizenship_image') ? ' has-error' : '' }}">
                                <label for="citizenship_image" class="col-md-4 control-label">Citizenship</label>

                                <div class="col-md-6">
                                    <input id="citizenship_image" type="file" class="form-control" name="citizenship_image" value="{{ $staff->citizenship_image }}"  autofocus >

                                    @if ($errors->has('citizenship_image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('citizenship_image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Update
                                    </button>
                                    <a href="{{ route('staff.show') }}" class="btn btn-default" ><i class="fa fa-close"></i> Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>


        </div>
    </div>
</div>


@endsection
