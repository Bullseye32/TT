@extends('layouts.app')
@section('page-title')
    Task Detail View
@stop
@section('content')
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <h3 ><i class="fa fa-bars" style="color: green;padding-right: 15px;font-size: 25px;"></i>{{ $tasks->taskName }}</h3>
        </div>

        <div class="panel-body">

            @if (\Auth::user()->user_type == 'admin')
                <strong>Assigned To : </strong>
                @if($assigned->count() == 0)
                    <span class="label label-danger">No Staffs Assigned</span>
                @endif

                @foreach ($assigned as $assign)
                    <span class="label label-primary">{{ $assign->full_name }}</span>
                @endforeach
                <hr>
            @endif

            <strong>Assigned date : </strong>{{ date_format($tasks->created_at,"d - M - Y (D)") }}
            <hr>
            <strong>Deadline : </strong>{{ $tasks->deadline }}
            <hr>
            <strong>Task Description: </strong>{{ $tasks->description }}
            <hr>

            <strong>Task Priority: </strong>
                @if($tasks->priority == 1)
                    <span class="label label-default">Normal</span>
                @elseif($tasks->priority == 2)
                    <span class="label label-warning">Important</span>
                @else
                    <span class="label label-danger">Urgent</span>
                @endif
            <hr>
            @if(!empty($tasks->type))
                <strong>Task Type: </strong>
                    @if($tasks->type == "new")
                        <span class="label label-default">New</span>
                    @else
                        <span class="label label-warning">Maintenance</span>
                    @endif
                <hr>
             @endif
                @if( !empty($tasks->clientName) || !empty($tasks->clientNumber) || !empty($tasks->clientLatitude) || !empty($tasks->clientLongitude))
                <table class="table table-bordered">
                    <tr>
                        <th colspan="4" style="text-align: center;">Client Information</th>
                    </tr>
                    <tr>
                        @if(!empty($tasks->clientName))<th>Name</th> @endif
                        @if(!empty($tasks->clientNumber))<th>Contact Number</th>@endif
                        @if(!empty($tasks->clientLatitude) && !empty($tasks->clientLongitude))<th>Map</th>@endif
                    </tr>
                    <tr>
                        @if(!empty($tasks->clientName)) <td>{{ucfirst($tasks->clientName)}}</td>@endif
                        @if(!empty($tasks->clientNumber))<td>{{ $tasks->clientNumber }}</td>@endif
                        @if(!empty($tasks->clientLatitude) && !empty($tasks->clientLongitude))
                            <td>
                                <a target="_blank" href="{{'https://www.google.com/maps/place/'.$tasks->clientLatitude.','.$tasks->clientLongitude}}">
                                    <i class="fa fa-map-marker"></i>
                                    Show in Map
                                </a>
                            </td>
                        @endif

                    </tr>

                </table>
                @endif

           {{-- @if (Auth::user()->user_type ==1)
                <a href="{{ route('task.edit',$tasks->id) }}" class="btn btn-default">Edit </a>
                <a href="{{ route('task.delete',$tasks->id) }}" class="btn btn-default">Delete</a>
            @endif--}}
        </div>
    </div>

    {{--change status--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-white post panel-shadow" ><br>

                <div class="default-spacer">
                    <strong>Task status:</strong>
                        @if($tasks->status==0)
                            <span class="label label-primary">New</span>
                        @elseif($tasks->status==1)
                            <span class="label label-warning">Opened</span>
                        @elseif($tasks->status==2)
                            <span class="label label-danger">Pending</span>
                        @elseif($tasks->status==3)
                            <span class="label label-success">Completed</span>

                        @endif
                    <hr>
                    <strong>Change status</strong>
                        <a data-toggle="tooltip" data-placement="bottom" title="change the status of this task">
                            <i class="fa fa-question-circle"></i>
                        </a>
                        {{-- open task //also status is increased by 1 than previous status --}}
                    <button type="button" class="btn btn-link  btn-sm" data-toggle="modal" data-target="#statusModal" data-task_id={{$tasks->id}} data-task_status=1 @if( $tasks->status !=0) disabled  @endif>Open</button>
                        {{-- Append task --}}
                    <button type="button"  class="btn btn-link btn-sm" data-toggle="modal" data-target="#statusModal" data-task_id={{$tasks->id}} data-task_status=2 @if($tasks->status !=1) disabled  @endif>Append</button>
                        {{-- mark completed --}}
                    <button type="button"  class="btn btn-link btn-sm" data-toggle="modal" data-target="#statusModal" data-task_id={{$tasks->id}} data-task_status=3 @if($tasks->status !=2) disabled  @endif>Mark as Completed</button>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    {{--remarks panel--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-white post panel-shadow" ><br>
                <h4 class="list-group-item-heading default-spacer">
                    Remarks:
                </h4>
                <div class="panel panel-white post panel-shadow" >
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Remarks</th>

                                <th>Status</th>
                                <th>File</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($remarks as $data)
                                <tr>
                                    <td>{{$loop->iteration }} </td>
                                    <td>{{ ucfirst($tasks->taskName )}}</td>
                                    @if(($data->remarks))
                                        <td>{{ ucfirst($data->remarks) }}<br>Remarked By @

                                            <a href="">{{ $data->remarkedBy->user_name}}</a> </td>
                                    @else
                                        <td>No Remarks Added</td>
                                    @endif

                                    @if($data->status==0)
                                        <td class="list-group-item-text">
                                            <span class="label label-primary">New</span>
                                        </td>
                                    @elseif($data->status==1)
                                        <td class="list-group-item-text">
                                            <span class="label label-warning">Opened</span>
                                        </td>
                                    @elseif($data->status==2)
                                        <td class="list-group-item-text">
                                            <span class="label label-danger">Pending</span>
                                        </td>
                                    @elseif($data->status==3)
                                        <td class="list-group-item-text">
                                            <span class="label label-success">Completed</span>
                                        </td>
                                    @endif

                                    <td>
                                        @if($data->status== 3 && !empty($tasks->file))
                                            <a href="{{ asset(STATIC_DIR.'storage/'.$tasks->file) }}" target="_blank" class="btn btn-default btn-block">View</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

        </div>
                </div>
            </div>
        </div>
    </div>
    {{--end remarks --}}


    <h3>Comments</h3>
    <div class="default-row-spacer">
        <div class="row">
            <div class="col-md-12">
                <div class="widget-area no-padding blank">
                    <div class="status-upload">

                        <form action="{{ route('comment',$tasks->id) }}" method="post">
                            {{ csrf_field() }}
                            <textarea placeholder="Write a comment for this task?" name="comment" ></textarea>
                            <ul>
                                <li><a title="" data-toggle="modal" data-target="#myModal3" data-placement="bottom" data-original-title="Audio"><i class="fa fa-upload"></i></a></li>
                            </ul>
                            <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Comment</button>
                        </form>
                    </div><!-- Status Upload  -->
                </div><!-- Widget Area -->
            </div>
        </div>
    </div>
    <div id="myModal3" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Upload .Zip files</h4><br>
                    <form action="" method="post">
                        <input type="file" value="" name="file" class="form-control" /><br>
                        <input type="submit" class="btn btn-default" value="Upload" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        @foreach ($tasks->comments->sortByDesc('created_at') as $comment)
            <div class="col-sm-12">
                <div class="panel panel-white post panel-shadow" >
                    <div class="post-heading">
                        <div class="pull-left image">
                            @if (!empty($comment->user->profile_image))
                                <img src="{{ asset('/public/storage/'.$comment->user->profile_image) }}" class="img-circle avatar" alt="user profile image">
                            @else
                                <img src="{{ asset(DEFAULT_USER) }}" class="img-circle avatar" alt="user profile image">
                            @endif
                        </div>
                        <div class="pull-left meta">
                            <div class="title h5">
                                <a href="#"><b>{{ $comment->user->full_name }}</b></a>
                                commented.
                            </div>
                            <h6 class="text-muted time">{{ $comment->created_at->diffForHumans()}}</h6>
                        </div>
                    </div>
                    <div class="post-description">
                        <p>{{ $comment->comment }}</p>
                        @if ($comment->user->id==Auth::user()->id)
                            <div class="stats">
                                <a href="{{ route('comment.update',$comment->id) }}" class="btn btn-default stat-item" >
                                    Edit
                                </a>
                                <a href="{{ route('comment.delete',$comment->id) }}" class="btn btn-default stat-item">
                                    Delete
                                </a>
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        @endforeach
    </div> --}}
    @include('pages.task.modal_status')

@endsection

@section('script')
    <script type="text/javascript">

        $('#statusModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let task_status = button.data('task_status')
            let task_id = button.data('task_id')

            let modal = $(this)
            modal.find('.modal-body #task_status').val(task_status)
            modal.find('.modal-body #task_id').val(task_id)

            //    if status is 3 let user to upload file too.
            if(task_status == 3){
                modal.find('.modal-body #file_upload').show()
            }
            else{
                modal.find('.modal-body #file_upload').hide()

            }
        })


    </script>
@endsection
