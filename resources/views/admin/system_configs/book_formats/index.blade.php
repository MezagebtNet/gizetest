@extends('layouts.admin.index')

@section('title', 'System Settings')

@section('styles')

@endsection

@section('navbar')
    @include('admin.navbar')
@endsection


@section('notifications-dropdown')
    @include('admin.notifications-dropdown')
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('content')
    <div class="row .flex-md-row-reverse">
        <div class="col-sm-3  order-sm-2">

            @include('admin.system_configs.sidebar')

        </div>
        <div class="col-sm-9  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Book Format Settings </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal" data-target="#book_formatModal"><i
                            class="fa fa-plus"> </i> Add New</button>
                    <div class="card-tools">


                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table id="book_formatTable" class="table table-hover table-sm">
                        <caption>List of Book Formats</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book_formats as $book_format)
                                <tr id="book_formatID{{ $book_format->id }}">
                                    <td><input type="checkbox" name="ids" class="checkBoxClass"
                                            value="{{ $book_format->id }}" /></td>
                                    <th scope="row"> {{ $book_format->id }}</th>
                                    <td>{{ $book_format->name }}</td>
                                    <td id="{{ $book_format->id }}">
                                        <div class="row">

                                            <button data-id="{{ $book_format->id }}" data-name="{{ $book_format->name }}"
                                                class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"
                                                data-target="#book_formatEditModal" title="Edit Book Format"><i
                                                    class="fa fa-edit"></i> Edit</button>

                                            <button book_formatID="{{ $book_format->id }}"
                                                class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i
                                                    class="fa fa-trash"></i> Delete</button>




                                        </div>




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
    @include('admin.system_configs.book_formats.create_modal')

    <!-- Edit Modal -->
    @include('admin.system_configs.book_formats.edit_modal')

@endsection


@section('js')

    <script>


        //Handle Add New Modal...
        $('#book_formatModal').on('hide.bs.modal', function(event) {
            // $('#book_formatForm')[0].reset();
        });

        $('#book_formatModal').on('show.bs.modal', function(event) {
            // $('#book_formatForm')[0].reset();
        });



        //Handle Edit Modal...
        $('#book_formatEditModal').on('show.bs.modal', function(event) {
            // console.log('showing Edit modal');
            var button = $(event.relatedTarget) // Button that triggered the modal

            let id = button.data('id') // Extract info from data-* attributes


            var modal = $(this);
            modal.find('.modal-title').text('Edit Book Fomrat (ID:' + id + ')');

            $('#id').val(button.data('id'));
            $('#name_ed').val(button.data('name'));



            $('#btn-update-submit').removeAttr('disabled');

        });


        $('#book_formatEditModal').on('hide.bs.modal', function(event) {
            $('#btn-update-submit').attr('disabled', 'disabled');
            // $('#book_formatEditForm')[0].reset();
            // console.log("edit modal hidden");
        });



        //Add New Book Format

        $('#book_formatForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData($('#bookForm').get(0));
            let name = $('#name').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);
            formData.append("_token", _token);


            $.ajax({
                url: "{{ route('admin.system_configs.bookformat.add') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response) {
                        let tableRowHtml = '<tr id="book_FormatID' + response.id +
                            '"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/></td>' +
                            '<th>';

                        tableRowHtml += response.id + '</th><td>' + response.name + '</td><td id="' +
                            response.id + '">';
                        tableRowHtml += '<div class="row"> <button data-id="' + response.id + '" data-name="' + response.name + '"' +
                            '"' +
                            ' class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"' +
                            ' data-target="#book_formatEditModal" data-name="' + response.name + '" title="Edit Book Format"><i' +
                            '    class="fa fa-edit"></i> Edit</button>' +

                            '<button book_formatID="' + response.id + '"' +
                            '   class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i' +
                            '       class="fa fa-trash"></i> Delete</button> </div>';

                        $('#book_formatTable tbody').append(tableRowHtml);

                        $('#book_formatForm')[0].reset();
                        // $('#book_formatModal').modal('hide');

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


        //Edit Book Format
        $('#book_formatEditForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let id = $('#id').val();

            let name = $('#name_ed').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);


            let data = {
                bookid: id,
                name: name,
                _token: _token
            };

            $.ajax({
                url: "{{ route('admin.system_configs.bookformat.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response) {

                        $('#book_formatID' + response.id + ' td:nth-child(1)').html(
                            '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/>');
                        $('#book_formatID' + response.id + ' td:nth-child(2)').text(response.id);
                        $('#book_formatID' + response.id + ' td:nth-child(3)').text(response.name);

                        let tableRowHtml = '<div class="row"> <button data-id="' + response.id + '" data-name="' + response.name + '"' +
                            '"' +
                            ' class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"' +
                            ' data-target="#book_formatEditModal" data-name="' + response.name + '" title="Edit Book Format"><i' +
                            '    class="fa fa-edit"></i> Edit</button>' +

                            '<button book_formatID="' + response.id + '"' +
                            '   class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i' +
                            '       class="fa fa-trash"></i> Delete</button> </div>';

                        $('#book_formatID' + response.id + ' td:nth-child(4)').html(tableRowHtml);


                        $('#btn-update-submit').attr('disabled', 'disabled');


                        // $('#book_formatEditModal').modal('toggle');
                        $('#book_formatEditForm')[0].reset();

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

        //Delete Book Format Meta and its related files
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).attr('book_formatID');
            url = "{{ route('admin.system_configs.bookformat.delete', ':id') }}";
            url = url.replace(':id', id);

            if (confirm("Do you want to delete this record?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        $('#book_formatID' + id).remove();
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


        //Multiple Delete Book Formats and their related files
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
                    url: "{{ route('admin.system_configs.bookformat.deleteSelected') }}",
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val(),
                        ids: allids
                    },
                    success: function(response) {
                        $.each(allids, function(key, val) {
                            console.log(val);
                            $('#book_FormatID' + val).remove();
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
