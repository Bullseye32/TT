@extends('layouts.app')
@section('page-title','Register New Staff')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header"><strong>{{ __('Register New Staff') }}</strong> <hr></div> --}}

                <div class="card-body">
                    {{-- form starts --}}
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        {{-- @csrf --}}

                    <div class=" ">
                        {{-- first column --}}
                        <div class="col-md-6">
                            {{-- full-name --}}
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-8">
                                    <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>

                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- userName --}}
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-8">
                                    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="Username" autofocus>

                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- e-mail --}}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- user-type --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Select User Type</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="user_type">
                                        <option value="" disabled="" selected>--Select Any One --</option>
                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>
                                        <option value="account">Account</option>
                                    </select>

                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert" >
                                            <strong>{{ $message }} </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- status --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{__('User Status')}} </label>
                                <div class="col-md-8">
                                    <select class="form-control" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert" >
                                            <strong>{{ $message }} </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            {{-- password --}}
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- re-password --}}
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                        </div>

                        {{-- second column --}}
                        <div class="col-md-6">
                            {{-- contact --}}
                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact No.') }}</label>

                                <div class="col-md-8">
                                    <input id="contact" type="phone" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" autocomplete="contact" autofocus>

                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- join-date --}}
                            <div class="form-group row">
                                <label for="join_date" class="col-md-4 col-form-label text-md-right">{{ __('Joined Date') }}</label>

                                <div class="col-md-8">
                                    <input id="join_date" type="date" class="form-control @error('join_date') is-invalid @enderror" name="join_date" value="{{ old('join_date') }}" placeholder="yyyy-mm-dd" autocomplete="join_date" autofocus>

                                    @error('join_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Department --}}
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Department</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="department">
                                        <option value="" disabled="" selected>--Select Any One --</option>
                                        <option value="Software">Software</option>
                                        <option value="Account">Account</option>
                                        <option value="Administration">Administration</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="HR">Human Resource</option>
                                    </select>

                                    @error('department')
                                        <span class="invalid-feedback" role="alert" >
                                            <strong>{{ $message }} </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="reset" class="btn btn-danger">Clear</button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
