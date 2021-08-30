@extends('layouts.admin.index')

@section('title', 'System Settings')

@section('styles')
    @livewireStyles
    {{-- <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

        <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('navbar')
    @include('admin.navbar')
@endsection


@section('notifications-dropdown')
    @include('admin.navbar-notifications-dropdown')
@endsection

@section('content')
    {{-- {{ dd($batch->get()) }} --}}
    <div class="row .flex-md-row-reverse">

        <div class="col-sm-3  order-sm-2">

            @include('admin.manage.batches.sidebar')

        </div>

        <div class="col-sm-9  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Batch (ID: {{ $batch->id }}) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <form id="batchEditForm">
                        @csrf
                        <div class="px-4 py-2 sm:p-6">
                            <input type="hidden" class="form-control" name="id" id="id" value="{{ $batch->id }}" />

                            <div class="form-group">
                                <label for="code_name">Code Name</label>
                                <input type="text" class="form-control" id="code_name"
                                    value="{{ old('code_name', $batch->code_name) }}" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description"
                                    rows="5">{{ old('description', $batch->description) }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="subscription_type">Subscription Type</label>
                                    {{-- <input type="text" class="form-control" id="status" /> --}}
                                    <select id="subscription_type" class="custom-select mb-3">

                                        @foreach ($subscription_types as $subscription_type)
                                            @if ($loop->first)
                                                <option value="" @if (old('subscription_type') == '') selected="selected" @endif>Choose...
                                                </option>
                                            @endif
                                            <option value="{{ $subscription_type->id }}" @if (old('subscription_type') == $subscription_type->id || $batch->subscription_type_id == $subscription_type->id) selected="selected" @endif>
                                                {{ $subscription_type->name }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="starts_on_date">Starting Date</label>
                                    <div class="input-group date" id="starts_on_date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#starts_on_date"
                                            >
                                        <div class="input-group-append" data-target="#starts_on_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    {{-- <input type="text" id="starts_on_date" class="form-control"
                                            data-placeholder="Starts on Date"
                                            value="{{ old('starts_on_date', $batch->starts_on_date) }}" /> --}}


                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="status">Current Status</label>
                                    {{-- <input type="text" class="form-control" id="status" /> --}}
                                    <select id="status" class="custom-select mb-3">

                                        {{-- @foreach ($subscription_types as $subscription_type) --}}
                                        {{-- @if ($loop->first) --}}
                                        {{-- <option value="" @if (!isset($batch->status)) selected="selected" @endif>Choose...</option> --}}
                                        {{-- @endif --}}
                                        {{-- <option value="{{ $subscription_type->id }}" @if (old('subscription_type_id') == $subscription_type->id || $batch->subscription_type_id == $subscription_type->id) selected="selected" @endif>
                                                {{ $subscription_type->name }}</option> --}}
                                        <option value="0" @if (old('status') == '0' || $batch->status == 0) selected="selected" @endif>Not Started</option>
                                        <option value="1" @if (old('status') == '1' || $batch->status == 1) selected="selected" @endif>Ongoing</option>
                                        <option value="2" @if (old('status') == '2' || $batch->status == 2) selected="selected" @endif>Onhold</option>
                                        <option value="3" @if (old('status') == '3' || $batch->status == 3) selected="selected" @endif>Closed</option>

                                        {{-- @endforeach --}}


                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="payment_fee">Subscription Fee</label>
                                    <input type="text" class="form-control" id="payment_fee"
                                        value="{{ old('payment_fee', $batch->payment_fee) }}" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="currency">Currency</label>
                                    <select id="currency" class="custom-select mb-3">
                                        <option value="ETB" @if (old('currency') == 'ETB' || $batch->currency == 'ETB') selected="selected" @endif>ETB (Ethiopian Birr)
                                        </option>
                                        <option value="USD" @if (old('currency') == 'USD' || $batch->currency == 'USD') selected="selected" @endif>USD (United States
                                            Dollar)
                                        </option>
                                    </select>
                                </div>
                            </div>





                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="sm:px-4 pb-4">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.manage.batch.index') }}" class="btn btn-default mr-2">
                                    <i class="fa fa-chevron-left"> </i> Back to List</a>
                                </a>
                                <button class="btn btn-primary ">
                                    Save Changes
                                </button>
                            </div>

                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>
@endsection

@section('modals')

    {{-- <!-- Add New Modal -->
    @include('admin.system_configs.batchs.create_genre_modal')

    <!-- Edit Modal -->
    @include('admin.system_configs.batchs.edit_genre_modal') --}}

@endsection

@section('js')

    @livewireScripts
    {{-- <!-- Select2 -->
    <script src="{{ asset('vendors/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('vendors/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2 ').select2({
                // theme: 'bootstrap4'
            });

            //Initialize Datetime field
            let init_date_value = '{{ $batch->starts_on_date }}';
            $('#starts_on_date').datetimepicker();
            // alert(init_date_value);
            $('#starts_on_date').datetimepicker('date', moment(init_date_value, 'MM/DD/YYYY LT'));//.format('YYYY-MM-DD LT'));

            // $('#starts_on_date').datetimepicker('date', moment('11/21/2018', 'MM/DD/YYYY') );
            // $('#starts_on_date').on("change.datetimepicker", function(e) {
            //     alert(e.date);
            // });
        });

        //Edit Batch
        $('#batchEditForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let id = $('#id').val();

            let code_name = $('#code_name').val();
            let description = $('#description').val();
            let subscription_type = $('#subscription_type').val();
            let payment_fee = $('#payment_fee').val();
            let currency = $('#currency').val();
            let starts_on_date = $('#starts_on_date').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
            let status = $('#status').val();
            let _token = $('input[name=_token]').val();

            formData.append("code_name", code_name);
            formData.append("description", description);
            formData.append("subscription_type", subscription_type);
            formData.append("payment_fee", payment_fee);
            formData.append("currency", currency);
            formData.append("starts_on_date", starts_on_date);
            formData.append("status", status);

            formData.append("_token", _token);


            let data = {
                // id: id,
                _token: _token
            };

            $.ajax({
                url: "{{ route('admin.manage.batch.update') }}",
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
    </script>
@endsection
