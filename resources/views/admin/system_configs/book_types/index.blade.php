@extends('layouts.admin.index')

@section('title', 'System Settings')

@section('styles')

@endsection

@section('navbar')
    @include('admin.navbar')
@endsection


@section('mainsidebar')
    @include('admin.mainsidebar')
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
                    <h3 class="card-title">Book Type Settings </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <a href="{{ route('admin.system_configs.booktype.addform') }}" class="btn btn-xs btn-secondary ml-2"><i
                            class="fa fa-plus"> </i> Add New</a>
                    <div class="card-tools">

                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table id="book_typeTable" class="table table-hover table-sm">
                        <caption>List of Book Types</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Genres</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book_types as $book_type)
                                <tr id="book_typeID{{ $book_type->id }}">
                                    <td><input type="checkbox" name="ids" class="checkBoxClass"
                                            value="{{ $book_type->id }}" /></td>
                                    <th scope="row"> {{ $book_type->id }}</th>
                                    <td>{{ $book_type->name }}</td>
                                    <td class="text-center">{{ $book_type->book_genres_count }}</td>
                                    <td id="{{ $book_type->id }}">
                                        <div class="row">
                                            <a href="{{ route('admin.system_configs.booktype.details', $book_type->id) }}" book_typeID="{{ $book_type->id }}"
                                                class="mx-1 btn btn-xs btn-outline-success" title="Details"><i
                                                    class="fa fa-eye"></i> View</a>

                                            <a href="{{ route('admin.system_configs.booktype.editform', $book_type->id) }}" book_typeID="{{ $book_type->id }}"
                                                class="mx-1 btn btn-xs btn-outline-info" title="Edit"><i
                                                    class="fa fa-edit"></i> Edit</a>


                                            <button book_typeID = "{{ $book_type->id }}"
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
    {{-- @include('admin.system_configs.book_types.create_modal') --}}

    <!-- Edit Modal -->
    {{-- @include('admin.system_configs.book_types.edit_modal') --}}

@endsection


@section('js')

    <script>


        //Delete Book Type Meta and its related files
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).attr('book_typeID');

            if (confirm("Do you want to delete this record?")) {
                url = "{{ route('admin.system_configs.booktype.delete', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#book_typeID' + id).remove();
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


        //Multiple Delete Book Types and their related files
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
                    url: "{{ route('admin.system_configs.booktype.deleteSelected') }}",
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: allids
                    },
                    success: function(response) {
                        $.each(allids, function(key, val) {
                            $('#book_typeID' + val).remove();
                        });
                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'warning',
                            title: 'Records have been deleted',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#chkCheckAll').prop('checked', false );

                    }
                });
            }
        });

    </script>
@endsection
