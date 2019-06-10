@extends('layouts.app')
@section('page-title')
    Staff Listing
@stop
@section('css')
    {{-- <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
@stop
@section('content')
    <div class="white-box">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th><span>Users</span></th>
                                    <th><span>Username</span></th>
                                    <th><span>User Type</span></th>
                                    <th><span>Last Login</span></th>
                                    <th><span>Action</span></th>
                                </tr>
                            </thead>

                            <tbody>
                            @if(isset($staff))
                                @foreach($staff as $val)
                                    <tr>
                                        {{-- prof-image --}}
                                        <td>
                                            @if(!empty($val->profile_image))
                                                <img src="{{ asset('assets/uploads/'. $val->profile_image) }}" alt="prof_img" height="50" width="50">
                                            @else
                                                <img src="{{ asset(DEFAULT_USER) }}" alt="default" height="50px" width="50px">
                                            @endif
                                            <a href="#" class="user-link">{{ $val->full_name }} <br></a>
                                            <span class="user-subhead">
                                                @if($val->user_type == 'admin')
                                                    Admin
                                                @elseif($val->user_type == 'account')
                                                    Account
                                                @else
                                                    Staff
                                                @endif
                                            </span>
                                        </td>

                                        <td>{{ $val->user_name }}</td>
                                        {{-- user_type --}}
                                        <td>
                                            @if($val->user_type == 'admin')
                                                Admin
                                               @elseif($val->user_type == 'account')
                                                Account
                                            @else
                                                Staff
                                            @endif
                                        </td>

                                        {{-- last-login --}}
                                        <td>
                                            @if(is_null($val->updated_at))
                                                Not Logged In
                                            @else
                                                {{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}
                                            @endif
                                        </td>


                                        <td style="width: 20%;">
                                            {{-- {{ route('staff.view', $val->id) }} --}}
                                            <a href="{{ route('staff.view', $val->id) }} " class="table-link" title="View details">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x" ></i>
                                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                            </a>

                                            {{-- {{route('staff.edit',$val->id)}} --}}
                                            <a href="{{ route('staff.edit', $val->id) }} " class="table-link" title="Edit">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                        </span>
                                            </a>
                                            {{-- clicking delete icon sends to #deleteStaff --}}
                                            @if ($val->id !== Auth::user()->id)
                                                <a  href="#deleteStaff" data-key="" class="table-link danger delete" title="Delete" data-toggle="modal" data-rel="delete"
                                                data-id="{{ $val->id }}"
                                                data-role="{{ $val->user_type }} "
                                                data-user="{{$val->full_name}}">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                        {{--<div>
                            <strong>Showing {{ $assigned->firstItem() }} to {{ $assigned->lastitem() }} of {{ $assigned->total() }} entries </strong>
                        </div>--}}
                        <p>Showing {{$staff->currentPage()}} to {{$staff->perPage()}}  of {{$staff->total()}} entries </p>

                        <div align="center">
                            {{ $staff->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('pages.staff.modal')

@endsection

@section('script')
    <script>
        $('#deleteStaff').on('shown.bs.modal', function (e) {
            // console.log(e)
            //e.preventDefault();
            var button = $(e.relatedTarget);
            var id = button.data('id');
            var role = button.data('role');
            var user = button.data('user');

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modalfooter #confirm').data('form', form);
            $(".hidden_id").val(id);
            $(".user_role").html('<strong>'+ role +'</strong>');
            $(".hidden_title").html('"' + user + '"');
        });


        $('#deleteStaff').find('#confirm_yes').on('click', function () {

            //set csrf token
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            //fetching id from modal #deleteStaff
            var id = $(".hidden_id").val();

            $.ajax({
                type: "POST",
                url: "{{route('staff.delete')  }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },

                data: "id=" + id,
                success: function (msg) {
                    console.log(msg);
                    // alert(msg.error);
                    if(msg.error == false){
                        $("#deleteStaff").modal("hide");
                        $('#showMessage').find('.success').show();
                        // finds class="success" in showMessage modal & shows msg
                        $("#showMessage").modal("show");
                    }
                    else
                    {
                        $("#deleteStaff").modal("hide");
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
