@extends('layouts.admin.index')

@section('page_title', 'Channels')

@section('header_title')
	Channels Management Page
@stop

@section('breadcrumb')
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
		<li class="breadcrumb-item active">@yield('Channels')</li>
@endsection
@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
        {{-- <div class="col-sm-3  order-sm-2"> --}}

            {{-- @include('admin.manage.gize_channels}}

        {{-- </div> --}}
        <div class="col-sm-12  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gize Channels Managment </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <a href="#" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#gize_channelModal"><i class="fa fa-plus"> </i> Add New</a>
                    <div class="card-tools">

                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table id="gize_channelTable" class="table table-hover table-sm">
                        <caption>List of Gize Channels</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Slug</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gize_channels as $gize_channel)
                                <tr id="gize_channelID{{ $gize_channel->id }}">
                                    <td><input type="checkbox" name="ids" class="checkBoxClass"
                                            value="{{ $gize_channel->id }}" /></td>
                                    <th scope="row"> {{ $gize_channel->id }}</th>
                                    <td>{{ $gize_channel->name }}</td>
                                    <td>{{ $gize_channel->description }}</td>
                                    <td>{{ $gize_channel->slug }}</td>
                                    <td id="{{ $gize_channel->id }}">
                                        <div class="row">

                                            <button class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"
                                                data-target="#gize_channelEditModal" data-id="{{ $gize_channel->id }}"
                                                data-name="{{ $gize_channel->name }}"
                                                data-description="{{ $gize_channel->description }}"
                                                data-slug="{{ $gize_channel->slug }}"
                                                title="Edit Gize Channel"><i class="fa fa-edit"></i> Edit</button>

                                            <button gize_channelID="{{ $gize_channel->id }}"
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
    @include('admin.manage.gize_channels.create_modal')

    <!-- Edit Modal -->
    @include('admin.manage.gize_channels.edit_modal')

@endsection


@section('js')

    <script>
        //Handle Add New Modal...
        $('#gize_channelModal').on('hide.bs.modal', function(event) {
            $('#gize_channelForm')[0].reset();
        });

        $('#gize_channelModal').on('show.bs.modal', function(event) {
            $('#gize_channelForm')[0].reset();
        });



        //Handle Edit Modal...
        $('#gize_channelEditModal').on('show.bs.modal', function(event) {
            // console.log('showing Edit modal');
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id') // Extract info from data-* attributes

            let modal = $(this);
            modal.find('.modal-title').text('Edit Gize Channel (ID:' + id + ')');
            $('#id').val(button.data('id'));
            $('#name_ed').val(button.data('name'));
            $('#description_ed').val(button.data('description'));
            $('#slug_ed').val(button.data('slug'));


            $('#btn-update-submit').removeAttr('disabled');

        });


        $('#gize_channelEditModal').on('hide.bs.modal', function(event) {
            $('#btn-update-submit').attr('disabled', 'disabled');
            // $('#gize_channelEditForm')[0].reset();
            // console.log("edit modal hidden");
        });



        //Add New Gize Channel

        $('#gize_channelForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData($('#gize_channelForm').get(0));
            let name = $('#name').val();
            let description = $('#description').val();
            let slug = $('#slug').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);
            formData.append("description", description);
            formData.append("slug", slug);
            formData.append("_token", _token);


            $.ajax({
                url: "{{ route('admin.manage.gize_channels.add') }}",
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
                            '<td>' + response.name + '</td>' +
                            '<td>' + response.description + '</td>' +
                            '<td>' + response.slug + '</td>' +

                            '<td id="' + response.id + '">';
                        tableRowHtml += '<div class="row"> <button data-id="' + response.id + '"' +
                            'data-name="' + response.name + '"' +
                            'data-description="' + response.description + '"' +
                            'data-slug="' + response.slug + '"' +
                            ' class="mx-1 btn btn-xs btn-edit btn-outline-info" data-toggle="modal"' +
                            ' data-target="#gize_channelEditModal" data-id="' + response.id +
                            '" title="Edit Gize Channel"><i' +
                            '    class="fa fa-edit"></i> Edit</button>' +

                            '<button gize_channelID="' + response.id + '"' +
                            '   class="mx-1 btn btn-xs btn-delete btn-outline-danger" title="Delete"><i' +
                            '       class="fa fa-trash"></i> Delete</button> </div>';

                            // alert('here');
                        $('#gize_channelTable tbody').append(tableRowHtml);

                        $('#gize_channelForm')[0].reset();
                        // $('#gize_channelModal').modal('hide');

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


        //Edit Gize Channel
        $('#gize_channelEditForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let id = $('#id').val();

            let name = $('#name_ed').val();
            let description = $('#description_ed').val();
            let slug = $('#slug_ed').val();
            let _token = $('input[name=_token]').val();

            formData.append("name", name);
            formData.append("description", description);
            formData.append("slug", slug);


            // let data = {
            //     // bookid: id,
            //     name: name,
            //     slug: slug,
            //     _token: _token
            // };

            $.ajax({
                url: "{{ route('admin.manage.gize_channels.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response) {

                        $('#gize_channelID' + response.id + ' td:nth-child(1)').html(
                            '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                            response.id + '"/>');
                        $('#gize_channelID' + response.id + ' td:nth-child(2)').text(response.id);
                        $('#gize_channelID' + response.id + ' td:nth-child(3)').text(response
                            .name);
                        $('#gize_channelID' + response.id + ' td:nth-child(4)').text(response
                            .description);
                        $('#gize_channelID' + response.id + ' td:nth-child(5)').text(response
                            .slug);

                        tableRowHtml = '<div class="row">' +
                            '<button class="mx-1 btn btn-xs btn-edit btn-outline-info"' +
                            'data-toggle="modal" data-target="#gize_channelEditModal"' +
                            'data-id="' + response.id + '"' +
                            'data-name="' + response.name + '"' +
                            'data-description="' + response.description + '"' +
                            'data-slug="' + response.slug + '"' +
                            'title="Edit Gize Channel"><i class="fa fa-edit"></i> Edit</button>' +

                            '<button gize_channelID="' + response.id + '"' +
                            'class="mx-1 btn btn-xs btn-delete btn-outline-danger"' +
                            'title="Delete"><i class="fa fa-trash"></i> Delete</button>';

                        $('#gize_channelID' + response.id + ' td:nth-child(6)').html(tableRowHtml);


                        $('#btn-update-submit').attr('disabled', 'disabled');


                        // $('#gize_channelEditModal').modal('toggle');
                        $('#gize_channelEditForm')[0].reset();

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

        //Delete Gize Channel Meta and its related files
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).attr('gize_channelID');
            url = "{{ route('admin.manage.gize_channels.delete', ['id'=>':id', 'language'=>app()->getLocale()]) }}";
            url = url.replace(':id', id);

            if (confirm("Do you want to delete this record?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        $('#gize_channelID' + id).remove();
                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'warning',
                            title: 'Record has been deleted',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        //Remove table row

                    }
                });


            }
        });


        //Multiple Delete Gize Channels and their related files
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
                    url: "{{ route('admin.manage.gize_channels.deleteSelected') }}",
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


$('#name').change(function(e) {
    $.get('{{ route('admin.manage.gize_channels.checkslug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});

$('#name_ed').change(function(e) {
    $.get('{{ route('admin.manage.gize_channels.checkslug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug_ed').val(data.slug);
        }
    );
});

    </script>
@endsection

@section('js')
    @parent
    <!-- Select2 -->
    <script src="{{ asset('vendors/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $('.slect-roles-multiple').select2({
            theme: 'bootstrap4'
        })

    </script>
@endsection