@extends('layouts.app')
@section('page-title')
	Create Task
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('task.store') }}">
				<div class="white-box">
					<div class="row">
						<div class="col-md-8">
							{{ csrf_field() }}
							<div class="form-body">
								<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
									<label class="col-md-3 control-label">Title <span style="color:red;">*</span></label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}">
										@if ($errors->has('title'))
											<span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
									<label class="col-md-3 control-label">Deadline <span style="color:red;">*</span></label>
									<div class="col-md-9">
										{{--<input type="date" id="deadline" class="form-control" placeholder="Standard" name="deadline" value="{{ old('deadline')}}">--}}
										<input type="number"  id="deadline" class="form-control" placeholder="Enter Deadline Day" name="deadline" value="{{ old('deadline')}}">
										@if ($errors->has('deadline'))
											<span class="help-block">
												<strong>{{ $errors->first('deadline') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Task Details</label>
									<div class="col-md-9">
										<textarea class="form-control" name="description" rows="4" >{{old('description')}}</textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Task Priority <span style="color:red;">*</span></label>
									<div class="col-md-9">
										<select name="priority" class="form-control" >
											<option value="1"  {{ (old('priority') == 1) ? "selected" : '' }} >Normal</option>
											<option value="2"{{ (old('priority') == 2) ? "selected" : '' }}>Important </option>
											<option value="3" {{ (old('priority') == 3) ? "selected" : '' }}>Urgent</option>
										</select>
										@if ($errors->has('priority'))
											<span class="help-block">
												<strong>{{ $errors->first('priority') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Task Type</label>
									<div class="col-md-9">
										<select name="task_type" class="form-control" >
											<option selected value=""  >Select Any Task Type</option>
											<option value="new" {{ (old('task_type') == 'new') ? "selected" : '' }}>New</option>
                                            <option value="maintenance" {{ (old('task_type') == 'maintenance') ? "selected" : '' }}>Maintenance</option>
                                            <option value="Hardware" {{ (old('task_type') =='Hardware') ? "selected":'' }}>Hardware</option>
                                            <option value="Software" {{(old('task_type') =='Software') ? "selected":'' }} >Software</option>
										</select>
										@if ($errors->has('task_type'))
											<span class="help-block">
												<strong>{{ $errors->first('task_type') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('client_name') ? ' has-error' : '' }}">
									<label class="col-md-3 control-label">Client Name: <span style="color:red;">*</span></label>
									<div class="col-md-9">
										<input type="text"  class="form-control" placeholder="Enter Client Name" name="client_name" value="{{ old('client_name')}}">
										@if ($errors->has('client_name'))
											<span class="help-block">
                                        <strong>{{ $errors->first('client_name') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('client_number') ? ' has-error' : '' }}">
									<label class="col-md-3 control-label">Client Number:</label>
									<div class="col-md-9">
										<input type="number"  class="form-control" placeholder="Enter Client Contact Number" name="client_number" value="{{ old('client_number')}}">
										@if ($errors->has('client_number'))
											<span class="help-block">
                                        <strong>{{ $errors->first('client_number') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('client_latitude') ? ' has-error' : '' }}">
									<label class="col-md-3 control-label">Latitude:</label>
									<div class="col-md-9">
										<input type="text"  class="form-control" placeholder="Enter Client Latitude" name="client_latitude" value="{{ old('client_latitude')}}">
										@if ($errors->has('client_latitude'))
											<span class="help-block">
                                        <strong>{{ $errors->first('client_latitude') }}</strong>
                                    </span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('client_longitude') ? ' has-error' : '' }}">
									<label class="col-md-3 control-label">Longitude:</label>
									<div class="col-md-9">
										<input type="text"  class="form-control" placeholder="Enter Client Latitude" name="client_longitude" value="{{ old('client_longitude')}}">
										@if ($errors->has('client_longitude'))
											<span class="help-block">
                                        <strong>{{ $errors->first('client_longitude') }}</strong>
                                    </span>
										@endif
									</div>
								</div>
							</div>
						</div>

						{{-- Employee-list with task count() --}}
						<div class="col-md-4">
							<div class="portlet box green-meadow">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-users fa-fw"></i>Employee
									</div>
								</div>
								<div class="portlet-body" style="overflow-y: scroll; height: 67vh;">
									<ul class="list-group">
										<li class="list-group-item">
											@foreach ($staff as $name)
												<div class="input-group form-control">
													<input type="checkbox" aria-label="..." name="staff[]" value="{{ $name->id }}" multiple="multiple" class="form-control-sm">
													<strong>
                                                        {{ $name->full_name }}
                                                        @if($name->whereTask->count() > 0)
                                                            <span style="color:red;">({{$name->whereTask->count()}})</span>
                                                        @endif
													</strong>
												</div>
												<br>
											@endforeach
										</li>
									</ul>
								</div>
							</div>
                        </div>
                        {{-- Employee-list ends --}}
					</div>
				</div>
				<div class="white-box">
					<div class="row">
						<div class="col-md-12">
							<div class="form-actions text-center">
								<button type="reset" class="btn btn-danger">Clear</button>
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection
