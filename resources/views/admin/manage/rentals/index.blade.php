@extends('layouts.admin.index')

@section('page_title', 'Rentals')

@section('styles')

@endsection


@section('header_title')
    Channel Video Rentals
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
    <div class="row .flex-md-row-reverse">
        {{-- <div class="col-sm-3  order-sm-2">

        </div> --}}
        <div class="col-sm-12  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Video Rentals </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#rentalModal"><i class="fa fa-plus"> </i> Add New</button>
                    <div class="card-tools">


                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table id="rentalTable" class="table table-hover table-sm">
                        <caption>Video Rentals</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">Video</th>
                                <th scope="col">User</th>
                                <th scope="col">Within Days</th>
                                <th scope="col">For Hours</th>
                                <th scope="col">Pubish Date</th>
                                <th scope="col">Started At</th>
                                <th scope="col">Status</th>
                                <th scope="col">Validity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rental)
                                <tr id="rentalID{{ $rental->rental_detail->id }}">
                                    <td><input type="checkbox" name="ids" class="checkBoxClass"
                                            value="{{ $rental->rental_detail->id }}" /></td>
                                    <th scope="row"> {{ $rental->rental_detail->id }}</th>
                                    <td>{{ $rental->channelvideo->title }}</td>
                                    <td>{{ $rental->user->name }}</td>
                                    <td>{{ $rental->rental_detail->within_days }}</td>
                                    <td>{{ $rental->rental_detail->for_hours }}</td>
                                    <td>{{ $rental->published_at_formatted }}</td>
                                    <td>{{ $rental->started_at_formatted }}</td>
                                    <td>
                                        @if( $rental->rental_detail->status == 0 )
                                            <i class="fa fa-circle text-danger"></i> Not Watched
                                        @elseif( $rental->rental_detail->status == 1)
                                            <i class="fa fa-circle text-warning"></i> Started Watching

                                        @elseif ($rental->rental_detail->status == 2)
                                            <i class="fa fa-circle text-success"></i> Completed Watching

                                        @endif

                                    </td>
                                    <td>
                                        @if( $rental->validity == 0 )
                                            <span class=" text-danger"><i class="fa fa-times"></i> Expired</span>
                                        @elseif( $rental->validity == 1)
                                            <span class=" text-success"><i class="fa fa-check"></i> Active</span>
                                        @endif
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="card-footer">
                    <a href="#" style="" id="deleteAllSelectedRecord" class="btn btn-xs btn-danger pull-right "
                        title="Delete All Selected">
                        <i class="fa fa-trash"></i> Delete Selected
                    </a>
                </div>

            </div>

        </div>
    </div>


@endsection


