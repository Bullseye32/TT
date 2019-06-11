@extends('layouts.app')
@section('page-title')
    Register New Telephone
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset(STATIC_DIR.'css/jquery.dataTables.min.css') }}">
    <link href="{{ asset(STATIC_DIR.'css/style.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <div class="white-box">
        <div class="row">
            <div class="col-md-8">
                <h2>Edit Employee Telephone Registration</h2>

                <form action="{{route('telephone.update_telephone')}}" method="POST">
                    <input type="hidden" name="telephone_id" value="{{$telephone->id}}">
                    @csrf
                    <div class="form-group">
                        <label for="" class="control-label" >Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Employee Name" required value="{{old('name') ?? $telephone->name}}" >
                        @if($errors->has('name'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('name')}}
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Department: <span style="color: red;">*</span></label>
                        <select name="department" class="form-control" id="exampleFormControlSelect1" required>
                            <option disabled="">Select One Department</option>
                            <option value="Software" {{ ( (old('department')  ?? $telephone->department) == 'Software') ? "selected" : '' }}>Software </option>
                            <option value="Marketing" {{ ( (old('department') ?? $telephone->department) == 'Marketing') ? "selected" : '' }}>Marketing</option>
                            <option value="Human Resource" {{ (  (old('department') ?? $telephone->department) == 'Human Resource') ? "selected" : '' }}>Human Resource </option>
                            <option value="Account" {{ ( (old('department')?? $telephone->department) == 'Account') ? "selected" : '' }}>Account</option>
                            <option value="Administration" {{ (  (old('department') ?? $telephone->department) == 'Administration') ? "selected" : '' }}>Administration </option>
                            <option value="Hardware" {{ (  (old('department') ?? $telephone->department) == 'Hardware') ? "selected" : '' }}>Hardware </option>
                        </select>

                        @if($errors->has('department'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('department')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label" >Post <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="post"  placeholder="Enter Employee Post" required value="{{old('post') ?? $telephone->post}}">
                        @if($errors->has('post'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('post')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for=""  class="control-label">Contact Number <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="contact" min="0" placeholder="Enter Contact Number" required value="{{old('contact') ?? $telephone->contact}}">
                        @if($errors->has('contact'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('contact')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Extension Number</label>
                        <input type="number" class="form-control" name="ext_number" min="0" placeholder="Enter Extension Number" value="{{old('ext_number') ?? $telephone->ext_number}}">
                        @if($errors->has('ext_number'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('ext_number')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Edit" class="btn btn-primary">
                    </div>

                </form>
            </div>


        </div>
    </div>
@endsection

@section('script')
@endsection
