@extends('layouts.admin.index')

@section('page_title', 'Channel Video Batch Views')

@section('styles')

@endsection


@section('header_title')
    Channel Video Batch Views
@stop

@section('navbar')
    @include('admin.navbar')
@endsection


@section('notifications-dropdown')
    @include('admin.navbar-notifications-dropdown')
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('content')

Batch User
<input value="1" id="input_batch_user" name="input_batch_user"/><br/>
@csrf

Batch Channelvideo
<input value="6" id="input_batch_channelvideo" name="input_batch_channelvideo"/>
<button class="btn btn-primary btn-sm btn-markstarted">Mark Started</button><br/>
<button class="btn btn-primary btn-sm btn-markcompleted">Mark Completed</button>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('vendors/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js') }}">
    </script>

    <script>
        $(function(){
            $('.btn-markstarted').on('click', function(e){
                let url = "{{ route('admin.manage.batch.video_view.markstarted', ['batch_channelvideo_id' => ':batch_channelvideo_id']) }}";

                let batch_channelvideo_id = $('#input_batch_channelvideo').val();

                url = url.replace(':batch_channelvideo_id', batch_channelvideo_id);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token : $("input[name=_token]").val(),
                        batch_channelvideo_id: batch_channelvideo_id,
                    },
                    success: function(response){
                        alert('done');
                    }
                });

            });


            $('.btn-markcompleted').on('click', function(e){
                let url = "{{ route('admin.manage.batch.video_view.markcompleted', ['batch_channelvideo_id' => ':batch_channelvideo_id']) }}";

                // let user_id = $('#input_batch_user').val();
                let batch_channelvideo_id = $('#input_batch_channelvideo').val();

                // url = url.replace(':user_id', user_id);
                url = url.replace(':batch_channelvideo_id', batch_channelvideo_id);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token : $("input[name=_token]").val(),
                        batch_channelvideo_id: batch_channelvideo_id,
                    },
                    success: function(response){
                        alert('done');
                    }
                });

            });
        });
    </script>



@endsection