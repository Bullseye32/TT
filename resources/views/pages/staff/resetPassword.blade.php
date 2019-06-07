@extends('layouts.app')
@section('content')
           <br>
          <div class="container">
          	<div class="row">
           <div class="col-md-4 ">
           <form action="{{ route('password.update',Auth::user()->id) }}" method='POST'>
           	{{ csrf_field() }}
               <div class="form-group">
                   <label for="" class="control-label">
                       Old Password
                   </label>
                   <input type="password" name="old_password" id="" class="form-control" placeholder="Enter your current password.">
                   @if($errors->has('old_password'))
                       <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('old_password') }}</strong>
                       </span>
                    @endif
               </div>

               <div class="form-group">
                   <label for="" class="control-label">
                       New password
                   </label>
                   <input type="password" name="new_pass" id="" class="form-control" placeholder="Enter New Password.">
                   @if($errors->has('new_pass'))
                       <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('new_pass') }}</strong>
                       </span>
                   @endif
               </div>

               <div class="form-group">
                   <label for="" class="control-label">
                       Confirm New password
                   </label>
                   <input type="password" name="confirm_pass" id="" class="form-control" placeholder="Confirm New Password.">
                   @if($errors->has('confirm_pass'))
                    <span class="help-block">
                        <strong style="color:red;">{{ $errors->first('confirm_pass') }} </strong>
                    </span>
                   @endif
               </div>

               <div class="form-group">
                       <input type="submit" value="Change" class="btn btn-success">
               </div>

           </form>
           </div>
           </div>
          </div>


@endsection
