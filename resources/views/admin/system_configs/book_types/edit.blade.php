@extends('layouts.admin.index')

@section('title', 'System Settings')

@section('styles')
    @livewireStyles
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('navbar')
    @include('admin.navbar')
@endsection


@section('notifications-dropdown')
    @include('admin.notifications-dropdown')
@endsection

@section('content')

    <div class="row .flex-md-row-reverse">

        <div class="col-sm-3  order-sm-2">

            @include('admin.system_configs.sidebar')

        </div>

        <div class="col-sm-9  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Book Type (ID: {{ $book_type->id }}) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <form id="book_typeEditForm">
                        @csrf
                        <div class="px-4 py-2 sm:p-6">
                            <input type="hidden" class="form-control" name="id" id="id" value="{{ $book_type->id }}" />

                            <label for="name_ed" class="">Book Type
                                Name</label>

                            <input class="form-control" type="text" id="name_ed" name="name_ed" placeholder="BookType Name"
                                value="{{ old('name', $book_type->name) }}" />

                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="px-4 pt-4  text-right">
                            <a href="{{ route('admin.system_configs.booktype.index') }}" class="btn btn-default mr-2">
                                <i class="fa fa-chevron-left"> </i>  Back to List</a>
                            </a>
                            <button class="btn btn-primary ">
                                Save Changes
                            </button>
                        </div>
                    </form>
                    {{-- <hr class="pt-5" /> --}}
                    @if ($book_type->book_genres)
                        <div class="card border-light mb-3 mt-4" style="max-width: 200rem;">
                            <div class="card-header">Associated Book Genres
                                <a href="#" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                                data-target="#book_genreModal"
                                data-genre_book_type_id="{{ $book_type->id }}"
                                ><i class="fa fa-plus"> </i> Add New</a>
                            </div>



                            <div class="card-body table-responsive p-0" style="max-height: 200px;">
                                {{-- <h5 class="card-title">List of Associated Book Genres</h5> --}}
                                <table id="book_genreTable" class="table table-hover table-head-fixed table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" style="width: 30px;"><input type="checkbox"
                                                    id="chkCheckAll" /></th>
                                            <th scope="col" class="text-center" style="max-width: 40px;">Genre ID</th>
                                            <th scope="col">Genre Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book_type->book_genres as $book_genre)
                                            <tr id="book_genreID{{ $book_genre->id }}">
                                                <td class="text-center" style="width: 30px;"><input type="checkbox"
                                                        name="ids" class="checkBoxClass" value="{{ $book_genre->id }}" />
                                                </td>
                                                <th scope="row" style="max-width: 40px;" class="text-center">
                                                    {{ $book_genre->id }}</th>
                                                <td>{{ $book_genre->name }}</td>
                                                <td id="{{ $book_genre->id }}">
                                                    <div class="row">
                                                        <button class="mx-1 btn btn-xs btn-edit-genre btn-outline-info"
                                                            data-toggle="modal" data-target="#book_genreEditModal"
                                                            data-id="{{ $book_genre->id }}"
                                                            data-genre_name="{{ $book_genre->name }}"
                                                            data-genre_book_type_id="{{ $book_genre->book_type_id }}"
                                                            title="Edit Book Genre"><i class="fa fa-edit"></i> Edit</button>

                                                        <button book_genreID="{{ $book_genre->id }}"
                                                            class="mx-1 btn btn-xs btn-delete-genre btn-outline-danger"
                                                            title="Delete"><i class="fa fa-trash"></i> Delete</button>
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


                    @endif

                </div>


            </div>
        </div>
    </div>
@endsection

@section('modals')

    <!-- Add New Modal -->
    @include('admin.system_configs.book_types.create_genre_modal')

    <!-- Edit Modal -->
    @include('admin.system_configs.book_types.edit_genre_modal')

@endsection

