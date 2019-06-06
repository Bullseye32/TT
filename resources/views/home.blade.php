@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="white-box">
                {{-- <h3 class="box-title">Blank Starter page</h3>  --}}

                <div class="white-box">
                        <div class="row" style="min-height: 65vh;">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="myTable">
                                            <thead>
                                            <tr>
                                                <th style="width: 70px;">Task ID</th>
                                                <th>Task Title</th>
                                                <th>Assigned Date:</th>
                                                <th>Deadline</th>
                                                <th>Task Status</th>
                                                <th>Priority</th>
                                                <th>Type</th>
                                                {{--<th></th>--}}
                                                <th>Assigned By:</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                    {{-- @if ($count>0)
                                                    @foreach ($user->sortBy('status',0) as $task)
                                                        <tr class="odd gradeX">
                                                            <td onclick="trclick({{$task->id}})">{{ $loop->iteration}}</td>
                                                            <td onclick="trclick({{$task->id}})">
                                                                @if(strlen($task->name) >30)
                                                                    {{substr($task->name,0,50)}}
                                                                    </br>
                                                                    {{substr($task->name,50,strlen($task->name))}}
                    
                                                                @else
                                                                    {{$task->name}}
                                                                @endif
                                                            </td>
                                                            <td onclick="trclick({{$task->id}})">{{ date('Y-m-d', strtotime($task->created_at)) }}</td>
                                                            <td onclick="trclick({{$task->id}})">{{$task->deadline}} <br>
                                                                {{-- < ?php
                                                                // $datetime1 = new DateTime($task->deadline);
                                                                // $datetime2 = new DateTime(date('Y-m-d'));
                                                                // $difference = $datetime1->diff($datetime2);
                                                                // if($difference->days <2){
                                                                //     echo "<span style='color:darkred;'>Expiring Soon </span>";
                                                                // }
                                                                ?> --}}
                                                            {{-- </td>
                                                            <td class="center" onclick="trclick({{$task->id}})" >
                                                                @if($task->status==0)
                                                                    <p class="list-group-item-text">
                                                                        <span class="label label-primary blink_button" >New</span>
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
                                                            </td> --}}
                                                            {{--<td onclick="trclick({{$task->id}})">--}}
                                                                {{--<a href="{{ route('task.view',$task->id) }}" class="btn btn-link btn-sm btn-primary">View</a>--}}
                                                            {{--</td>--}}
                                                            {{-- <td onclick="trclick({{$task->id}})">
                                                                @if($task->priority == 1)
                                                                    <span class="label label-default">Normal</span>
                                                                @elseif($task->priority == 2)
                                                                    <span class="label label-warning">Important</span>
                                                                @else
                                                                    <span class="label label-danger">Urgent</span>
                                                                @endif
                                                            </td>
                    
                                                            <td onclick="trclick({{$task->id}})">
                                                                @if(!empty($task->task_type))
                                                                    {{ucfirst($task->task_type)}}
                                                                @else
                                                                    No Task Type Set
                                                                @endif
                                                            </td>
                                                            <td onclick="trclick({{$task->id}})">
                                                                {{ ucfirst($task->author->full_name) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-warning" role="alert"><i class="fa fa-info-circle fa-fw"></i>No task has been assigned</div> --}}
                                                {{-- @endif --}} --}}
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
