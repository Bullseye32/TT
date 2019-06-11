@extends('layouts.app')
@section('page-title','Telephone Listing')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset(STATIC_DIR.'css/jquery.dataTables.min.css') }}"> --}}
    {{-- <link href="{{ asset(STATIC_DIR.'css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
@stop

@section('content')
    <div class="white-box">
        <div class="row" >
            <div class="col-lg-12 col-md-12">
                <div class="main-box clearfix">
                    <div class="table-responsive" >
                        <table class="table table-striped table-bordered" id="myTable1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name ww</th>
                                    <th>Department</th>
                                    <th>Post</th>
                                    <th>Contact Number</th>
                                    <th>Extension Number</th>
                                    @if(Auth::user()->user_type == 1)
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @if(isset($data))
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->department}}</td>
                                            <td>{{$value->post}}</td>
                                            <td>{{$value->contact}}</td>
                                            <td>{{$value->ext_number}}</td>
                                            @if(Auth::user()->user_type == 1)
                                            <td>
                                                <a href="{{route('telephone.edit_telephone',$value->id)}}" class="btn default btn-xs blue-stripe" ><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;

                                                <a href="#deleteTelephone" class="btn default btn-xs red-stripe" data-ids="{{ $value->id }}" data-toggle="modal" data-rel="delete" data-user="{{$value->name}}">
                                                    <i style="color:red;" class="glyphicon glyphicon-trash"></i>
                                                </a>

                                            </td>
                                            @endif
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
    @include('pages.telephone.modal')
@endsection

@section('script')
    {{-- data-table --}}
    <script type="text/javascript" src="{{ asset(STATIC_DIR.'js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').dataTable( {
                "pageLength": 50,
                "lengthMenu": [ 10, 25, 50, 75, 100 ]
            } );
        } );

        $('#deleteTelephone').on('show.bs.modal', function (e) {
            //e.preventDefault();
            var button = $(e.relatedTarget);
            var ids = button.data('ids');
            var user = button.data('user');

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modalfooter #confirm').data('form', form);
            $("#hidden_id").val(ids);
            $(".hidden_title").html(' "' + user + '" ');
        });


        $('#deleteTelephone').find('#confirm_yes').on('click', function () {

            //set csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //fetching id
            var id = $("#hidden_id").val();

            $.ajax({
                type: "POST",
                url: "{{ route('telephone.delete_telephone') }}",
                headers: {
                    'XCSRFToken': $('meta[name="csrf-token"]').attr('content')
                },

                data: "id=" + id,
                success: function (msg) {
                    console.log(msg);
                    // alert(msg.error);
                    if(msg.error == false){
                        $("#deleteTelephone").modal("hide");
                        $('#showMessage').find('.success').show();
                        $("#showMessage").modal("show");
                    }
                    else
                    {
                        $("#deleteTelephone").modal("hide");
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
