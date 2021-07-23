@extends('layouts.admin.index')

@section('title', 'System Settings')

@section('styles')
    <style>
        tr.group,
        tr.group:hover {
            background-color: #ddd !important;
        }

    </style>

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
                    <h3 class="card-title">Edit Book Royalty Rates </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <h4>Book Royalties by Book Formats</h4>
                    {{-- <h6 class="text-muted">There are {{ $currencies_count }} Types of currencies and --}}
                    {{-- {{ $book_formats_count }} types of book formats involved in the royalty setup.</h6> --}}
                    {{-- <hr class="pt-5" /> --}}
                    @foreach ($book_formats as $book_format)
                        <div class="card border-light mb-3 mt-4" style="max-width: 200rem;">
                            <div class="card-header">{{ $book_format->name }}

                                <a href="#" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                                    data-target="#book_royalty_rateModal" data-book_format_id="{{ $book_format->id }}"><i
                                        class="fa fa-plus"> </i> Add New</a>
                            </div>



                            <div class="card-body table-responsive p-0" style="max-height: 200px;">


                                <table style="width:100%" id="book_royalty_rateTable{{ $book_format->id }}"
                                    class="table table-hover table-head-fixed table-sm display">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" style="max-width: 60px;">ID
                                            </th>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Publish Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book_royalty_formats as $formats)

                                            @if ($formats->id == $book_format->id)

                                                @foreach ($formats->currencies as $currency)
                                                    <tr id="book_royalty_rateID{{ $formats->id }}-{{ $currency->id }}">
                                                        <th scope="row" style="max-width: 60px;" class="text-center">
                                                            {{ $currency->pivot->id }}
                                                        </th>
                                                        <td scope="col">
                                                            {{ $currency->currency_code }}
                                                        </td>
                                                        <td scope="col">
                                                            {{ $currency->pivot->rate }}
                                                        </td>
                                                        <td scope="col">
                                                            {{ $currency->pivot->published_at }}
                                                        </td>
                                                        <td scope="col">
                                                            @if ($currency->pivot->published_at > now())
                                                                <span class="label label-primary">future</span>
                                                            @elseif ($currency->pivot->published_at <= now()) current
                                                                    @endif
                                                                    {{ $currency->status }}
                                                        </td>

                                                        <td id="{{ $formats->id }}-{{ $currency->id }}">
                                                            <div class="row">
                                                                {{-- <button
                                                                    class="mx-1 btn btn-xs btn-edit-genre btn-outline-info"
                                                                    data-toggle="modal"
                                                                    data-target="#book_royalty_rateEditModal"
                                                                    data-id="{{ $book_royalty_rate->id }}"
                                                                    data-book_format_id="{{ $book_format->id }}"
                                                                    data-currency_id="{{ $book_royalty_rate->currency_id }}"
                                                                    data-rate="{{ $book_royalty_rate->rate }}"
                                                                    data-publish_date="{{ $book_royalty_rate->published_at }}"
                                                                    title="Edit Book Royalty"><i class="fa fa-edit"></i>
                                                                    Edit</button> --}}

                                                                {{-- <button
                                                                    book_royalty_rateID="{{ $book_royalty_rate->id }}"
                                                                    class="mx-1 btn btn-xs btn-delete-book-royalty-rate btn-outline-danger"
                                                                    title="Delete"><i class="fa fa-trash"></i>
                                                                    Delete</button> --}}
                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            @endif


                                        @endforeach
                                    </tbody>
                                </table>






                            </div>

                        </div>




                    @endforeach

                </div>


            </div>
        </div>
    </div>

@endsection



@section('modals')

    <!-- Add New Modal -->
    @include('admin.system_configs.book_royalty_rates.create_modal')

    <!-- Edit Modal -->
    {{-- @include('admin.system_configs.book_types.edit_genre_modal') --}}

@endsection

@section('js')

    <!-- Input Mask -->
    <script src="{{ asset('vendors/admin/plugins/inputmask/inputmask.min.js') }}"></script>

    @foreach ($book_formats as $book_format)

        <script>
            $(document).ready(function() {
                var groupColumn = 2;
                var table = $('#book_royalty_rateTable{{ $book_format->id }}').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": groupColumn
                    }],
                    "order": [
                        [groupColumn, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="5">' + group +
                                    '</td></tr>'
                                );

                                last = group;
                            }
                        });
                    }
                });

                // Order by the grouping
                $('#book_royalty_rateTable{{ $book_format->id }} tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
            });
        </script>

    @endforeach
@endsection
