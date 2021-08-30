@extends('layouts.admin.index')

@section('page_title', 'Batch')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('vendors/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet"
    href="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
<style>
    th,
    td {
        white-space: nowrap;
    }

    div.dataTables_wrapper {
        /* width: 800px; */
        margin: 0 auto;
    }

</style>
@endsection

@section('header_title')
Channel Batches Management Page
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
<li class="breadcrumb-item active">Addmes - Batches</li>
@endsection

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
    {{-- <div class="col-sm-3  order-sm-2"> --}}

    {{-- @include('admin.manage.batches.sidebar') --}}

    {{-- </div> --}}
    <div class="col-sm-12  order-sm-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Batch Settings </h3>
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                {{-- <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#batchModal"><i class="fa fa-plus"> </i> Add New</button> --}}

                <a href="{{ route('admin.manage.batch.addform') }}" class="btn ml-2 btn-xs btn-primary"><i
                        class="fa fa-plus"> </i> ADD FORM </a>
                <div class="card-tools">


                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>

            <div class="card-body">
                <div class="dataTables_wrapper">
                    @csrf
                    <table id="batchTable" style="width: 100%;" class="table table-sm">
                        <caption>List of Batches</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col" style="width:70px;">Code Name</th>
                                <th scope="col" width="150px">Description</th>
                                <th scope="col">Starting Date</th>
                                <th scope="col">Fee</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Subscription Type</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batches as $batch)
                                <tr id="batchid{{ $batch->id }}">
                                    <td><input type="checkbox" name="ids" class="checkBoxClass"
                                            value="{{ $batch->id }}" /></td>
                                    <th scope="row"> {{ $batch->id }}</th>
                                    <td>{{ $batch->code_name }}</td>
                                    <td>{{ $batch->description }}</td>
                                    <td>{{ $batch->starts_on_date }}</td>
                                    <td>{{ $batch->payment_fee }}</td>
                                    <td>{{ $batch->currency }}</td>
                                    <td>{{ $batch->subscription_type_name }}</td>
                                    <td><span class="text-info text-sm"><i class="far fa-dot-circle"></i>
                                            {{ $batch->status_name }}</span></td>
                                    <td class="mx-auto bg-white px-2 text-right " style="width: 400px;"
                                        id="{{ $batch->id }}">
                                        <div class="text-center">

                                            {{-- <button data-id="{{ $batch->id }}"
                                                    data-code_name="{{ $batch->code_name }}"
                                                    data-description="{{ $batch->description }}"
                                                    data-subscription_type="{{ $batch->subscription_type }}"
                                                    data-payment_fee="{{ $batch->payment_fee }}"
                                                    data-currency="{{ $batch->currency }}"
                                                    data-status="{{ $batch->status }}"
                                                    class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"
                                                    data-target="#batchEditModal" title="Edit Batch"><i
                                                        class="fa fa-edit"></i>
                                                    Edit</button> --}}

                                            <a href="{{ route('admin.manage.batch.editform', $batch->id) }}"
                                                class="btn btn-xs btn-success"><i class="fa fa-edit"></i> EDIT </a>

                                            <button batchid="{{ $batch->id }}"
                                                class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i
                                                    class="fa fa-trash"></i> Delete</button>




                                        </div>




                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

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
{{-- @include('admin.manage.batches.create_modal') --}}

<!-- Edit Modal -->
{{-- @include('admin.manage.batches.edit_modal') --}}

@endsection


@section('js')

<!-- DataTables  & Plugins -->
<script src="{{ asset('vendors/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
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
    $(function() {
        //Initialize Select2 Elements
        $('.select2 ').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#batchModal')
        });

        $("#batchTable").DataTable({
            // scrollY:        "100px",
            scrollX: true,
            // scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 3,
                rightColumns: 1
            }
        }).buttons().container().appendTo('#batchTable_wrapper .col-md-6:eq(0)');

        $('.dt-buttons .btn').addClass('btn-xs px-1');
        // $('#batchTable').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });

    });

    //Handle Add New Modal...
    $('#batchModal').on('hide.bs.modal', function(event) {
        $('#batchForm')[0].reset();
    });

    $('#batchModal').on('show.bs.modal', function(event) {
        $('#batchForm')[0].reset();
    });



    //Handle Edit Modal...
    $('#batchEditModal').on('show.bs.modal', function(event) {
        // console.log('showing Edit modal');
        var button = $(event.relatedTarget) // Button that triggered the modal

        let id = button.data('id') // Extract info from data-* attributes


        var modal = $(this);
        modal.find('.modal-title').text('Edit Book Fomrat (ID:' + id + ')');

        $('#id').val(button.data('id'));
        $('#code_name_ed').val(button.data('code_name'));
        $('#description_ed').val(button.data('description'));
        $('#subscription_type_ed').val(button.data('subscription_type'));
        $('#payment_fee_ed').val(button.data('payment_fee'));
        $('#currency_ed').val(button.data('currency'));
        $('#subscription_type_ed').val(button.data('subscription_type'));
        $('#status_ed').val(button.data('status'));



        $('#btn-update-submit').removeAttr('disabled');

    });


    $('#batchEditModal').on('hide.bs.modal', function(event) {
        $('#btn-update-submit').attr('disabled', 'disabled');
        // $('#batchEditForm')[0].reset();
        // console.log("edit modal hidden");
    });



    //Add New Batch

    $('#batchForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData($('#bookForm').get(0));
        let code_name = $('#code_name').val();
        let description = $('#description').val();
        let starts_on_date = $('#starts_on_date').val();
        let payment_fee = $('#payment_fee').val();
        let currency = $('#currency').val();
        let subscription_type = $('#subscription_type').val();
        let status = $('#status').val();
        let _token = $('input[name=_token]').val();

        formData.append("code_name", code_name);
        formData.append("description", description);
        formData.append("starts_on_date", starts_on_date);
        formData.append("payment_fee", payment_fee);
        formData.append("currency", currency);
        formData.append("subscription_type", subscription_type);
        formData.append("status", status);

        formData.append("_token", _token);


        $.ajax({
            url: "{{ route('admin.manage.batch.add') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                if (response) {
                    let tableRowHtml = '<tr id="batchid' + response.id +
                        '"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' +
                        response.id + '"/></td>' +
                        '<th>';

                    tableRowHtml += response.id + '</th>' +
                        '<td>' + response.code_name + '</td>' +
                        '<td>' + response.description + '</td>' +
                        '<td>' + response.starts_on_date + '</td>' +
                        '<td>' + response.payment_fee + '</td>' +
                        '<td>' + response.currency + '</td>' +
                        '<td>' + response.subscription_type_name + '</td>' +
                        '<td>' + response.status_name + '</td>' +
                        '<td id="' + response.id + '">';
                    tableRowHtml += '<div class="row"> ' +
                        // '<button data-id="' + response.id + '" ' +
                        // '"' +
                        // ' class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"' +
                        // ' data-target="#batchEditModal" ' +
                        // 'data-code_name="' + response.code_name + '" ' +
                        // 'data-description="' + response.description + '" ' +
                        // 'data-starts_on_date="' + response.starts_on_date + '" ' +
                        // 'data-payment_fee="' + response.payment_fee + '" ' +
                        // 'data-currency="' + response.currency + '" ' +
                        // 'data-subscription_type_name="' + response.subscription_type_name + '" ' +
                        // 'data-status="' + response.status + '" ' +
                        // 'title="Edit Batch"><i' +
                        // '    class="fa fa-edit"></i> Edit</button>' +

                        '<button batchid="' + response.id + '"' +
                        '   class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i' +
                        '       class="fa fa-trash"></i> Delete</button> </div>';

                    $('#batchTable tbody').append(tableRowHtml);

                    $('#batchForm')[0].reset();
                    $('#batchModal').modal('hide');

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


    //Edit Batch
    $('#batchEditForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        let id = $('#id').val();

        let code_name = $('#code_name_ed').val();
        let description = $('#description_ed').val();
        let starts_on_date = $('#starts_on_date_ed').val();
        let payment_fee = $('#payment_fee_ed').val();
        let currency = $('#currency_ed').val();
        let subscription_type = $('#subscription_type_ed').val();
        let status = $('#status_ed').val();
        let _token = $('input[name=_token]').val();

        formData.append("code_name", code_name);
        formData.append("description", description);
        formData.append("starts_on_date", starts_on_date);
        formData.append("payment_fee", payment_fee);
        formData.append("currency", currency);
        formData.append("subscription_type", subscription_type);
        formData.append("status", status);


        $.ajax({
            url: "{{ route('admin.manage.batch.update') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if (response) {

                    $('#batchid' + response.id + ' td:nth-child(1)').html(
                        '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                        response.id + '"/>');
                    $('#batchid' + response.id + ' td:nth-child(2)').text(response.id);
                    $('#batchid' + response.id + ' td:nth-child(3)').text(response.code_name);
                    $('#batchid' + response.id + ' td:nth-child(4)').text(response.description);
                    $('#batchid' + response.id + ' td:nth-child(5)').text(response
                        .starts_on_date);
                    $('#batchid' + response.id + ' td:nth-child(6)').text(response.payment_fee);
                    $('#batchid' + response.id + ' td:nth-child(7)').text(response.currency);
                    $('#batchid' + response.id + ' td:nth-child(8)').text(response
                        .subscription_type_name);
                    $('#batchid' + response.id + ' td:nth-child(9)').text(response.status_name);

                    let tableRowHtml = '<div class="row"> ' +
                        // '<button data-id="' + response.id +
                        // '" data-code_name="' + response.code_name + '"' +
                        // '"' +
                        // ' class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"' +
                        // ' data-target="#batchEditModal" ' +
                        // 'data-code_name="' + response.code_name + '" ' +
                        // 'data-description="' + response.description + '" ' +
                        // 'data-starts_on_date="' + response.starts_on_date + '" ' +
                        // 'data-payment_fee="' + response.payment_fee + '" ' +
                        // 'data-currency="' + response.currency + '" ' +
                        // 'data-subscription_type_name="' + response.subscription_type_name + '" ' +
                        // 'data-status="' + response.status + '" ' +
                        // 'title="Edit Batch"><i' +
                        // '    class="fa fa-edit"></i> Edit</button>' +

                        '<button batchid="' + response.id + '"' +
                        '   class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i' +
                        '       class="fa fa-trash"></i> Delete</button> </div>';

                    $('#batchid' + response.id + ' td:nth-child(10)').html(tableRowHtml);


                    $('#btn-update-submit').attr('disabled', 'disabled');


                    $('#batchEditModal').modal('toggle');
                    $('#batchEditForm')[0].reset();

                    //bug fix.. for not hiding modal window
                    // $('.modal').hide();

                    //bug fix... for not hiding  modal backdrop
                    // $('.modal-backdrop').hide();

                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'warning',
                        title: 'Record Updated',
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

    //Delete Batch Meta and its related files
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).attr('batchid');
        url = "{{ route('admin.manage.batch.delete', ':id') }}";
        url = url.replace(':id', id);
        el = $(this);


        if (confirm("Do you want to delete this record?")) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function(response) {
                    let table = $('#batchTable').DataTable();
                    // $('#batchid' + id).remove();

                    var row = table.row(el.parents('tr'));
                    var rowNode = row.node();
                    row.remove().draw();
                    // alert('done');
                    // table2
                    //     .row.add( rowNode )
                    //     .draw();


                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'warning',
                        title: 'Record has been deleted',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            });


        }
    });


    //Multiple Delete Batches and their related files
    $('#chkCheckAll').click(function() {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });

    $('#deleteAllSelectedRecord').click(function(e) {
        if (confirm("Do you want to delete multiple records?")) {
            e.preventDefault();
            var allids = [];


            $("input:checkbox[name=ids]:checked").each(function() {
                allids.push($(this).val());
            });

            $.ajax({
                url: "{{ route('admin.manage.batch.deleteSelected') }}",
                type: 'DELETE',
                data: {
                    _token: $("input[name=_token]").val(),
                    ids: allids
                },
                success: function(response) {
                    $.each(allids, function(key, val) {
                        console.log(val);
                        $('#batchid' + val).remove();
                    });
                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'warning',
                        title: 'Records have been deleted',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#chkCheckAll').prop('checked', false);

                }
            });
        }
    });
</script>
@endsection
