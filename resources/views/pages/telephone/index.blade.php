@extends('layouts.app')
@section('page-title','Telephone Listing')

@section('css')
    <link href="{{asset('css/bootstrap.min-3.3.7.css' )}} " rel="stylesheet">
    <link href="{{asset('css/dataTables.bootstrap.min-1.10.19.css' )}} " rel="stylesheet">
@stop

@section('content')
    <div class="white-box">
        <div class="row" >
            <div class="col-lg-12 col-md-12">
                <div class="main-box clearfix">
                    <div class="table-responsive" >
                        <table class="table table-striped table-bordered" id="telephone_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Post</th>
                                    <th>E-mail</th>
                                    <th>Contact Number</th>
                                    <th>Extension Number</th>
                                    @if(Auth::user()->user_type == 'admin')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            {{-- {{ $data }} --}}

                            <tbody>
                                @if(isset($data))
                                    @foreach($data as $value)
                                        {{-- {{ $value }} --}}
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $value->user_info->full_name }}</td>
                                            <td>{{ $value->user_info->department }} </td>
                                            <td>{{ $value->user_info->user_type}} </td>
                                            <td>{{ $value->user_info->email }} </td>

                                            <td>{{$value->contact}}</td>
                                            <td>{{$value->ext_number}}</td>
                                            @if(Auth::user()->user_type == 'admin')
                                            <td>
                                                    {{-- {{route('telephone.edit_telephone',$value->id)}} --}}
                                                <a href="{{ route('telephone.edit',$value->id) }} " class="btn default btn-xs blue-stripe" ><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;

                                                <a href="#deleteTelephone" class="btn default btn-xs red-stripe" data-id="{{ $value->id }}" data-toggle="modal" data-rel="delete" data-user="{{$value->user_info->full_name}}">
                                                    <i style="color:red;" class="glyphicon glyphicon-trash"></i>
                                                </a>

                                            </td>
                                            @endif
                                        </tr>
                                        {{-- @endforeach --}}
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @include('pages.telephone.modal')
@endsection

@section('script')
    {{-- data-table --}}
    <script type="text/javascript" src="{{ asset(STATIC_DIR.'js/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset(STATIC_DIR.'js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(STATIC_DIR.'js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#telephone_table').dataTable( {
                "pageLength": 50,
                "lengthMenu": [ 10, 25, 50, 75, 100 ]
            } );
        } );

        $('#deleteTelephone').on('show.bs.modal', function (e) {
            //e.preventDefault();
            var button = $(e.relatedTarget);
            var id = button.data('id');
            var user = button.data('user');

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modalfooter #confirm').data('form', form);
            // sends value to <input type="hidden" id="user_id">
            $("#user_id").val(id);
            $(".hidden_title").html(' "' + user + '" ');

            // var modal = $(this)
            // modal.find('.modal-body #hidden_id').val(id)
        });


        $('#deleteTelephone').find('#confirm_yes').on('click', function () {

            //set csrf token

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });

            //fetching id
            var id = $("#user_id").val();

            $.ajax({
                type: "POST",
                url: "{{ route('telephone.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },

                data: "id=" + id,

                success: function (msg) {
                    console.log(msg);
                    // alert(msg.error);
                    // if(msg.error == false){
                    //     $("#deleteTelephone").modal("hide");
                    //     $('#showMessage').find('.success').show();
                    //     $("#showMessage").modal("show");
                    // }
                    // else
                    // {
                    //     $("#deleteTelephone").modal("hide");
                    //     $('#showMessage').find('.error').show();
                    //     $("#showMessage").modal("show");
                    // }
                    window.location.reload();
                }
            });
        });

        $('#show_message').on('click', function () {
            window.location.reload();
        });
    </script>
@endsection
