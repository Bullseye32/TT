@extends('layouts.app')
@section('page-title', 'Task Listing')
@section('css')
    <link href="{{asset('css/datatable/jquery.dataTables.min.css' )}} " rel="stylesheet">
    {{-- <link href="{{asset('css/dataTables.bootstrap.min-1.10.19.css' )}} " rel="stylesheet"> --}}
@stop

@section('content')
    <div class="white-box">
        <div class="row" style="min-height: 83vh !important;">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive" >
                        <table class="table table-striped table-bordered" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Assigned to</th>
                                <th>Assigned By</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Task Priority</th>
                                <th class="col-sm-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($task_list))
                                @foreach($task_list as $task)

                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td>
                                            @if(strlen($task->taskName) >30)
                                            {{substr($task->taskName,0,30)}}
                                            </br>
                                            {{substr($task->taskName,30,strlen($task->taskName))}}

                                            @else
                                                {{$task->taskName}}
                                            @endif
                                        </td>
                                        {{-- Assigned to --}}
                                        <td>
                                            @if($task->users->count() == 0)
                                                <strong>No Staffs Assigned</strong>
                                            @else
                                                @foreach($task->users as $value)
                                                    <li>{{$value->full_name}}</li>
                                                @endforeach
                                            @endif
                                        </td>
                                        {{-- Assigned by --}}
                                        <td>
                                            @if(isset($task->creator->full_name))
                                                <p>{{ $task->creator->full_name }}</p>
                                            @endif

                                        </td>

                                        <td>{{ $task->created_at->diffForHumans() }}</td>

                                        <td class="center">
                                            @if($task->status==0)
                                                <p class="list-group-item-text">
                                                    <span class="label label-primary">New</span>
                                                </p>
                                            @elseif($task->status==1)
                                                <p class="list-group-item-text">
                                                    <span class="label label-warning">Opened</span>
                                                </p>
                                            @elseif($task->status==2)
                                                <p class="list-group-item-text">
                                                    <span class="label label-danger">Pending</span>
                                                </p>
                                            @elseif($task->status==3)
                                                <p class="list-group-item-text">
                                                    <span class="label label-success">Completed</span>
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            {{ date_format($task->deadline, "d-M-Y") }} <br>{{$task->deadline->diffForHumans() }}
                                        </td>

                                        <td>
                                            @if($task->priority == 1)
                                                <span class="label label-blue">Normal</span>
                                            @elseif($task->priority == 2)
                                                <span class="label label-warning">Important</span>
                                            @else
                                                <span class="label label-danger">Urgent</span>
                                            @endif
                                        </td>
                                        {{-- action --}}
                                        <td style="width: 12%;" >

                                            <a href="{{ route('task.view',$task->id) }}" class="table-link" title="View details">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x" ></i>
                                                    <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>

                                            <a href="{{ route('task.edit',$task->id) }}" class="table-link" title="Edit">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a href="#deleteTask" class="table-link danger delete" title="Delete Task" data-id="{{ $task->id }}" data-toggle="modal" data-rel="delete" data-user="{{$task->taskName}}">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('pages.task.modal')
@endsection

@section('script')
    {{-- data-table --}}
    <script type="text/javascript" src="{{ asset(STATIC_DIR.'js/datatable/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').dataTable( {
                "pageLength": 50,
                "lengthMenu": [ 10, 25, 50, 75, 100 ]
            } );
        } );

        $('#deleteTask').on('show.bs.modal', function (e) {
            //e.preventDefault();
            var button = $(e.relatedTarget);
            var id = button.data('id');
            var user = button.data('user');

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modalfooter #confirm').data('form', form);
            $("#hidden_id").val(id);
            $(".hidden_title").html(' "' + user + '" ');
        });


        $('#deleteTask').find('#confirm_yes').on('click', function () {

            //set csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });

            //fetching id
            var id = $("#hidden_id").val();

            $.ajax({
                type: "POST",
                url: "{{ route('task.delete') }}",
                headers: {
                    'XCSRFToken': $('meta[name="csrf_token"]').attr('content')
                },

                data: "id=" + id,
                success: function (msg) {
                    console.log(msg);
                    // alert(msg.error);
                    if(msg.error == false){
                        $("#deleteTask").modal("hide");
                        $('#showMessage').find('.success').show();
                        $("#showMessage").modal("show");
                    }
                    else
                    {
                        $("#deleteTask").modal("hide");
                        $('#showMessage').find('.error').show();
                        $("#showMessage").modal("show");
                    }
                    // window.location.reload();
                }
            });
        });

        $('#show_message').on('click', function () {
            window.location.reload();
        });
    </script>
@endsection
