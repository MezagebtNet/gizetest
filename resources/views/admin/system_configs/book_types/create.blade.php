@extends('layouts.admin.index')

@section('title', 'System Settings')


@section('styles')
    @livewireStyles
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
                    <h3 class="card-title">Book Type (Add New) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <form id="book_typeForm">
                        @csrf

                        <div class="px-4 py-2 sm:p-6">
                            <label for="name" class="">Book Type
                                Name</label>

                            <input class="form-control" type="text" id="name" name="name" placeholder="BookType Name"
                                value="{{ old('name', '') }}" />

                            @error('name')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>





                        <div class=" pt-4 py-3 text-right sm:px-6">
                            <a href="{{ route('admin.system_configs.booktype.index') }}" class="btn btn-default mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary"> Create
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('js')

@livewireScripts

    <script>
        //Edit Book Type
        $('#book_typeForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);


            // let name = $('#name').val();
            let _token = $('input[name=_token]').val();

            // formData.append("name", name);


            let data = {
                // bookid: id,
                name: name,
                _token: _token
            };

            $.ajax({
                url: "{{ route('admin.system_configs.booktype.add') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response) {

                        // Swal.fire({
                        //     position: 'top-end',
                        //     toast: true,
                        //     icon: 'warning',
                        //     title: 'Record updated',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // })
                        let id = response.id;
                        let edit_book_type_url = '{{ route("admin.system_configs.booktype.editform", ":id") }}' ;
                        edit_book_type_url = edit_book_type_url.replace(':id', id);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Would you like to proceed adding Book Geners?',
                            showDenyButton: true,
                            // showCancelButton: true,
                            confirmButtonText: `Add Book Genre`,
                            denyButtonText: `Never Mind`,
                            denyButtonColor: '#6e7d88',
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                Swal.fire('Record Saved!', '', 'success');
                                window.location.replace(edit_book_type_url);
                                // window.open('{{ route('admin.system_configs.booktype.index') }}');
                            } else if (result.isDenied) {
                                Swal.fire('Record Saved', '', 'success');
                                window.location.replace("{{ route('admin.system_configs.booktype.index') }}");
                            }
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

    </script>
@endsection