@section('modals')

    <!-- Add New Modal -->
    @include('admin.manage.rentals.create_modal')


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
        $(document).ready(function() {

            //Initialize datetimepicker
            $('#pubilsh_date input').datetimepicker({
                format: 'LT'
            });
            // $('#pubilsh_date input').datetimepicker('date', moment());

            function formatVideosResult(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "{{ asset('storage/') }}";
                // var path = "images/c/thumb/channelvideo.jpg";
                var path = state.thumb_image_url != null ? state.thumb_image_url :
                    "images/c/thumb/channelvideo.jpg";
                var $state = $(
                    '<span><img style="max-width:90px;" src="' + baseUrl + '/' + path +
                    '" class="img-flag" /> ' + state.text + '</span>'
                );
                console.log($state);

                return $state;
            };

            function formatUsersResult(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "{{ asset('storage/') }}";
                var path = state.profile_photo_url;
                var $state = $(
                    '<span><img style="max-width:90px;" src="' +  path +
                    '" class="img-flag" /> '+ state.id + '  - ' + state.text + ' ('+ state.email +')' +  ' | '+ state.phone_number +'</span>'
                );
                console.log($state);

                return $state;
            };

            function formatResult(result) {
                if (!result.id) return result.text;

                var myElement = $(result.element);

                var baseUrl = "{{ asset('storage/') }}";
                var path = result.profile_photo_url;
                // var markup = '<div class="clearfix">' +
                //     '<h4>' + result.text + '</h4>' +
                //     '<p>' + $(myElement).data('name') + '</p>' +
                //     '</div>';
                var markup = '<span><img style="max-width:90px;" src="' + path +
                    '" class="img-flag" /> ' + $(myElement).data(text) + '</span>';

                return markup;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.select-subscribers').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#rentalModal'),
                templateResult: formatUsersResult,

                ajax: {
                    url: "{{ route('admin.search.users') }}",
                    type: 'post',
                    // data: {
                    //     _token: $("input[name=_token]").val(),
                    // },
                    dataType: 'json',
                    delay: 250,
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    processResults: function(data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data
                        };
                    },

                    // cache: true
                },

            });


            initRentalTable();
            initdatetimePicker();


            var list = @json($channelvideos);

            $('.select-videos').select2({
                theme: 'bootstrap4',
                data: list,
                templateResult: formatVideosResult,
                dropdownParent: $('#rentalModal')
            });


            $('#rentalModal').on('hide.bs.modal', function(event) {
                $('#rentalForm')[0].reset();

                $('#publish_date').datetimepicker("date", null);

            });




            $('#scheduleForm').on('submit', function(e) {
                e.preventDefault();

                // url = url.replace(':gize_channel_id', gize_channel_id);

                let _token = $('input[name=_token]').val();

                publish_date = $('#publish_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');

                name = $('.select-video').select2('data');
                // var data = $('your-original-element').select2('data')
                // alert($('.select-video'));
                // alert(data[0].id);

                // console.log(name);
                // batch_id = $('#period_batch_id').val();

                formData = new FormData(this);
                formData.append('starts_at', starts_at);
                formData.append('ends_at', ends_at);
                formData.append('type', 'create');
                // formData.append('name', name);

                let url = "route('admin.manage.rental.add', ['gize_channel_id' => ':gize_channel_id'])";
                url = url.replace(':gize_channel_id', "{{ $gize_channel->id }}");

                $.ajax({
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: "POST",

                    success: function(data) {
                        displayMessage("Video Schedule created.");

                        calendar.fullCalendar('renderEvent', {
                            id: data.id,
                            title: data.title,
                            start: starts_at,
                            end: ends_at,
                            // allDay: allDay
                        }, true);

                        calendar.fullCalendar('unselect');
                        $('#scheduleModal').modal('hide');
                    }
                });

                // $.ajax({
                //     url: url,
                //     type: 'POST',
                //     data: formData,
                //     contentType: false,
                //     processData: false,
                //     success: function(response) {
                //         //Refresh page.
                //         let url = "{{ route('admin.manage.batch.subscription.index', ['gize_channel_id' => ':gize_channel_id', 'batch_id' => ':batch_id']) }}";
                //         let gize_channel_id = "{{ $gize_channel->id }}";
                //         url = url.replace(':gize_channel_id', gize_channel_id);
                //         url = url.replace(':batch_id', batch_id);

                //         window.location.replace(url);

                //     },
                //     error: function(xhr) {},
                // });
            });

            function initdatetimePicker() {
                $('#publish_date').datetimepicker();
            }

            function initRentalTable() {
                $("#rentalTable").DataTable({

                    'createdRow': function(row, data, dataIndex) {

                        if ($(' th:nth-child(2)', row).html() != undefined) {
                            idAttribute = 'rentalid' + $(' th:nth-child(2)', row).html().toString().replace(
                                ' ', '');
                            $(row).attr('id', idAttribute);
                        }

                    },

                    order: [
                        [1, 'desc']
                    ],
                }).buttons().container().appendTo('#rentalTable_wrapper .col-md-6:eq(0)');
            }

        });

        //Handle Add New Modal...
        $('#rentalModal').on('hide.bs.modal', function(event) {
            // $('#rentalForm')[0].reset();
        });

        $('#rentalModal').on('show.bs.modal', function(event) {
            // $('#rentalForm')[0].reset();
            $('.btn-submit').removeClass('disabled');

        });



        //Handle Edit Modal...
        $('#rentalEditModal').on('show.bs.modal', function(event) {
            // console.log('showing Edit modal');
            var button = $(event.relatedTarget) // Button that triggered the modal

            let id = button.data('id') // Extract info from data-* attributes


            var modal = $(this);
            modal.find('.modal-title').text('Edit Book Fomrat (ID:' + id + ')');

            $('#id').val(button.data('id'));
            $('#name_ed').val(button.data('name'));



            $('#btn-update-submit').removeAttr('disabled');

        });


        $('#rentalEditModal').on('hide.bs.modal', function(event) {
            $('#btn-update-submit').attr('disabled', 'disabled');
            // $('#rentalEditForm')[0].reset();
            // console.log("edit modal hidden");
        });



        //Add New Book Format

        $('#rentalForm').submit(function(e) {
            e.preventDefault();
            $('.btn-submit').addClass('disabled');

            let formData = new FormData($('#rentalForm').get(0));

            let user_id = $('#select_subscriber').val();
            let channelvideo_id = $('#select_video').val();
            let for_hours = $('#for_hours').val();
            let within_days = $('#within_days').val();
            let publish_date = $('#publish_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');

            let _token = $('input[name=_token]').val();

            formData.append("user_id", user_id);
            formData.append("channelvideo_id", channelvideo_id);
            formData.append("for_hours", for_hours);
            formData.append("within_days", within_days);
            formData.append("published_at", publish_date);
            formData.append("_token", _token);

            let url = "{{ route('admin.manage.rental.add', ['gize_channel_id' => ':gize_channel_id']) }}";
            url = url.replace(':gize_channel_id', "{{ $gize_channel->id }}");



            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response) {

                        let tableRowHtml = '<tr id="rentalID' + response.id +
                            '"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/></td>' +
                            '<th>';

                        tableRowHtml += response.id + '</th>';
                        tableRowHtml += '<td>' + response.channelvideo.title + '</td>';
                        tableRowHtml += '<td>' + response.user.name + '</td>';
                        tableRowHtml += '<td>' + response.within_days + '</td>';
                        tableRowHtml += '<td>' + response.for_hours + '</td>';
                        tableRowHtml += '<td>' + response.published_at_formatted + '</td>';
                        tableRowHtml += '<td>' + response.started_at_formatted + '</td>';

                        let status = "";
                        if(response.status == 0) {
                            status = '<i class="fa fa-circle text-danger"></i> Not Watched';
                        }
                        else if(response.status == 1) {
                            status = '<i class="fa fa-circle text-warning"></i> Started Watching';
                        }
                        else if(response.status == 2) {
                            status = '<i class="fa fa-circle text-success"></i> Completed Watching';
                        }
                        tableRowHtml += '<td>' + status + '</td>';

                        let validity = "";
                        if(response.validity == 0) {
                            validity = '<span class=" text-danger"><i class="fa fa-times"></i> Expired</span>';
                        }
                        if(response.validity == 1) {
                            validity = '<span class=" text-success"><i class="fa fa-check"></i> Active</span>';
                        }
                        tableRowHtml += '<td>' + validity + '</td>';


                        $('#rentalTable tbody').prepend(tableRowHtml);

                        $('#rentalForm')[0].reset();
                        $('#rentalModal').modal('hide');

                        //bug fix.. for not hiding modal window
                        // $('.modal').hide();

                        //bug fix... for not hiding  modal backdrop
                        // $('.modal-backdrop').hide();

                        //bug fix... advertize modal again
                        // $('.modal').modal('toggle');

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            title: 'Record created',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(xhr) {
                    $('#validation-errors').html('');
                    let errMsgs = "";
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        // $('#validation-errors').append('<div class="alert alert-danger">' +
                        //     value + '</div');
                        errMsgs += '' + value + '<br/>';


                    });
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message,
                        html: errMsgs,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })
                }
            });
        });



        //Multiple Delete Book Formats and their related files
        $('#chkCheckAll').click(function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

    </script>
@endsection
