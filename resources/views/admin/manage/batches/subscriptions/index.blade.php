@extends('layouts.admin.index')

@section('page_title', 'Subscription - Subscriptions')


@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('vendors/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet"
    href="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
<style>


</style>
@endsection

@section('header_title')
Batch Subscriptions Page
@stop

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
<li class="breadcrumb-item">Batch (Addmes) </li>
<li class="breadcrumb-item active">Batch Subscriptions</li>
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
    <div class="col-sm-12 col-md-3  order-sm-2">

        @include('admin.manage.batches.subscriptions.sidebar')

    </div>
    <div class="col-sm-12 col-md-9  order-sm-1">
        <div class="card" id="main-card">
            <div class="card-header">
                <h3 class="card-title">Subscription Settings </h3>
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                @if ($batch)
                    <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#subscriptionModal" data-id="{{ $batch ? $batch->id : '' }}"><i
                            class="fa fa-plus">
                        </i> Add New</button>

                    {{-- <a href="{{ route('admin.manage.batch.subscription.addform') }}" class="btn btn-xs btn-primary"><i
                            class="fa fa-plus"> </i> ADD FORM </a> --}}


                    <a href="{{ route('admin.manage.batch.subscription.index') }}"
                        class="btn btn-success btn-xs btn_continue" id="btnContinue">Select batch</a>


                    <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                        data-target="#periodModal" data-batch_id="{{ $batch ? $batch->id : '' }}"><i
                            class="fa fa-plus">
                        </i> Add Period</button>


                @endif
                <div class="card-tools">

                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>

            <div class="card-body">
                @if (!$batch)

                    Please Select batch to Continue:
                    <div class="row d-flex flex-row">
                        <div class="col-md-6 mb-3">
                            {{-- <label for="selectBatch">Batch</label> --}}
                            <select class="custom-select" id="selectBatch" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($batches as $b)

                                    <option value="{{ $b->id }}" @if ($loop->first) selected="selected" @endif>
                                        {{ $b->code_name }} ({{ $b->currency }})</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 ">
                            {{-- <label for="selectBatch">Batch</label> --}}
                            <button class="btn btn-success btn_continue" id="btnContinue">Continue</button>
                        </div>
                    </div>

                @else
                    <table id="subscriptionTable" style="width:100%;"
                        class="table table-striped table-bordered table-hover ">
                        <caption>List of Subscriptions</caption>
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Approval</th>
                                <th style="text-align: center;" scope="col">Active</th>
                                {{-- <th scope="col">Joined</th> --}}
                                @for ($i = 1; $i <= $batch->max_period_no; $i++)
                                    <th scope="col">
                                            <a href="javascript:void(0);"
                                             class="btn-edit-period"
                                             batch_id="{{ $batch->id }}"
                                             period_name="{{ $batch->subscription_periods[$i-1]->name }}"
                                             subscription_period_id = "{{ $batch->subscription_periods[$i-1]->id }}"
                                             from_date = "{{ $batch->subscription_periods[$i-1]->from_date }}"
                                             to_date = "{{ $batch->subscription_periods[$i-1]->to_date }}"
                                             data-toggle="tooltip" title="{{ $i }} | {{ $batch->subscription_periods[$i-1]->name }} ({{ $batch->subscription_periods[$i-1]->from_date }} - {{ $batch->subscription_periods[$i-1]->to_date }})">{{ $i }} <i class="fa fa-edit"></i></a>



                                @endfor
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscriptions as $subscription)
                                <tr id="subscriptionid{{ $subscription->id }}" style="height:90px;">
                                    <td class="align-middle"><input type="checkbox" name="ids" class="checkBoxClass "
                                            value="{{ $subscription->id }}" /></td>
                                    <th scope="row" class="align-middle"> {{ $subscription->id }}</th>
                                    <td class="align-middle">
                                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                            <div class="d-none d-lg-block image align-middle"
                                                style="margin-top: auto; margin-bottom: auto;">
                                                <img src="{{ $subscription->subscriber->profile_photo_url }}"
                                                    alt="{{ $subscription->subscriber->name }}"
                                                    style="width:54px; height: 54px;"
                                                    class="align-middle rounded-circle elevation-1">
                                            </div>
                                            <div class="info" style="display: grid;">
                                                <strong>{{ $subscription->subscriber_name }}</strong>
                                                <span
                                                    class="d-none d-sm-block text-sm">{{ $subscription->subscriber->email }}</span>
                                                <span class="text-md mt-1">Joined at:</span>
                                                <span class="text-sm">{{ $subscription->created_at }}</span>
                                                <span
                                                    class="text-xs text-muted">{{ $subscription->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-center">
                                            @if ($subscription->approved)
                                                Approved
                                            @else
                                                <button type="button" class="btn btn-xs btn-success btn-approve"
                                                    subscriptionid="{{ $subscription->id }}"><i class="fa fa-check">
                                                    </i> Approve</button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-center">
                                            @if ($subscription->active === 1)
                                                <a href="javascript:void(0);"
                                                    class="text-cetner  text-lg btn-toggle-active active"
                                                    subscriptionid="{{ $subscription->id }}">
                                                    <i style="color: green;" class="fa fa-check"></i></a>
                                            @else
                                                <a href="javascript:void(0);"
                                                    class="text-cetner  text-lg btn-toggle-active"
                                                    subscriptionid="{{ $subscription->id }}">
                                                    <i style="color: red;" class="fa fa-times"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                    {{-- <td>
                                    </td> --}}
                                    {{-- {{ dd($subscription->max_period_no) }} --}}
                                    @php
                                        $subscription_periods = $batch->subscriptionPeriods;

                                    @endphp
                                    @for ($i = 1; $i <= $subscription->max_period_no; $i++)

                                        @php
                                            $found = false;
                                        @endphp
                                        {{-- @foreach ($batch->subscriptionPeriods as $subscription_period) --}}
                                        {{-- @if ($subscription_period->period_no == $i) --}}
                                        {{-- @if ($payment->id) --}}
                                        @foreach ($subscription->payment_history as $payment)
                                            @php

                                                $pmt_id = '';
                                                $pmt_amount = 0;
                                                $pmt_reciept_no = '';
                                                $pmt_from_date = '';
                                                $pmt_to_Date = '';
                                                $pmt_method = '';
                                                $pmt_payment_date = '';
                                                $found = false;
                                            @endphp
                                            @if ($payment->period_no == $i)
                                                @php
                                                    $pmt_id = $payment->id;
                                                    $pmt_amount = $payment->amount;
                                                    $pmt_reciept_no = $payment->reciept_no;
                                                    $pmt_from_date = $payment->from_date;
                                                    $pmt_to_date = $payment->to_date;
                                                    $pmt_method = $payment->method;
                                                    $pmt_payment_date = $payment->payment_date;
                                                    $pmt_subscription_period_id = $payment->subscription_period_id;
                                                    $found = true;
                                                @endphp
                                                {{-- @continue --}}

                                                <td scope="col" id="{{ $subscription->id . '-' . $i }}"
                                                    class="table-success align-middle">
                                                    <div class="text-center"
                                                        style="margin-top: auto; margin-bottom: auto; align:middle;">
                                                        <strong>{{ $pmt_amount . ' ' . $subscription->currency }}</strong>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button title="Payment Menu List" type="button"
                                                            class="btn btn-xs btn-success dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="px-1  fa fa-list">
                                                            </i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item mnu_show_payment"
                                                                href="javascript:void(0);"
                                                                pmt_batch_user_id="{{ $subscription->id }}"
                                                                pmt_subscription_period="{{ $i }}"
                                                                pmt_subscription_period_id="{{ $pmt_subscription_period_id }}"
                                                                pmt_subscription_type="{{ $subscription->subscription_type }}"
                                                                pmt_subscriber_name="{{ $subscription->subscriber_name }}"
                                                                pmt_amount="{{ $pmt_amount }}"
                                                                pmt_reciept_no="{{ $pmt_reciept_no }}"
                                                                pmt_from_date="{{ $pmt_from_date }}"
                                                                pmt_to_date="{{ $pmt_to_date }}"
                                                                pmt_method="{{ $pmt_method }}"
                                                                pmt_payment_date="{{ $pmt_payment_date }}">
                                                                <i class="px-1  fa fa-list">
                                                                </i><span> Detail</span>
                                                            </a>
                                                            <a class="dropdown-item mnu_edit_payment"
                                                                pmt_id="{{ $pmt_id }}"
                                                                pmt_batch_user_id="{{ $subscription->id }}"
                                                                pmt_subscription_period="{{ $i }}"
                                                                pmt_subscription_period_id="{{ $pmt_subscription_period_id }}"
                                                                pmt_subscription_type="{{ $subscription->subscription_type }}"
                                                                pmt_subscriber_name="{{ $subscription->subscriber_name }}"
                                                                pmt_amount="{{ $pmt_amount }}"
                                                                pmt_reciept_no="{{ $pmt_reciept_no }}"
                                                                pmt_from_date="{{ $pmt_from_date }}"
                                                                pmt_to_date="{{ $pmt_to_date }}"
                                                                pmt_method="{{ $pmt_method }}"
                                                                pmt_payment_date="{{ $pmt_payment_date }}"
                                                                href="javascript:void(0);">
                                                                <i class="px-1  fa fa-edit">
                                                                </i><span> Edit</span>
                                                            </a>

                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item btn-remove-payment"
                                                                pmt_batch_user_id="{{ $subscription->id }}"
                                                                pmt_subscription_period_id="{{ $pmt_subscription_period_id }}"
                                                                pmt_subscription_period="{{ $i }}"
                                                                pmt_subscription_batch_id="{{ $subscription->batch_id }}"
                                                                pmt_subscription_type="{{ $subscription->subscription_type }}"
                                                                pmt_subscriber_name="{{ $subscription->subscriber_name }}"
                                                                href="#"> <i class="px-1  fa fa-times">
                                                                </i><span> Remove</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        @break ($payment->period_no == $i)

                                    @endforeach

                                    {{-- @endforeach --}}
                                    @if (!$found)
                                        {{-- <td scope="col" id="{{ $subscription->id . '-' . $i }}"
                                                class="table-success align-middle">
                                                <div class="text-center"
                                                    style="margin-top: auto; margin-bottom: auto; align:middle;">
                                                    <strong>{{ $pmt_amount . ' ' . $subscription->currency }}</strong>
                                                </div>
                                                <div class="btn-group">
                                                    <button title="Payment Menu List" type="button"
                                                        class="btn btn-xs btn-success dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="px-1  fa fa-list">
                                                        </i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item mnu_show_payment"
                                                            href="javascript:void(0);" pmt_id="{{ $pmt_id }}"
                                                            pmt_batch_user_id="{{ $subscription->id }}"
                                                            pmt_subscription_period="{{ $i }}"
                                                            pmt_subscription_period_id="{{ $pmt_subscription_period_id }}"
                                                            pmt_subscription_type="{{ $subscription->subscription_type }}"
                                                            pmt_subscriber_name="{{ $subscription->subscriber_name }}"
                                                            pmt_amount="{{ $pmt_amount }}"
                                                            pmt_reciept_no="{{ $pmt_reciept_no }}"
                                                            pmt_from_date="{{ $pmt_from_date }}"
                                                            pmt_to_date="{{ $pmt_to_date }}"
                                                            pmt_method="{{ $pmt_method }}"
                                                            pmt_payment_date="{{ $pmt_payment_date }}">
                                                            <i class="px-1  fa fa-list">
                                                            </i><span> Detail</span>
                                                        </a>
                                                        <a class="dropdown-item mnu_edit_payment"
                                                            pmt_id="{{ $pmt_id }}"
                                                            pmt_batch_user_id="{{ $subscription->id }}"
                                                            pmt_subscription_period="{{ $i }}"
                                                            pmt_subscription_period_id="{{ $pmt_subscription_period_id }}"
                                                            pmt_subscription_type="{{ $subscription->subscription_type }}"
                                                            pmt_subscriber_name="{{ $subscription->subscriber_name }}"
                                                            pmt_amount="{{ $pmt_amount }}"
                                                            pmt_reciept_no="{{ $pmt_reciept_no }}"
                                                            pmt_from_date="{{ $pmt_from_date }}"
                                                            pmt_to_date="{{ $pmt_to_date }}"
                                                            pmt_method="{{ $pmt_method }}"
                                                            pmt_payment_date="{{ $pmt_payment_date }}"
                                                            href="javascript:void(0);">
                                                            <i class="px-1  fa fa-edit">
                                                            </i><span> Edit</span>
                                                        </a>

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item btn-remove-payment"
                                                            pmt_batch_user_id="{{ $subscription->id }}"
                                                            pmt_subscription_period_id="{{ $pmt_subscription_period_id }}"
                                                            pmt_subscription_period="{{ $i }}"
                                                            href="#"> <i class="px-1  fa fa-times">
                                                            </i><span> Remove</a></span>
                                                    </div>
                                                </div>
                                            </td> --}}
                                        @php
                                            // $found = false;
                                        @endphp
                                        {{-- @else --}}
                                        <td scope="col" id="{{ $subscription->id . '-' . $i }}"
                                            class=" align-middle">
                                            <button title="Add Payment Detail" type="button"
                                                class="btn btn-sm btn-danger ml-2 btn_add_payment" data-toggle="modal"
                                                data-target="#paymentModal"
                                                data-batch_user_id="{{ $subscription->id }}"
                                                data-batch_id="{{ $subscription->batch_id }}"
                                                data-subscription_period="{{ $i }}"
                                                data-subscription_type="{{ $subscription->subscription_type }}"
                                                data-subscriber_name="{{ $subscription->subscriber_name }}">

                                                <i class="fa fa-plus">
                                                </i></button>
                                        </td>

                                    @endif
                            @endfor
                            <td class="align-middle"  id="total{{ $subscription->id }}">
                                <strong>{{ $subscription->total_paid . ' ' . $subscription->currency }}</strong>
                            </td>
                            <td id="{{ $subscription->id }}">
                                <div class="row">

                                </div>

                            </td>
                            </tr>

                @endforeach
                </tbody>
                </table>
                @endif
            </div>


            <div class="card-footer">
            </div>

        </div>

    </div>

</div>


@endsection


@section('modals')

    <!-- Add New Modal -->
    @include('admin.manage.batches.subscriptions.create_modal')

    <!-- Edit Modal -->
    @include('admin.manage.batches.subscriptions.edit_modal')

    <!-- Add New Payment Modal -->
    @include('admin.manage.batches.subscriptions.payments.create_modal')

    <!-- Edit Payment Modal -->
    @include('admin.manage.batches.subscriptions.payments.edit_modal')

    <!-- Payment Detail Modal -->
    @include('admin.manage.batches.subscriptions.payments.detail_modal')

    <!-- Add Period Modal -->
    @include('admin.manage.batches.subscriptions.periods.create_modal')

    <!-- Edit Period Modal -->
    @include('admin.manage.batches.subscriptions.periods.edit_modal')

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



<script type="text/javascript">
    $(function () {
        $('#period_from_date').datetimepicker();
        $('#period_to_date').datetimepicker({
            useCurrent: false
        });
        $("#period_from_date").on("change.datetimepicker", function (e) {
            $('#period_to_date').datetimepicker('minDate', e.date);
        });
        $("#period_to_date").on("change.datetimepicker", function (e) {
            $('#period_from_date').datetimepicker('maxDate', e.date);
        });



        $('#period_from_date_ed').datetimepicker();
        $('#period_to_date_ed').datetimepicker({
            useCurrent: false
        });
        $("#period_from_date_ed").on("change.datetimepicker", function (e) {
            $('#period_to_date_ed').datetimepicker('minDate', e.date);
        });
        $("#period_to_date_ed").on("change.datetimepicker", function (e) {
            $('#period_from_date_ed').datetimepicker('maxDate', e.date);
        });
    });
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function payment_cell_empty_template(response, i) {

        td_pymt_cell = `<td scope="col" id="${response.id }-${i}"
                class=" align-middle">
                <button title="Add Payment Detail" type="button"
                    class="btn btn-sm btn-danger ml-2 btn_add_payment" data-toggle="modal"
                    data-target="#paymentModal"

                    data-batch_user_id="${response ? response.id : ''}"
                    data-batch_id="${response.batch_id}"
                data-subscription_period="${i}"
                data-subscription_type="${response.subscription_type}"
                data-subscriber_name="${response.subscriber_name}"
                >

                    <i class="fa fa-plus">
                    </i></button>
            </td>`;

        return td_pymt_cell;
    }

    function payment_cell_data_template(
        response,
        i,
        pmt_amount,
        pmt_reciept_no,
        pmt_subscription_period_id,
        pmt_from_date,
        pmt_to_date,
        pmt_method,
        pmt_payment_date) {

        td_pymt_cell = `<td scope="col" id="${response.id}-${i}"
                                class="table-success align-middle">
                                <div class="text-center"
                                    style="margin-top: auto; margin-bottom: auto; align:middle;">
                                    <strong>${pmt_amount} ${response.currency}</strong>
                                </div>
                                <div class="btn-group">
                                    <button title="Payment Menu List" type="button"
                                        class="btn btn-xs btn-success dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="px-1  fa fa-list">
                                        </i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item mnu_show_payment"
                                            href="javascript:void(0);"
                                            pmt_batch_user_id="${response.id}"
                                            pmt_subscription_period="${i}"
                                            pmt_subscription_period_id="${pmt_subscription_period_id}"
                                            pmt_subscription_type="${response.subscription_type}"
                                            pmt_subscriber_name="${response.subscriber_name}"
                                            pmt_amount="${pmt_amount}"
                                            pmt_reciept_no="${pmt_reciept_no}"
                                            pmt_from_date="${pmt_from_date}"
                                            pmt_to_date="${pmt_to_date}"
                                            pmt_method="${pmt_method}"
                                            pmt_payment_date="${pmt_payment_date}"
                                            >
                                            <i class="px-1  fa fa-list">
                                            </i><span> Detail</span>
                                        </a>
                                        <a class="dropdown-item mnu_edit_payment"
                                            href="javascript:void(0);"
                                            pmt_batch_user_id="${response.id}"
                                            pmt_subscription_period="${i}"
                                            pmt_subscription_period_id="${pmt_subscription_period_id}"
                                            pmt_subscription_type="${response.subscription_type}"
                                            pmt_subscriber_name="${response.subscriber_name}"
                                            pmt_amount="${pmt_amount}"
                                            pmt_reciept_no="${pmt_reciept_no}"
                                            pmt_from_date="${pmt_from_date}"
                                            pmt_to_date="${pmt_to_date}"
                                            pmt_method="${pmt_method}"
                                            pmt_payment_date="${pmt_payment_date}"
                                            >
                                            <i class="px-1  fa fa-edit">
                                            </i><span> Edit</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn-remove-payment"
                                            pmt_batch_user_id="${response.id}"
                                            pmt_subscription_period_id="${pmt_subscription_period_id}"
                                            pmt_subscription_period="${i}"
                                            pmt_subscription_batch_id="${response.batch_id}"
                                            pmt_subscription_type="${response.subscription_type}"
                                            pmt_subscriber_name="${response.subscriber_name}"
                                            href="#"> <i class="px-1  fa fa-times">
                                            </i><span> Remove</a></span>
                                    </div>
                                </div>
                            </td>`;

        return td_pymt_cell;
    }

    $(function() {

        //Initialize Select2 Elements

        // Do this before you initialize any of your modals
        // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('.select-subscribers').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#subscriptionModal')
        });
        initSubscriptionTable();

        initialise_pmt_mnu();


        initdatetimePicker();



    });

    function initdatetimePicker(){
        $('#pmt_edit_payment_date').datetimepicker({
            format: "L"
        });
        $('#pmt_create_payment_date').datetimepicker({
            format: "L"
        });

        $('#period_from_date').datetimepicker({
            format: "L"
        });
        $('#period_to_date').datetimepicker({
            format: "L"
        });


        $('#period_from_date_ed').datetimepicker({
            format: "L"
        });
        $('#period_to_date_ed').datetimepicker({
            format: "L"
        });
    };

    function initSubscriptionTable() {
        $("#subscriptionTable").DataTable({
            // scrollY: "300px",
            // responsive: true,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 3,
                rightColumns: 2
            },
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            'createdRow': function(row, data, dataIndex) {

                // index = 'subscriptionid="';
                // startOffset = data.toString().search(index); // + index.toString().length;
                // trimmed = data.toString().substr(0, 10);
                // endOffset = trimmed.toString().search('"');
                // startOffset -= 2;
                // endOffset = 2;
                // id = trimmed.toString().substr(startOffset, endOffset);
                // console.log($(' th:nth-child(2)', row).html());
                if ($(' th:nth-child(2)', row).html() != undefined) {
                    idAttribute = 'subscriptionid' + $(' th:nth-child(2)', row).html().toString().replace(
                        ' ', '');
                    $(row).attr('id', idAttribute);
                }
                // alert(startOffset+' , '+ endOffset + "\n" + data);

            },
            'columnDefs': [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'desc']
            ],
        }).buttons().container().appendTo('#batchTable_wrapper .col-md-6:eq(0)');
    }





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

    // });

    //Handle Add Period Modal...
    $('#periodModal').on('hide.bs.modal', function(event) {
        $('#periodForm')[0].reset();
    });

    $('#periodModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        let batch_id = button.data('batch_id') // Extract info from data-* attributes

        $('#period_batch_id').val(batch_id);

    });

    //Handle Edit Period Modal...
    $('#periodEditModal').on('hide.bs.modal', function(event) {
        $('#periodEditForm')[0].reset();

        $('#period_from_date_ed').datetimepicker("date", null);

        $('#period_to_date_ed').datetimepicker("date", null);

    });

    $('#periodEditModal').on('show.bs.modal', function(event) {
        // var button = $(event.relatedTarget) // Button that triggered the modal

        // let batch_id = button.data('batch_id') // Extract info from data-* attributes

        // $('#period_batch_id_ed').val(batch_id);

    });

    $('.btn-edit-period').on('click', function(e){

        let _token = $('input[name=_token]').val();

        let batch_id = $(this).attr('batch_id');
        let from_date = $(this).attr('from_date');
        let to_date = $(this).attr('to_date');
        let subscription_period_id = $(this).attr('subscription_period_id');
        let name = $(this).attr('period_name');

        // alert(subscription_period_id);
        $('#period_from_date_ed').datetimepicker('date', moment(from_date, 'YYYY-MM-DD'));
        $('#period_to_date_ed').datetimepicker('date', moment(to_date, 'YYYY-MM-DD'));
        $('#period_batch_id_ed').val(batch_id);
        $('#period_name_ed').val(name);
        $('#subscription_period_id_ed').val(subscription_period_id);

        $('#periodEditModal').modal('toggle');
        // alert('here i am' + $(this).attr('batch_id'));
    });

    //Period Modal - Add New
    $('#periodForm').on('submit', function(e){
        e.preventDefault();

        let url = "{{ route('admin.manage.batch.addperiod') }}";
        let _token = $('input[name=_token]').val();

        from_date = $('#period_from_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
        to_date = $('#period_to_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
        name = $('#period_name').val();
        batch_id = $('#period_batch_id').val();

        formData = new FormData(this);
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        formData.append('batch_id', batch_id);
        formData.append('name', name);



        $.ajax({
            url:url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                //Refresh page.
                let url = "{{ route('admin.manage.batch.subscription.index', ':id') }}";
                url = url.replace(':id', batch_id);


                window.location.replace(url);

            },
            error: function(xhr){},
        });

    });

    //Period Modal - Edit
    $('#periodEditForm').on('submit', function(e){
        e.preventDefault();

        let url = "{{ route('admin.manage.batch.editperiod') }}";
        let _token = $('input[name=_token]').val();

        let from_date = $('#period_from_date_ed').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
        let to_date = $('#period_to_date_ed').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
        let name = $('#period_name_ed').val();
        let batch_id = $('#period_batch_id_ed').val();
        let subscription_period_id = $('#subscription_period_id_ed').val();

        formData = new FormData(this);
        formData.append('from_date', from_date);
        formData.append('to_date', to_date);
        formData.append('batch_id', batch_id);
        formData.append('name', name);
        formData.append('subscription_period_id', subscription_period_id);


        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                //Refresh page.
                let url = "{{ route('admin.manage.batch.subscription.index', ':id') }}";
                url = url.replace(':id', batch_id);

                window.location.replace(url);

            },
            error: function(xhr){},
        });
    });



    $('#btnContinue').on('click', function() {
        batch_id = $('#selectBatch').val();
        let url = "{{ route('admin.manage.batch.subscription.index', ':id') }}";
        url = url.replace(':id', batch_id);
        // alert(url);

        window.location.replace(url);
    });



    $(document).ready(function() {

        $('#subscription_type').on('change', function(e) {
            // alert('here');
            $("#selYear").val(0);
            $("#selMonth").val(0);

        });

    });



    // Activate or Deactivate subscription
    $(document).on('click', '.btn-toggle-active', function(e) {
        let subscriptionId = $(this).attr('subscriptionid'),
            isActive = $(this).hasClass('active') ? true : false, //Activate or Deactivate
            _token = $("input[name=_token]").val();

        let data = {
            subscriptionid: subscriptionId,
            _token: _token
        };
        // alert(JSON.stringify(data));
        let routeUrl = (isActive) ? "{{ route('admin.manage.batch.subscription.deactivate') }}" :
            "{{ route('admin.manage.batch.subscription.activate') }}";

        $.ajax({
            url: routeUrl,
            type: "PUT",
            data: data,
            // contentType: false,
            // processData: false,
            success: function(response) {
                if (response.status == "success") {
                    let subscription = response.subscription;
                    // let imgUrl = "{{ asset('storage/:_imgUrl') }}";

                    // if(subscription.poster_image_url!=null){
                    // 	imgUrl = imgUrl.replace(':_imgUrl', subscription.poster_image_url);
                    // }
                    // else {
                    // 	imgUrl = imgUrl.replace(':_imgUrl', 'ima#ges/l/thumb/subscription.jpg');
                    // }
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(1)').html(
                    //     '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                    //     subscription.id + '"/ >');
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(2)').text(
                    //     subscription
                    //     .id);
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(3)').html(
                    //     '<div class="user-panel mt-3 pb-3 mb-3 d-flex"> ' +
                    //     '<div class="image align-middle" ' +
                    //     'style="margin-top: auto; margin-bottom: auto;"> ' +
                    //     '<img src="' + subscription.subscriber.profile_photo_url + '" ' +
                    //     'alt="' + subscription.subscriber.name + '" ' +
                    //     'style="width:54px; height: 54px;" ' +
                    //     'class="align-middle rounded-circle elevation-1"> ' +
                    //     '</div> ' +
                    //     '<div class="info" style="display: grid;"> ' +
                    //     '<strong>' + subscription.subscriber_name + '</strong> ' +
                    //     '<br / > ' +
                    //     subscription.subscriber.email +
                    //     '</div> ' +
                    //     '</div>'
                    // );
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(4)').html(

                    //     (subscription.approved) ? '<div class="text-center">' + 'Approved' +
                    //     '</div>' :
                    //     '<div class="text-center">' +
                    //     '<button type="button" subscriptionid="' +
                    //     subscription.id +
                    //     ' class="btn btn-xs btn-success btn-approve"><i class="fa fa-check"></i> Approve</button></div>'
                    // );
                    var table = $('#subscriptionTable').DataTable();

                    table.cell($('#subscriptionid' + subscription.id + ' td:nth-child(5)'))
                        .data((subscription.active) ? '<div class="text-center">' +
                            '<a href="javascript:void(0)" subscriptionid="' +
                            subscription.id +
                            '" class=" text-lg btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a> </div>' :
                            '<div class="text-center">' +
                            '<a href="javascript:void(0)" subscriptionid="' + subscription.id +
                            '" class=" text-lg btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a></div>'
                        )
                        .draw();

                    Swal.fire({
                        icon: 'warning',
                        // title: xhr.responseJSON.message,
                        html: 'Subscription Status Updated!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })

                } else if (response.status == 'fail') {
                    Swal.fire({
                        icon: 'error',
                        // title: xhr.responseJSON.message,
                        html: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })
                }

            }
        });
    });

    // Approve subscription
    $(document).on('click', '.btn-approve', function(e) {
        let subscriptionId = $(this).attr('subscriptionid'),
            // _token = $("input[name=_token]").val();
            _token = $('meta[name="csrf-token"]').attr('content');

        let data = {
            subscriptionid: subscriptionId,
            _token: _token
        };

        let routeUrl = "{{ route('admin.manage.batch.subscription.approve') }}";

        $.ajax({
            url: routeUrl,
            type: "PUT",
            data: data,
            // contentType: false,
            // processData: false,
            success: function(response) {
                if (response.status == "success") {
                    let subscription = response.subscription;

                    // let imgUrl = "{{ asset('storage/:_imgUrl') }}";

                    // if(subscription.poster_image_url!=null){
                    // 	imgUrl = imgUrl.replace(':_imgUrl', subscription.poster_image_url);
                    // }
                    // else {
                    // 	imgUrl = imgUrl.replace(':_imgUrl', 'images/l/thumb/subscription.jpg');
                    // }
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(1)').html(
                    //     '<input type="checkbox" name="ids" class="checkBoxClass" value="' +
                    //     subscription.id + '"/ >');
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(2)').text(
                    //     subscription
                    //     .id);
                    // $('#subscriptionid' + subscription.id + ' td:nth-child(3)').html(
                    //     '<div class="user-panel mt-3 pb-3 mb-3 d-flex"> ' +
                    //     '<div class="image align-middle" ' +
                    //     'style="margin-top: auto; margin-bottom: auto;"> ' +
                    //     '<img src="' + subscription.subscriber.profile_photo_url + '" ' +
                    //     'alt="' + subscription.subscriber.name + '" ' +
                    //     'style="width:54px; height: 54px;" ' +
                    //     'class="align-middle rounded-circle elevation-1"> ' +
                    //     '</div> ' +
                    //     '<div class="info" style="display: grid;"> ' +
                    //     '<strong>' + subscription.subscriber_name + '</strong> ' +
                    //     '<br / > ' +
                    //     subscription.subscriber.email +
                    //     '</div> ' +
                    //     '</div>'
                    // );
                    var table = $('#subscriptionTable').DataTable();

                    table.cell($('#subscriptionid' + subscription.id + ' td:nth-child(4)'))
                        .data((subscription.approved) ? '<div class="text-center">' + 'Approved' +
                            '</div>' :
                            '<div class="text-center">' +
                            '<button type="button" subscriptionid="' +
                            subscription.id +
                            ' class="btn btn-xs btn-success btn-approve"><i class="fa fa-check"></i> Approve</button></div>'
                        )
                        .draw();

                    // table.cell($('#subscriptionid' + subscription.id + ' td:nth-child(5)'))
                    //     .data((subscription.active) ? '<div class="text-center">' +
                    //         '<a href="javascript:void(0)" subscriptionid="' +
                    //         subscription.id +
                    //         '" class=" text-lg btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a> </div>' :
                    //         '<div class="text-center">' +
                    //         '<a href="javascript:void(0)" subscriptionid="' + subscription.id +
                    //         '" class=" text-lg btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a></div>'
                    //     .draw();

                    // $('#subscriptionid' + subscription.id + ' td:nth-child(5)').html(

                    //     (subscription.active) ? '<div class="text-center">' +
                    //     '<a href="javascript:void(0)" subscriptionid="' +
                    //     subscription.id +
                    //     '" class=" text-lg btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a> </div>' :
                    //     '<div class="text-center">' +
                    //     '<a href="javascript:void(0)" subscriptionid="' + subscription.id +
                    //     '" class=" text-lg btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a></div>'
                    // );
                    Swal.fire({
                        icon: 'success',
                        // title: xhr.responseJSON.message,
                        html: 'Subscription Approved!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })

                } else if (response.status == 'fail') {
                    // alert(response.message);
                    Swal.fire({
                        icon: 'error',
                        // title: response.message,
                        html: response.messag,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    })
                }

            }
        });
    });


    //Handle Add New Modal...
    $('#subscriptionModal').on('hide.bs.modal', function(event) {
        $('#subscriptionForm')[0].reset();
    });

    //Payment Modal - Show/Hide Add New Modal Form
    $('#paymentModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        // let batch_id = button.data('id') // Extract info from data-* attributes
        // let id = button.data('pmt_id');
        let batch_user_id = button.data('batch_user_id');
        let batch_id = button.data('batch_id');
        let subscription_period = button.data('subscription_period');
        let period_no = button.data('subscription_period');
        let subscription_type = button.data('subscription_type');
        let subscriber_name = button.data('subscriber_name');
        let amount = button.data('amount');
        let reciept_no = button.data('reciept_no');
        // let from_date = button.data('from_date');
        // let to_date = button.data('to_date');
        let method = button.data('method');
        let payment_date = button.data('payment_date');

        $('#pmt_create_batch_user_id').val(batch_user_id);
        $('#pmt_create_batch_id').val(batch_id);
        $('#pmt_create_subscription_period').val(subscription_period);
        $('#pmt_create_period_no').val(`${period_no + ' (' + subscription_type + ')'}`);
        $('#pmt_create_subscriber_name').val(subscriber_name);

        $('#pmt_create_payment_date').datetimepicker('date', payment_date);
        $('#pmt_create_amount').val(amount);
        $('#pmt_create_select_method').val(method);
        $('#pmt_create_reciept_no').val(reciept_no);

        // $('#paymentModal').modal('show');
    });

    $('#paymentModal').on('hide.bs.modal', function(event) {
        $('#paymentAddForm')[0].reset();
    });

    //Payment Modal - Submit Add New Form
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();
        // let id = $('#pmt_edit_id');
        let batch_user_id = $('#pmt_create_batch_user_id').val();
        let batch_id = $('#pmt_create_batch_id').val();
        let subscription_period = $('#pmt_create_subscription_period').val();
        // let period_no = $('#pmt_create_subscription_period');
        // let subscription_type = $('#pmt_create_subscription_type');
        // let subscriber_name = $('#pmt_create_subscriber_name');
        let amount = $('#pmt_create_amount').val();
        let reciept_no = $('#pmt_create_reciept_no').val();
        // let from_date = $('#pmt_create_from_date').val();
        // let to_date = $('#pmt_create_to_date').val();
        let method = $('#pmt_create_select_method').val();
        let payment_date = $('#pmt_create_payment_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
        // save...

        let url = "{{ route('admin.manage.batch.subscription.addpayment') }}";
        let _token = $('input[name=_token]').val();

        formData = new FormData(this);
        formData.append('amount', amount);
        formData.append('reciept_no', reciept_no);
        formData.append('method', method);
        formData.append('payment_date', payment_date);
        formData.append('subscription_period', subscription_period);
        formData.append('batch_id', batch_id);
        formData.append('batch_user_id', batch_user_id);

        let that = $(this);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,

            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == "success") {
                    //hide modal
                    $("#paymentModal").modal('hide');
                    $("#paymentForm")[0].reset();

                    //update cell
                    var table = $('#subscriptionTable').DataTable();

                    td_pymt_cell = payment_cell_data_template(
                        response,
                        subscription_period,
                        amount,
                        reciept_no,
                        response.subscription_period_id,
                        '',
                        '',
                        method,
                        payment_date
                    );
                    // console.log(td_pymt_cell);
                    // alert('hdre');

                    var cell = table.cell($('#' + batch_user_id + '-' + subscription_period));
                    cell.data(td_pymt_cell).draw();

                    //total paid
                    cell = table.cell($('#total' + batch_user_id));
                    total_paid = "<strong>" + response.total_paid + " " + response.currency + "</strong>";

                    cell.data(total_paid).draw();

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        html: '',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });

                    initialise_pmt_mnu();
                }
            },
            error: function(xhr) {
                // $('#validation-errors').html('');
                let errMsgs = "";
                // $.each(xhr.responseJSON.errors, function(key, value) {
                //     $('#validation-errors').append('<div class="alert alert-danger">' +
                //         value + '</div');
                //     errMsgs += '' + value + '<br/>';


                // });

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

    //Payment Modal - Submit Edit Form
    $('#paymentEditForm').on('submit', function(e) {
        e.preventDefault();
        // let id = $('#pmt_edit_id');
        let batch_user_id = $('#pmt_edit_batch_user_id').val();
        let subscription_period_id = $('#pmt_edit_subscription_period_id').val();
        let subscription_period = $('#pmt_edit_subscription_period').val();
        // let subscription_type = $('#pmt_edit_subscription_type');
        // let subscriber_name = $('#pmt_edit_subscriber_name');
        let amount = $('#pmt_edit_amount').val();
        let reciept_no = $('#pmt_edit_reciept_no').val();
        // let from_date = $('#pmt_edit_from_date').val();
        // let to_date = $('#pmt_edit_to_date').val();
        let method = $('#pmt_edit_select_method').val();
        let payment_date = $('#pmt_edit_payment_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss')
        // save...

        let url = "{{ route('admin.manage.batch.subscription.editpayment') }}";
        let _token = $('input[name=_token]').val();

        formData = new FormData(this);
        formData.append('amount', amount);
        formData.append('reciept_no', reciept_no);
        formData.append('method', method);
        formData.append('payment_date', payment_date);
        formData.append('subscription_period_id', subscription_period_id);
        formData.append('batch_user_id', batch_user_id);



        $.ajax({
            url: url,
            type: 'POST',
            data: formData,

            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == "success") {
                    // hide modal
                    $('#paymentEditModal').modal('hide');
                    $("#paymentEditForm")[0].reset();

                    //update cell
                    var table = $('#subscriptionTable').DataTable();

                    td_pymt_cell = payment_cell_data_template(
                        response,
                        subscription_period,
                        amount,
                        reciept_no,
                        response.subscription_period_id,
                        '',
                        '',
                        method,
                        payment_date
                    );

                    td = $('#' + batch_user_id + '-' + subscription_period);
                    console.log(td);
                    table.cell(td)
                        .data(td_pymt_cell)
                        .draw();


                    //total paid
                    cell = table.cell($('#total' + batch_user_id));
                    total_paid = "<strong>" + response.total_paid + " " + response.currency + "</strong>";

                    cell.data(total_paid).draw();


                    Swal.fire({
                        icon: 'warning',
                        title: response.message,
                        html: '',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });

                    initialise_pmt_mnu();
                }
            },
            error: function(xhr) {
                // $('#validation-errors').html('');
                let errMsgs = "";
                // $.each(xhr.responseJSON.errors, function(key, value) {
                //     $('#validation-errors').append('<div class="alert alert-danger">' +
                //         value + '</div');
                //     errMsgs += '' + value + '<br/>';


                // });
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

    function initialise_pmt_mnu() {

        //Payment Modal - Show Detail
        $('.mnu_show_payment').on('click', function(e) {
            let id = $(this).attr('pmt_id');
            let period_no = $(this).attr('pmt_subscription_period');
            let subscription_type = $(this).attr('pmt_subscription_type');
            let subscriber_name = $(this).attr('pmt_subscriber_name');
            let amount = $(this).attr('pmt_amount');
            let reciept_no = $(this).attr('pmt_reciept_no');
            let from_date = $(this).attr('pmt_from_date');
            let to_date = $(this).attr('pmt_to_date');
            let method = $(this).attr('pmt_method');
            let payment_date = $(this).attr('pmt_payment_date');

            // $('pmt_show_batch_user_id').val(id);
            $('#pmt_show_period_no').val(`${period_no + ' (' + subscription_type + ')'}`);
            $('#pmt_show_subscriber_name').val(subscriber_name);
            $('#pmt_show_payment_date').datetimepicker('date', payment_date);
            $('#pmt_show_amount').val(amount);
            $('#pmt_show_method').val(method);
            $('#pmt_show_reciept_no').val(reciept_no);
            // $('pmt_show_batch_user_id').val(id);
            $('#paymentModalDetail').modal('show');
        });

        //Payment Modal - Show Edit Form
        $('.mnu_edit_payment').on('click', function(e) {
            let id = $(this).attr('pmt_id');
            let batch_user_id = $(this).attr('pmt_batch_user_id');
            let subscription_period_id = $(this).attr('pmt_subscription_period_id');
            let subscription_period = $(this).attr('pmt_subscription_period');
            let period_no = $(this).attr('pmt_subscription_period');
            let subscription_type = $(this).attr('pmt_subscription_type');
            let subscriber_name = $(this).attr('pmt_subscriber_name');
            let amount = $(this).attr('pmt_amount');
            let reciept_no = $(this).attr('pmt_reciept_no');
            let from_date = $(this).attr('pmt_from_date');
            let to_date = $(this).attr('pmt_to_date');
            let method = $(this).attr('pmt_method');
            let payment_date = $(this).attr('pmt_payment_date');

            $('#pmt_edit_batch_user_id').val(batch_user_id);
            $('#pmt_edit_subscription_period_id').val(subscription_period_id);
            $('#pmt_edit_subscription_period').val(subscription_period);
            $('#pmt_edit_period_no').val(`${period_no + ' (' + subscription_type + ')'}`);
            $('#pmt_edit_subscriber_name').val(subscriber_name);

            $('#pmt_edit_payment_date').datetimepicker('date', payment_date);
            $('#pmt_edit_amount').val(amount);
            $('#pmt_edit_select_method').val(method);
            $('#pmt_edit_reciept_no').val(reciept_no);
            // $('pmt_show_batch_user_id').val(id);
            $('#paymentEditModal').modal('show');
        });

        //Payment Remove
        $('.btn-remove-payment').on('click', function(e) {
            let batch_user_id = $(this).attr('pmt_batch_user_id');
            let subscription_period_id = $(this).attr('pmt_subscription_period_id');
            let subscription_period = $(this).attr('pmt_subscription_period');
            let subscription_batch_id = $(this).attr('pmt_subscriptoin_batch_id');
            let subscription_type = $(this).attr('pmt_subscription_type');
            let subscriber_name = $(this).attr('pmt_subscriber_name');



            url =
                "{{ route('admin.manage.batch.subscription.deletepayment', ['batch_user_id' => ':batch_user_id', 'subscription_period_id' => ':subscription_period_id']) }}";
            url = url.replace(':batch_user_id', batch_user_id);
            url = url.replace(':subscription_period_id', subscription_period_id);

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function(response) {
                    if (response.status == "success") {
                        // replace table cell.
                        var table = $('#subscriptionTable').DataTable();
                        var cell = table.cell($('#' + batch_user_id + '-' + subscription_period));

                        var response = $.parseJSON('{ "id": "' + batch_user_id + '", ' +
                            '"batch_id": "' + response.batch_id + '", ' +
                            '"subscription_type": "' + subscription_type + '", '+
                            '"subscriber_name": "' + subscriber_name + '" }');

                        td_pymt_cell = payment_cell_empty_template(response, subscription_period);
                        cell.data(td_pymt_cell).draw();

                        //total paid

                        td = $('#total' + batch_user_id);
                        cell = table.cell(td);
                        total_paid = "<strong>" + response.total_paid + " " + response.currency + "</strong>";

                        cell.data(total_paid).draw();

                        Swal.fire({
                            icon: 'warning',
                            title: response.message,
                            html: 'Payment Data Removed',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000
                        });
                    }
                },
                error: function(xhr) {
                    let errMsgs = "";

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
    };


    // Subscription Modal - New
    $('#subscriptionModal').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget) // Button that triggered the modal

        let batch_id = button.data('id') // Extract info from data-* attributes
        $('#batch_id').val(batch_id);
        // alert(batch_id);
        let url = "{{ route('admin.manage.batch.subscription.unsubscribedlist', ':id') }}";
        url = url.replace(':id', batch_id);

        // $('.js-data-example-ajax').select2({
        //     ajax: {
        //         url: url,
        //         dataType: 'json'
        //         // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        //     }
        // });



        $.ajax({
            url: url,
            type: "GET",
            contentType: false,
            processData: false,
            success: function(response) {

                if (response) {
                    // console.log(response);
                    $('#select_subscriber').html('');
                    response.map(function(obj) {
                        let option = document.createElement('option')
                        option.value = obj.id
                        option.innerHTML = `<b>${obj.name}</b>`
                        $('#select_subscriber').append(option)
                    })

                }

            },
            error: function(xhr) {
                $('#validation-errors').html('');
                let errMsgs = "";
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $('#validation-errors').append('<div class="alert alert-danger">' +
                        value + '</div');
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
        $('#subscriptionForm')[0].reset();
    });

    //Handle Edit Modal...
    $('#subscriptionEditModal').on('show.bs.modal', function(event) {
        // console.log('showing Edit modal');
        var button = $(event.relatedTarget) // Button that triggered the modal

        let id = button.data('id') // Extract info from data-* attributes

        var modal = $(this);
        modal.find('.modal-title').text('Edit Book Fomrat (ID:' + id + ')');

        $('#id').val(button.data('id'));
        $('#code_name_ed').val(button.data('code_name'));
        $('#description_ed').val(button.data('description'));
        $('#subscription_period_id_ed').val(button.data('subscription_period_id'));
        $('#payment_fee_ed').val(button.data('payment_fee'));
        $('#currency_ed').val(button.data('currency'));
        $('#status_ed').val(button.data('status'));

        $('#btn-update-submit').removeAttr('disabled');

    });


    $('#subscriptionEditModal').on('hide.bs.modal', function(event) {
        $('#btn-update-submit').attr('disabled', 'disabled');
        // $('#subscriptionEditForm')[0].reset();
        // console.log("edit modal hidden");
    });



    //Add New Subscription
    $('#subscriptionForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let user_id = $('#select_subscriber').val();
        let batch_id = $('#batch_id').val();
        let _token = $('input[name=_token]').val();

        formData.append("user_id", user_id);
        formData.append("batch_id", batch_id);
        formData.append("_token", _token);

        let td_pymt_cell = '';
        let payment_history = [];

        $.ajax({
            url: "{{ route('admin.manage.batch.subscription.add') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response);

                if (response) {
                    url = "{{ route('admin.manage.batch.subscription.index', ':id') }}";
                    url = url.replace(':id', response.id);
                    // window.location.replace(url);

                    let subscription_periods = 0;
                    batchUrl = "{{ route('admin.manage.batch.get', ':id') }}";
                    batchUrl = batchUrl.replace(':id', response.batch_id);

                    $.ajax({
                        url: batchUrl,
                        type: 'GET',
                        success: function(result) {
                            subscription_periods = result;



                            let max_period_no = response.max_period_no;
                            let payment_history_cells = [];
                            let found = false;
                            cell_data = [
                                '<input type="checkbox" id="chkCheckAll" />',

                                response.id,

                                '<div class="user-panel mt-3 pb-3 mb-3 d-flex"> ' +
                                '    <div class="d-none d-lg-block image align-middle" ' +
                                '        style="margin-top: auto; margin-bottom: auto;"> ' +
                                '        <img src="' + response.subscriber
                                .profile_photo_url +
                                '" ' +
                                '            alt="' + response.subscriber.name +
                                '" ' +
                                '            style="width:54px; height: 54px;" ' +
                                '            class="align-middle rounded-circle elevation-1"> ' +
                                '    </div> ' +
                                '    <div class="info" style="display: grid;"> ' +
                                '        <strong>' + response.subscriber_name +
                                '</strong> ' +
                                '        <span ' +
                                '            class="d-none d-sm-block text-sm">' +
                                response
                                .subscriber.email + '</span> ' +
                                '        <span class="text-md mt-1">Joined at:</span> ' +
                                '        <span class="text-sm">' + response
                                .created_at +
                                '</span> ' +
                                '        <span ' +
                                '            class="text-xs text-muted">' + response
                                .created_at +
                                '</span> ' +
                                '    </div> ' +
                                '</div>',

                                response.approved ? '<div class="text-center">' +
                                'approved' +
                                '</div>' :
                                '<div class="text-center">' +
                                '<button type="button" class="btn btn-xs btn-success btn-approve" ' +
                                'subscriptionid="' + response.id +
                                '"><i class="fa fa-check">' +
                                '</i> Approve</button></div>',

                                response.active ?
                                '<div class="text-center">' +
                                '<a href="javascript:void(0)" subscriptionid="' +
                                response.id +
                                '" class=" text-lg btn-toggle-active active">' +
                                '<i style="color: green;" class="fa fa-check"></i></a> </div>' :
                                '<div class="text-center">' +
                                '<a href="javascript:void(0)" subscriptionid="' +
                                response.id +
                                '" class=" text-lg btn-toggle-active">' +
                                '<i style="color: red;" class="fa fa-times"></i></a></div>'
                            ];
                            let td_pymt_cell = '';

                            for (let i = 1; i <= max_period_no; i++) {
                                found = false;
                                // subscription_periods.forEach(subscription_period => {
                                // $.each(subscription_periods, function(sp_index,
                                //     subscription_period) {

                                // });
                                // response.payment_history.forEach(payment => {
                                $.each(response.payment_history, function(
                                    ph_index, payment) {


                                    let pmt_id = '';
                                    let pmt_amount = 0;
                                    let pmt_reciept_no = '';
                                    let pmt_from_date = '';
                                    let pmt_to_Date = '';
                                    let pmt_method = '';
                                    let pmt_payment_date = '';
                                    found = false;

                                    if (payment.period_no == i) {
                                        pmt_id = payment.id;
                                        pmt_amount = payment.amount;
                                        pmt_reciept_no = payment.reciept_no;
                                        pmt_from_date = payment.from_date;
                                        pmt_to_date = payment.to_date;
                                        pmt_method = payment.method;
                                        pmt_payment_date = payment.payment_date;
                                        pmt_subscription_period_id = payment
                                            .subscription_period_id;
                                        found = true;

                                        // return;

                                        td_pymt_cell =
                                            payment_cell_data_template(i,
                                                pmt_amount,
                                                pmt_reciept_no,
                                                pmt_subscription_period_id,
                                                pmt_from_date,
                                                pmt_to_date,
                                                pmt_method,
                                                pmt_payment_date);


                                        $.merge(cell_data, [td_pymt_cell]);
                                    }
                                    if (payment.period_no == i) return false;

                                });
                                // });

                                if (found) {

                                    found = false;

                                } else {
                                    // td_pymt_cell = payment_cell_empty_template(
                                    //     response,
                                    //     i);

                                    td_pymt_cell = `<td scope="col" id="${response.id }-${i}"
                                            class=" align-middle">
                                            <button title="Add Payment Detail" type="button"
                                                class="btn btn-sm btn-danger ml-2 btn_add_payment" data-toggle="modal"
                                                data-target="#paymentModal"

                                                data-batch_user_id="${response ? response.id : ''}"
                                                data-batch_id="${response.batch_id}"
                                            data-subscription_period="${i}"
                                            data-subscription_type="${response.subscription_type}"
                                            data-subscriber_name="${response.subscriber_name}"
                                            >

                                                <i class="fa fa-plus">
                                                </i></button>
                                        </td>`;
                                    $.merge(cell_data, [td_pymt_cell]);

                                }
                            }


                            total_paid = "<strong>" + response.total_paid + " " + response.currency + "</strong>";

                            $.merge(cell_data, [ total_paid
                            ]);

                            $.merge(cell_data, [""]);


                            var table = $("#subscriptionTable").DataTable();
                            rowNode = table.row.add(
                                cell_data
                            ).draw(false).node();
                            // console.log(rowNode);

                            $(rowNode).attr('id', 'subscriptionid' + response.id);
                            $("#subscriptionid" + response.id).children().addClass(
                                'align-middle');

                            let cols_before_periods =
                                4; // No of columns before periodic columns
                            for (let i = 1; i <= max_period_no; i++) {
                                $("td", rowNode).eq(cols_before_periods + i).attr("id",
                                    response.id + "-" + i);
                            }

                            //Total Paid Cell
                            $("td", rowNode).eq(cols_before_periods + max_period_no + 1).attr("id",
                                    "total"+response.id );

                            table.draw();



                            $('#subscriptionForm')[0].reset();
                            $('#subscriptionModal').modal('hide');
                        },
                        error: function(xhr) {
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

                    //     //bug fix.. for not hiding modal window
                    //     // $('.modal').hide();

                    //     //bug fix... for not hiding  modal backdrop
                    //     // $('.modal-backdrop').hide();

                    //     //bug fix... advertize modal again
                    //     // $('.modal').modal('toggle');

                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        title: 'Subscription Added',
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






    //Edit Subscription
    // ...

    //Delete Subscription Meta and its related files
    // ...


    //Multiple Delete Subscriptions and their related files
    // ...
</script>
@endsection
