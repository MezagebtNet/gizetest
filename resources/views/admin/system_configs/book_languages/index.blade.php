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
                    <h3 class="card-title">Book Language Settings </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <a href="#" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#book_languageModal"><i class="fa fa-plus"> </i> Add New</a>
                    <div class="card-tools">

                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table id="book_languageTable" class="table table-hover table-sm">
                        <caption>List of Book Languages</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Native Name</th>
                                <th scope="col">Code</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book_languages as $book_language)
                                <tr id="book_languageID{{ $book_language->id }}">
                                    <td><input type="checkbox" name="ids" class="checkBoxClass"
                                            value="{{ $book_language->id }}" /></td>
                                    <th scope="row"> {{ $book_language->id }}</th>
                                    <td>{{ $book_language->language_name }}</td>
                                    <td>{{ $book_language->language_native_name }}</td>
                                    <td>{{ $book_language->language_code }}</td>
                                    <td id="{{ $book_language->id }}">
                                        <div class="row">

                                            <button class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"
                                                data-target="#book_languageEditModal" data-id="{{ $book_language->id }}"
                                                data-language_name="{{ $book_language->language_name }}"
                                                data-language_native_name="{{ $book_language->language_native_name }}"
                                                data-language_code="{{ $book_language->language_code }}"
                                                title="Edit Book Language"><i class="fa fa-edit"></i> Edit</button>

                                            <button book_languageID="{{ $book_language->id }}"
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
    @include('admin.system_configs.book_languages.create_modal')

    <!-- Edit Modal -->
    @include('admin.system_configs.book_languages.edit_modal')

@endsection


@section('js')

    <script>
        //Handle Add New Modal...
        $('#book_languageModal').on('hide.bs.modal', function(event) {
            $('#book_languageForm')[0].reset();
        });

        $('#book_languageModal').on('show.bs.modal', function(event) {
            $('#book_languageForm')[0].reset();
        });



        //Handle Edit Modal...
        $('#book_languageEditModal').on('show.bs.modal', function(event) {
            // console.log('showing Edit modal');
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id') // Extract info from data-* attributes

            let modal = $(this);
            modal.find('.modal-title').text('Edit Book Language (ID:' + id + ')');
            $('#id').val(button.data('id'));
            $('#language_name_ed').val(button.data('language_name'));
            $('#language_native_name_ed').val(button.data('language_native_name'));
            $('#language_code_ed').val(button.data('language_code'));


            $('#btn-update-submit').removeAttr('disabled');

        });


        $('#book_languageEditModal').on('hide.bs.modal', function(event) {
            $('#btn-update-submit').attr('disabled', 'disabled');
            // $('#book_languageEditForm')[0].reset();
            // console.log("edit modal hidden");
        });



        //Add New Book Language

        $('#book_languageForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData($('#bookForm').get(0));
            let language_name = $('#language_name').val();
            let language_native_name = $('#language_native_name').val();
            let language_code = $('#language_code').val();
            let _token = $('input[name=_token]').val();

            formData.append("language_name", language_name);
            formData.append("language_native_name", language_native_name);
            formData.append("language_code", language_code);
            formData.append("_token", _token);


            $.ajax({
                url: "{{ route('admin.system_configs.booklanguage.add') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response) {
                        let tableRowHtml = '<tr id="book_LanguageID' + response.id +
                            '"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/></td>' +

                            '<td scope="row" style="text-align: left;">' + response.id + '</td>' +
                            '<td>' + response.language_name + '</td>' +
                            '<td>' + response.language_native_name + '</td>' +
                            '<td>' + response.language_code + '</td>' +

                            '<td id="' + response.id + '">';
                        tableRowHtml += '<div class="row"> <button data-id="' + response.id + '"' +
                            'data-language_name="' + response.language_name + '"' +
                            'data-language_native_name="' + response.language_native_name + '"' +
                            'data-language_code="' + response.language_code + '"' +
                            ' class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"' +
                            ' data-target="#book_languageEditModal" data-id="' + response.id +
                            '" title="Edit Book Language"><i' +
                            '    class="fa fa-edit"></i> Edit</button>' +

                            '<button book_languageID="' + response.id + '"' +
                            '   class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i' +
                            '       class="fa fa-trash"></i> Delete</button> </div>';

                            // alert('here');
                        $('#book_languageTable tbody').append(tableRowHtml);

                        $('#book_languageForm')[0].reset();
                        // $('#book_languageModal').modal('hide');

                        //bug fix.. for not hiding modal window
                        // $('.modal').hide();

                        //bug fix... for not hiding  modal backdrop
                        // $('.modal-backdrop').hide();

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


        //Edit Book Language
        $('#book_languageEditForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let id = $('#id').val();

            let language_name = $('#language_name_ed').val();
            let language_native_name = $('#language_native_name_ed').val();
            let language_code = $('#language_code_ed').val();
            let _token = $('input[name=_token]').val();

            formData.append("language_name", language_name);
            formData.append("language_native_name", language_native_name);
            formData.append("language_code", language_code);


            // let data = {
            //     // bookid: id,
            //     language_name: language_name,
            //     language_code: language_code,
            //     _token: _token
            // };

            $.ajax({
                url: "{{ route('admin.system_configs.booklanguage.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response) {

                        $('#book_languageID' + response.id + ' td:nth-child(1)').html(
                            '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/>');
                        $('#book_languageID' + response.id + ' td:nth-child(2)').text(response.id);
                        $('#book_languageID' + response.id + ' td:nth-child(3)').text(response
                            .language_name);
                        $('#book_languageID' + response.id + ' td:nth-child(4)').text(response
                            .language_native_name);
                        $('#book_languageID' + response.id + ' td:nth-child(5)').text(response
                            .language_code);

                        tableRowHtml = '<div class="row">' +
                            '<button class="mx-1 btn btn-xs btn-edit btn-outline-info"' +
                            'data-toggle="modal" data-target="#book_languageEditModal"' +
                            'data-id="' + response.id + '"' +
                            'data-language_name="' + response.language_name + '"' +
                            'data-language_native_name="' + response.language_native_name + '"' +
                            'data-language_code="' + response.language_code + '"' +
                            'title="Edit Book Language"><i class="fa fa-edit"></i> Edit</button>' +

                            '<button book_languageID="' + response.id + '"' +
                            'class="mx-1 btn btn-xs btn-delete btn-outline-danger"' +
                            'title="Delete"><i class="fa fa-trash"></i> Delete</button>';

                        $('#book_languageID' + response.id + ' td:nth-child(6)').html(tableRowHtml);


                        $('#btn-update-submit').attr('disabled', 'disabled');


                        // $('#book_languageEditModal').modal('toggle');
                        $('#book_languageEditForm')[0].reset();

                        //bug fix.. for not hiding modal window
                        // $('.modal').hide();

                        //bug fix... for not hiding  modal backdrop
                        // $('.modal-backdrop').hide();

                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'warning',
                            title: 'Record updated',
                            showConfirmButton: false,
                            timer: 1500
                        })

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

        //Delete Book Language Meta and its related files
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).attr('book_languageID');
            url = "{{ route('admin.system_configs.booklanguage.delete', ':id') }}";
            url = url.replace(':id', id);

            if (confirm("Do you want to delete this record?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        $('#book_languageID' + id).remove();
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


        //Multiple Delete Book Languages and their related files
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
                    url: "{{ route('admin.system_configs.booklanguage.deleteSelected') }}",
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val(),
                        ids: allids
                    },
                    success: function(response) {
                        $.each(allids, function(key, val) {
                            $('#book_LanguageID' + val).remove();
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
