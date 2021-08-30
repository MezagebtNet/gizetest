@extends('layouts.admin.index')

@section('title', 'System Settings')


@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    @livewireStyles
@endsection

@section('navbar')
    @include('admin.navbar')
@endsection


@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('notifications-dropdown')
    @include('admin.navbar-notifications-dropdown')
@endsection

@section('content')

    <div class="row .flex-md-row-reverse">
        <div class="col-sm-3  order-sm-2">

            @include('admin.manage.batches.sidebar')

        </div>
        <div class="col-sm-9  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Batch (Add New) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <form id="batchForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="id" id="id" value="" />

                        <div class="form-group">
                            <label for="code_name">Code Name</label>
                            <input type="text" class="form-control" id="code_name" value="{{ old('code_name', '') }}" />
                            @error('code_name')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description"
                                rows="5">{{ old('description', '') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="subscription_type">Subscription Type</label>
                                <select class="custom-select" id="subscription_type" required>
                                    @foreach ($subscription_types as $subscription_type)
                                        <option value="{{ $subscription_type->id }}">{{ $subscription_type->name }}
                                        </option>

                                    @endforeach

                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid subscription type.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="status">Starting Date</label>
                                <div class="input-group date" id="starts_on_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#starts_on_date"
                                        value="{{ old('starts_on_date', '') }}">
                                    <div class="input-group-append" data-target="#starts_on_date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="status">Current Status</label>
                                {{-- <input type="text" class="form-control" id="status" /> --}}
                                <select id="status" class="custom-select mb-3">
                                    <option value="0" @if (old('status') == '0') selected="selected" @endif>Not Started</option>
                                    <option value="1" @if (old('status') == '1') selected="selected" @endif>Ongoing</option>
                                    <option value="2" @if (old('status') == '2') selected="selected" @endif>Onhold</option>
                                    <option value="3" @if (old('status') == '3') selected="selected" @endif>Closed</option>

                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="payment_fee">Subscription Fee</label>
                                <input type="number" step="50" class="form-control" id="payment_fee"
                                    value="{{ old('payment_fee', '0') }}" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="currency">Currency</label>
                                <select id="currency" class="custom-select mb-3">
                                    <option value="ETB" @if (old('currency') == 'ETB') selected="selected" @endif>ETB (Ethiopian Birr)
                                    </option>
                                    <option value="USD" @if (old('currency') == 'USD') selected="selected" @endif>USD (United States
                                        Dollar)
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="sm:px-4 pb-2">
                            <div class=" d-flex justify-content-end">
                                <a href="{{ route('admin.manage.batch.index') }}" class="btn btn-default mr-2">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>

    @endsection


    @section('js')

        @livewireScripts
        <!-- Select2 -->
        <script src="{{ asset('vendors/admin/plugins/select2/js/select2.full.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                // $('#subscription_type').select2({
                    // allowClear: true,
                    // theme: 'bootstrap4',
                    // dropdownParent: $('#subscriptionModal')

                // });

                //Initialize Datetime field
                // alert(moment().format('MM-DD-YYYY 6:00 P')+'M');
                now = moment();
                $('#starts_on_date').datetimepicker({
                    // defaultDate: moment().format(),
                    // format: 'YYYY-MM-DD'
                });
                $('#starts_on_date input').datetimepicker('date', moment());
                $('#subscription_type').on('change', function(e) {
                    // alert('here');
                    $("#selYear").val(0);
                    $("#selMonth").val(0);

                });
            });

            //Edit Batch
            $('#batchForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData($('#bookForm').get(0));
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

                // formData.append("name", name);


                let data = {
                    name: name,
                    _token: _token
                };

                $.ajax({
                    url: "{{ route('admin.manage.batch.add') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response) {

                            Swal.fire('Record Saved!', '', 'success');
                            window.location.replace("{{ route('admin.manage.batch.index') }}");

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