@section('js')

    @livewireScripts

    <script>
        //Edit Book Type
        $('#book_typeEditForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let id = $('#id').val();

            let name = $('#name_ed').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);


            let data = {
                // bookid: id,
                name: name,
                _token: _token
            };

            $.ajax({
                url: "{{ route('admin.system_configs.booktype.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // console.log(response);
                    if (response) {

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

        //Handle Add New Genre Modal...
        $('#book_genreModal').on('hide.bs.modal', function(event) {
            $('#book_genreForm')[0].reset();
        });

        $('#book_genreModal').on('show.bs.modal', function(event) {
            $('#book_genreForm')[0].reset();
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id') // Extract info from data-* attributes

            let modal = $(this);
            $('#genre_book_type_id').val(button.data('genre_book_type_id'));
        });

        //Handle Edit Genre Modal...
        $('#book_genreEditModal').on('show.bs.modal', function(event) {
            // console.log('showing Edit modal');
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id') // Extract info from data-* attributes

            let modal = $(this);
            modal.find('.modal-title').text('Edit Book Genre (ID:' + id + ')');
            $('#genre_id').val(button.data('id'));
            $('#genre_name_ed').val(button.data('genre_name'));
            $('#genre_book_type_id_ed').val(button.data('genre_book_type_id'));


            $('#btn-update-submit').removeAttr('disabled');

        });


        $('#book_genreEditModal').on('hide.bs.modal', function(event) {
            $('#btn-update-submit').attr('disabled', 'disabled');
        });


        //Add New Book Genre
        $('#book_genreForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData($('#bookForm').get(0));
            let name = $('#genre_name').val();
            let book_type_id = $('#genre_book_type_id').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);
            formData.append("book_type_id", book_type_id);
            formData.append("_token", _token);


            $.ajax({
                url: "{{ route('admin.system_configs.bookgenre.add') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response) {
                        let tableRowHtml = '<tr id="book_GenreID' + response.id +
                            '"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/></td>' +
                            '<th scope="row" style="max-width: 40px;" class="text-center">' + response.id + '</th>' +

                            '<td>' + response.name + '</td>' +

                            '<td id="' + response.id + '">';
                        tableRowHtml += '<div class="row">' +
                            '<button class="mx-1 btn btn-xs btn-edit-genre btn-outline-info"' +
                            'data-toggle="modal" data-target="#book_genreEditModal"' +
                            'data-id="' + response.id + '"' +
                            'data-genre_name="' + response.name + '"' +
                            'data-genre_book_type_id="' + response.book_type_id + '"' +
                            'title="Edit Book Genre"><i class="fa fa-edit"></i> Edit</button>' +

                            '<button book_genreID="' + response.id + '"' +
                            'class="mx-1 btn btn-xs btn-delete-genre btn-outline-danger"' +
                            'title="Delete"><i class="fa fa-trash"></i> Delete</button>';

                        $('#book_genreTable tbody').append(tableRowHtml);

                        $('#book_genreForm')[0].reset();
                        // $('#book_genreModal').modal('hide');

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


        //Edit Book Genre
        $('#book_genreEditForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let id = $('#genre_id').val();

            let name = $('#genre_name_ed').val();
            let book_type_id = $('#genre_book_type_id_ed').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);
            formData.append("book_type_id", book_type_id);
            formData.append("id", id);


            // let data = {
            //     // bookid: id,
            //     genre_name: genre_name,
            //     genre_code: genre_code,
            //     _token: _token
            // };

            $.ajax({
                url: "{{ route('admin.system_configs.bookgenre.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response) {

                        $('#book_genreID' + response.id + ' td:nth-child(1)').html(
                            '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/>');
                        $('#book_genreID' + response.id + ' td:nth-child(2)').text(response.id);
                        $('#book_genreID' + response.id + ' td:nth-child(3)').text(response
                            .name);

                        tableRowHtml = '<div class="row">' +
                            '<button class="mx-1 btn btn-xs btn-edit-genre btn-outline-info"' +
                            'data-toggle="modal" data-target="#book_genreEditModal"' +
                            'data-id="' + response.id + '"' +
                            'data-genre_name="' + response.name + '"' +
                            'data-genre_book_type_id="' + response.book_type_id + '"' +
                            'title="Edit Book Genre"><i class="fa fa-edit"></i> Edit</button>' +

                            '<button book_genreID="' + response.id + '"' +
                            'class="mx-1 btn btn-xs btn-delete-genre btn-outline-danger"' +
                            'title="Delete"><i class="fa fa-trash"></i> Delete</button>';

                        $('#book_genreID' + response.id + ' td:nth-child(4)').html(tableRowHtml);

                        $('#btn-update-submit').attr('disabled', 'disabled');

                        // $('#book_genreEditModal').modal('toggle');
                        $('#book_genreEditForm')[0].reset();

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


        //Delete Book Genre Meta
        $(document).on('click', '.btn-delete-genre', function() {
            let id = $(this).attr('book_genreID');
            url = "{{ route('admin.system_configs.bookgenre.delete', ':id') }}";
            url = url.replace(':id', id);

            if (confirm("Do you want to delete this record?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#book_genreID' + id).remove();
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


        //Multiple Delete Book Genres and their related files
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
                    url: "{{ route('admin.system_configs.bookgenre.deleteSelected') }}",
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: allids
                    },
                    success: function(response) {
                        $.each(allids, function(key, val) {
                            $('#book_GenreID' + val).remove();
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
