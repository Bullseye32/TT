@extends('layouts.app')
@section('page-title')
   Edit Task
@stop
@section('content')

    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('task.edit',$task_edit->id) }}">
                    <div class="row">
                        <div class="col-md-8">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label class="col-md-3 control-label">Title <span style="color:red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title') ?? $task_edit->taskName}}">
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
                                        <input type="datetime" id="deadline" class="form-control" placeholder="Standard" name="deadline" value="{{old('deadline') ?? $task_edit->deadline }}">
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
                                        <textarea class="form-control" name="description" rows="15"> {{old('description') ?? $task_edit->description }} </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Task Priority <span style="color:red;">*</span></label>
                                    <div class="col-md-9">
                                        <select name="priority" class="form-control" >
                                            <option value="1"
                                                    @if(empty(old('priority')))
                                                        {{ ($task_edit->priority == 1) ? "selected" : '' }}
                                                    @else
                                                        {{ (old('priority')  == 1) ? "selected" : '' }}
                                                    @endif
                                                   >Normal</option>
                                            <option value="2"
                                                    @if(empty(old('priority')))
                                                        {{ ($task_edit->priority == 2) ? "selected" : '' }}
                                                    @else
                                                        {{ (old('priority')  == 2) ? "selected" : '' }}
                                                    @endif
                                                  >Important </option>
                                            <option value="3"
                                                    @if(empty(old('priority')))
                                                        {{ ($task_edit->priority == 3) ? "selected" : '' }}
                                                    @else
                                                        {{ (old('priority')  == 3) ? "selected" : '' }}
                                                    @endif
                                                    >Urgent</option>
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
                                            <option selected value="" {{(old('task_type') == "") ? "selected" : ''}} >{{old('task_type')}}Select Any Task Type</option>
                                            <option value="new"
                                                @if(empty(old('task_type')))
                                                    {{ ($task_edit->taskType == "new") ? "selected" : '' }}
                                                @else
                                                    {{ (old('task_type')  == "new") ? "selected" : '' }}
                                                @endif
                                                >New</option>
                                            <option value="maintenance"
                                                @if(empty(old('task_type')))
                                                    {{ ($task_edit->taskType == "maintenance") ? "selected" : '' }}
                                                @else
                                                    {{ (old('task_type')  == "maintenance") ? "selected" : '' }}
                                                @endif
                                                >Maintenance</option>
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
                                        <input type="text"  class="form-control" placeholder="Enter Client Name" name="client_name" value="{{ old('client_name') ?? $task_edit->clientName}}">
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
                                        <input type="text"  class="form-control" placeholder="Enter Client Contact Number" name="client_number" value="{{ old('client_number') ?? $task_edit->clientNumber}}">
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
                                        <input type="text"  class="form-control" placeholder="Enter Client Latitude" name="client_latitude" value="{{ old('client_latitude') ?? $task_edit->clientLatitude}}">
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
                                        <input type="text"  class="form-control" placeholder="Enter Client Latitude" name="client_longitude" value="{{ old('client_longitude') ?? $task_edit->clientLongitude}}">
                                        @if ($errors->has('client_longitude'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('client_longitude') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions text-center">
                        <a href="{{ URL::previous() }}" type="button" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
