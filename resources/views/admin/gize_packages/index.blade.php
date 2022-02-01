@extends('layouts.admin.index')

@section('page_title', 'Rentals')

@section('styles')

@endsection


@section('header_title')
    Gize Package Topup Management
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
                    <h3 class="card-title">Gize Packages Topup Management </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#packageModal"><i class="fa fa-plus"> </i> Add New</button>
                    <div class="card-tools">


                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table id="packageTable" class="table table-sm  table-responsive-md table-hover table-sm">
                        <caption>Gize Package Topups</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Package</th>
                                <th scope="col">Initial Value</th>
                                <th scope="col">Remaining Balance</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">Expires At</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_gize_packages as $package)
                            <tr id="userPackageID{{ $package->id }}">
                                <td scope="col"><input type="checkbox"  name="ids" class="checkBoxClass"
                                    value="{{ $package->id }}" /></td>
                                <td scope="col">{{ $package->id }}</td>
                                <td scope="col">{{ $package->user->name }} <br/>
                                E: {{ $package->user->email }}<br/>
                                P: {{ $package->user->phone_number }}</td>
                                <td scope="col">{{ $package->gize_package->code }} | {{ $package->price }} </td>
                                <td scope="col">{{ $package->gize_package->for_unit_values }}</td>
                                <td scope="col">{{ $package->unit_values_balance }}</td>
                                <td scope="col">{{ $package->start_date_formatted }}</td>
                                <td scope="col">{{ $package->status ? $package->expires_at : '' }}</td>
                                <td scope="col">{{ $package->status ? 'Active' : 'Expired' }}</td>
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
    @include('admin.gize_packages.create_modal')


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

            function formatResult(state) {
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
                dropdownParent: $('#packageModal'),
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

            var list = @json($gize_packages);


            $('.select-packages').select2({
                theme: 'bootstrap4',
                data: list,
                // templateResult: formatResult,
                dropdownParent: $('#packageModal')
            });


            $('#packageModal').on('hide.bs.modal', function(event) {
                $('#packageForm')[0].reset();

                $('#start_date').datetimepicker("date", null);

            });



            function initdatetimePicker() {
                $('#start_date').datetimepicker();
            }

            function initRentalTable() {
                $("#packageTable").DataTable({

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
                }).buttons().container().appendTo('#packageTable_wrapper .col-md-6:eq(0)');
            }

        });

        //Handle Add New Modal...
        $('#packageModal').on('hide.bs.modal', function(event) {
            // $('#packageForm')[0].reset();\
        });

        $('#packageModal').on('show.bs.modal', function(event) {
            // $('#packageForm')[0].reset();
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



        //Add New

        $('#packageForm').submit(function(e) {
            e.preventDefault();
            $('.btn-submit').addClass('disabled');

            let formData = new FormData($('#packageForm').get(0));

            let user_id = $('#select_subscriber').val();
            let gize_package_id = $('#select_package').val();
            let start_date = $('#start_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');

            let _token = $('input[name=_token]').val();

            let currency_code = "auth()->user()->currency_code == 'ETB'";

            formData.append("user_id", user_id);
            formData.append("gize_package_id", gize_package_id);

            formData.append("published_at", start_date);
            formData.append("_token", _token);

            let url = "{{ route('admin.manage.gizepackage.add') }}";

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response) {

                        let tableRowHtml = '<tr id="userPackageID' + response.id +
                            '"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/></td>' ;

                        tableRowHtml += '<td>' + response.id + '</td>';
                        tableRowHtml += '<td>' + response.user.name + ' <br/>E: ' + response.user.email + '<br/>P: ' + response.user.email + '</td>';
                        tableRowHtml += '<td>' + response.gize_package.code + ' | ' + response.price + '</td>';
                        tableRowHtml += '<td>' + response.gize_package.for_unit_values + '</td>';
                        tableRowHtml += '<td>' + response.unit_values_balance + '</td>';
                        tableRowHtml += '<td>' + response.start_date_formatted + '</td>';
                        tableRowHtml += '<td>' + (response.status ? response.expires_at : '') + '</td>';
                        tableRowHtml += '<td>' + (response.status ? 'Active' : 'Expired') + '</td>';


                        let validity = "";
                        if(response.validity == 0) {
                            validity = '<span class=" text-danger"><i class="fa fa-times"></i> Expired</span>';
                        }
                        if(response.validity == 1) {
                            validity = '<span class=" text-success"><i class="fa fa-check"></i> Active</span>';
                        }
                        tableRowHtml += '<td>' + validity + '</td>';


                        $('#packageTable tbody').prepend(tableRowHtml);

                        $('#packageForm')[0].reset();
                        $('#packageModal').modal('hide');

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
                    });
                }
            });
        });



        //Multiple Delete Book Formats and their related files
        $('#chkCheckAll').click(function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

    </script>
@endsection
