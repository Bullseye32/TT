@extends('layouts.app')
@section('page-title')
    Assign Task
@stop
@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
	        <form class="form-horizontal" role="form" method="POST" action="{{ route('task.assign') }}">
		        <div class="white-box">
			        <div class="row">
						{{-- Assigned user listing --}}
				        <div class="col-md-8">
					        {{ csrf_field() }}
					        <div class="form-body">
								{{-- task select list --}}
						        <div class="form-group">
							        <label class="col-md-3 control-label">Select Task</label>
							        <div class="col-md-9">
								        <select class="form-control" name="task" id="task">
									        <option value="" >-- SELECT ONE --</option>
									        @if (!empty($task))
										        @foreach ($task as $data)
											        <option value={{ $data->id }}> {{ $data->taskName }}</option>

										        @endforeach
									        @endif
								        </select>
							        </div>
						        </div>

								{{-- list assigned users --}}
						        <div class="form-group" id="assigned_employee" style="display: none;">
							        <label class="col-md-3 control-label">Assigned Employee</label>

							        <div class="col-md-9" style="margin-left: 180px; margin-top:-35px;" >
								        <ol id="append">
                                            {{-- Assigned employee listed here using js --}}
								        </ol>
							        </div>
						        </div>

                            </div>
                        </div>


						{{-- Employee listing --}}
				        <div class="col-md-4">
					        <div class="portlet box green-meadow">
						        <div class="portlet-title">
							        <div class="caption">
								        <i class="fa fa-users fa-fw"></i>Employee List
							        </div>

						        </div>
						        <div class="portlet-body" style="overflow-y: scroll; height: 67vh;">

							        <ul class="list-group">
								        <li class="list-group-item">
									        @foreach ($staff as $name)
										        <div class="input-group form-control">
											        <input type="checkbox" class="assigned_user"
											               aria-label="..." name="staff[]"  value="{{ $name->id }}" multiple="multiple" class="form-control-sm" >
											        <strong> {{ $name->full_name }}</strong>
										        </div>
										        <br>

									        @endforeach

								        </li>

							        </ul>
                                </div>

					        </div>
				        </div>
			        </div>
                </div>

		       <div class="white-box">
			       <div class="row">
				       <div class="col-md-12">
					       <div class="form-actions text-center">
						       <a href="{{ URL::full() }}" type="button" class="btn btn-warning">Cancel</a>
						       <button type="submit" class="btn btn-success">Assign</button>
					       </div>
				       </div>
			       </div>
		       </div>
            </form>
            @php
                // Get the current URL without the query string...
                echo "Current Url:". url()->current()."<br>";
                // Get the current URL including the query string...
                echo  "Full Url:". url()->full()."<br>";
                // Get the full URL for the previous request...
                echo "Previous:".url()->previous();
            @endphp
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            let user = $('.assigned_user').val();
            console.log(user);
            // alert(user);
        });

        $(document).ready(function (){
            $("#task").on ('change',  function( e ){
				//fetches selected "task id" and stores in "task_id"
				let task_id = $('#task').val();
				console.log(task_id);

				// removes previous data from list-view
                $("#append").children("li").remove();

                //retrieving assigned user from task id.
                $.ajax({
                    type: "GET",
                    url: "{{ route('task.getAssignedUserByTaskId') }}",
                    headers: {
                        'XCSRFToken': $('meta[name="csrf_token"]').attr('content')
                    },

					data: "id=" + task_id,

					// gets data from getAssignedUserByTaskId() in var 'msg'
                    success: function (response) {
						console.log(response);
                        $('#assigned_employee').show();
                        appendlist(response.data.users);
                        // $("#check_employees").prop("checked","checked");
                        // $("#check_employees").checked = false;
                    }
                });
            });

        });

        function appendlist(users) {
			// foreach loop
            $.each(users, function () {
				console.log(this);
                $("#append").append("&nbsp;<li>" + this.full_name +"</li>");
                // $(".assigned_user").prop("checked",true);

            });
        }
    </script>
@endsection
