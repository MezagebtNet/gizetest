@extends('layouts.admin.index')

@section('title', 'System Settings')

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

                            <h3 class="card-title">Book Type Detail (ID: {{ $book_type->id }}) </h3>

                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                </div>

                <div class="card-body px-4">
                    <table class="table table-borderless">
                        <tr class="border-b">
                            <th scope="col"
                            width="150"
                                class="px-6 py-2 text-right">
                                Book Type ID
                            </th>
                            <td class="pl-3 px-6 py-2">
                                {{ $book_type->id }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col"
                            width="150"
                                class="px-6 py-2 text-right">
                                Book Type Name
                            </th>
                            <td class="pl-3 px-6 py-2">
                                {{ $book_type->name }}
                            </td>
                        </tr>

                    </table>

                    @if ($book_type->book_genres)
                        <div class="card border-light mb-3 mt-4" style="max-width: 200rem;">
                            <div class="card-header">Associated Book Genres</div>
                            <div class="card-body table-responsive p-0" style="max-height: 200px;">
                                {{-- <h5 class="card-title">List of Associated Book Genres</h5> --}}
                                <table id="book_typeTable" class="table table-hover table-head-fixed table-sm">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col"><input type="checkbox" id="chkCheckAll" /></th> --}}
                                            <th scope="col" style="max-width: 30px;">Genre ID</th>
                                            <th scope="col">Genre Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book_type->book_genres as $book_genre)
                                            <tr id="book_typeID{{ $book_genre->id }}">
                                                {{-- <td><input type="checkbox" name="ids" class="checkBoxClass"
                                    value="{{ $book_genre->id }}" /></td> --}}
                                                <th scope="row" style="max-width: 30px;"> {{ $book_genre->id }}</th>
                                                <td>{{ $book_genre->name }}</td>
                                                <td id="{{ $book_genre->id }}">

                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    @endif
                </div>



                <div class="card-footer">
                    <a href="{{ route('admin.system_configs.booktype.index') }}"
                        class="ml-2">
                        < Back to list</a>

                </div>
            </div>
        </div>
    </div>


@endsection
