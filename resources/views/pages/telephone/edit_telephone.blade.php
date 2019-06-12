@extends('layouts.app')
@section('page-title','Update Coontacts')

@section('css')
    <link rel="stylesheet" href="{{ asset(STATIC_DIR.'css/jquery.dataTables.min.css') }}">
    <link href="{{ asset(STATIC_DIR.'css/style.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <div class="white-box">
        <div class="row">
            <div class="col-md-8">
                {{-- <h2>Edit Employee Telephone Registration</h2> --}}
                {{-- {{ $data }} --}}
                {{-- {!! dd($data) !!} --}}

                <form action="{{route('telephone.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="telephone_id" value="{{ $data->id }}">

                    <div class="form-group">
                        <label for="" class="control-label" >Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" readonly value="{{ $data->user_info->full_name }} ">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Department: <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" readonly value="{{ $data->user_info->department }} ">
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label" >Post <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" readonly value="{{ $data->user_info->user_type }}">
                    </div>

                    <div class="form-group">
                        <label for=""  class="control-label">Contact Number <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="contact" min="0" placeholder="Enter Contact Number" required value="{{old('contact') ?? $data->contact }}">
                        @if($errors->has('contact'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('contact')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Extension Number</label>
                        <input type="number" class="form-control" name="ext_number" min="0" placeholder="Enter Extension Number" value="{{old('ext_number') ?? $data->ext_number}}">
                        @if($errors->has('ext_number'))
                            <span class="help-block" style="color:red;">
                                 {{$errors->first('ext_number')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>

                </form>
            </div>


        </div>
    </div>
@endsection

@section('script')
@endsection
