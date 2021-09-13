@extends('layouts.admin.index')

@section('page_title', 'Batch - Schedules')


@section('styles')
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    {{-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' /> --}}
    {{-- <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'> --}}
    <style>
        #wrap {
            /* width: 1100px; */
            margin: 0 auto;
        }

        #external-events {
            float: left;
            width: 100%;
            padding: 0 10px;
            /* border: 1px solid #ccc;
                            background: #eee; */
            text-align: left;
        }

        #external-events h4 {
            font-size: 16px;
            margin-top: 0;
            padding-top: 1em;
        }

        #external-events .fc-event {
            margin: 10px 0;
            padding: 7px;
            height: 35px;
            cursor: pointer;
        }

        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
        }

        #external-events p input {
            margin: 0;
            vertical-align: middle;
        }

        #calendar {
            float: right;
            width: 900px;
        }

        @media(min-width: 768px; ) {
            .sticky-top {
                /* align-self: baseline; */
            }
        }

    </style>

@endsection

@section('header_title')
    Channel Videos' Batch Schedule Management
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
    <li class="breadcrumb-item">Batch (Addmes) </li>
    <li class="breadcrumb-item active">Batch Schedule</li>
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
        <div class="col-sm-12 col-md-3 order-sm-2">

            @include('admin.manage.batches.schedules.sidebar')
            {{-- <div id='draggable-el' data-event='{ "title": "my event", "duration": "02:00" }'>drag me</div>
            <div id='wrap'>

                <div id='external-events'>
                    <h4>Draggable Events</h4>
                    <div id="11" class='fc-event'>My Event 1</div>
                    <div id="12" class='fc-event'>My Event 2</div>
                    <div id="13" class='fc-event'>My Event 3</div>
                    <div id="14" class='fc-event'>My Event 4</div>
                    <div id="15" class='fc-event'>My Event 5</div>
                    <p>
                        <input type='checkbox' id='drop-remove' />
                        <label for='drop-remove'>remove after drop</label>
                    </p>
                </div>

                <div id='calendar'></div>

                <div style='clear:both'></div>

            </div> --}}
        </div>
        <div class="col-sm-12 col-md-9  order-sm-1">
            <div class="card" id="main-card">
                <div class="card-header">
                    <h3 class="card-title">Schedule </h3>
                    @if ($batch)
                        <button type="button" class="btn btn-xs btn-secondary ml-2" data-toggle="modal"
                            data-target="#subscriptionModal" data-id="{{ $batch ? $batch->id : '' }}"><i
                                class="fa fa-plus">
                            </i> Add New</button>

                        {{-- <a href="{{ route('admin.manage.batch.subscription.addform') }}" class="btn btn-xs btn-primary"><i
                        class="fa fa-plus"> </i> ADD FORM </a> --}}


                        <a href="{{ route('admin.manage.batch.schedule.index', $gize_channel->id) }}"
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

                    <div class="row">
                        <div class="col-12">
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
                                <div id='calendar2'></div>
                            @endif
                        </div>
                    </div>

                </div>


                <div class="card-footer">
                </div>


            </div>

            <div style='clear:both'></div>

            <div id='calendar'></div>

        </div>

    </div>


@endsection


@section('modals')

    <!-- Add New Video Schedule Modal -->
    @include('admin.manage.batches.schedules.create_modal')

@endsection


@section('js')

    {{-- <script src="{{ asset('vendors/fullcalendar/main.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/locales/en-gb.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/locales/am-et.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

    <script>
        $(document).ready(function() {
            /* initialize the external events
            -----------------------------------------------------------------*/
            $('#external-events .fc-event').each(function() {
                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            });

        });

    </script>
    <script>
        $(document).ready(function() {

            //Initialize datetimepicker
            $('#schedule_starts_at').datetimepicker({
                // format: "L"
            });
            $('#schedule_ends_at').datetimepicker({
                // format: "L"
            });

            function formatState (state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "{{ asset('storage/') }}";
                var path = state.poster_image_url != null? state.poster_image_url : "images/l/thumb/channelvideo.jpg";
                var $state = $(
                    '<span><img style="max-width:90px;" src="' + baseUrl + '/' + path + '" class="img-flag" /> ' + state.text + '</span>'
                );
                return $state;
            };


            var list = @json($channelvideos);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* initialize the calendar
            -----------------------------------------------------------------*/

            let batch_id = "{{ $batch ? $batch->id : '' }}";
            let gize_channel_id = "{{ $gize_channel->id }}";

            let ajaxUrl = "{{ route('admin.manage.batch.schedule.crud_calendarevents', ['gize_channel_id' => ':gize_channel_id', 'batch_id' => ':batch_id']) }}";
            ajaxUrl = ajaxUrl.replace(':batch_id', batch_id);
            ajaxUrl = ajaxUrl.replace(':gize_channel_id', gize_channel_id);



            var calendar = $('#calendar2').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                nowindicator: true,
                editable: true,
                // eventStartEditable: false,
                // evenetResizableFromStart: false,
                // eventDurationEditable: false,

                droppable: false, // this allows things to be dropped onto the calendar
                drop: function() {

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                // themeSystem: 'bootstrap',
                events: {!! json_encode($events) !!},
                displayEventTime: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(starts_at, ends_at, allDay) {
                    // var title = prompt('Event Name:');
                    var starts_at = $.fullCalendar.formatDate(starts_at, "Y-MM-DD HH:mm:ss");
                    var ends_at = $.fullCalendar.formatDate(ends_at, "Y-MM-DD HH:mm:ss");
                    $('#schedule_starts_at').datetimepicker('date', moment(starts_at, 'YYYY-MM-DD'));
                    $('#schedule_ends_at').datetimepicker('date', moment(ends_at, 'YYYY-MM-DD'));

                    $('#scheduleModal').modal('show');


                },
                eventDrop: function(event, delta) {
                    var starts_at = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var ends_at = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                    // alert(starts_at);
                    $.ajax({
                        url: ajaxUrl,
                        data: {
                            title: event.title,
                            start: starts_at,
                            end: ends_at,
                            id: event.id,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Video schedule updated");
                        }
                    });
                },
                eventClick: function(event) {
                    var eventDelete = confirm("Remove this schedule?");
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: ajaxUrl,
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event removed");
                            }
                        });
                    }
                }
            });

            $('.select-videos').select2({
                theme: 'bootstrap4',
                data: list,
                templateResult: formatState,
                dropdownParent: $('#scheduleModal')
            });

            $('#btnContinue').on('click', function() {
                batch_id = $('#selectBatch').val();
                let gize_channel_id = "{{ $gize_channel->id }}";
                let url = "{{ route('admin.manage.batch.schedule.index', ['gize_channel_id' => ':gize_channel_id', 'batch_id' => ':batch_id']) }}";
                url = url.replace(':gize_channel_id', gize_channel_id);
                url = url.replace(':batch_id', batch_id);
                // alert(url);

                window.location.replace(url);
            });

            $('#scheduleModal').on('hide.bs.modal', function(event) {
                $('#scheduleForm')[0].reset();

                $('#schedule_starts_at').datetimepicker("date", null);

            });

            $('#scheduleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal

                let batch_id = button.data('batch_id') // Extract info from data-* attributes

                $('#schedule_batch_id').val(batch_id);

            });



            $('#scheduleForm').on('submit', function(e) {
                e.preventDefault();

                // url = url.replace(':gize_channel_id', gize_channel_id);

                let _token = $('input[name=_token]').val();

                starts_at = $('#schedule_starts_at').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
                ends_at = $('#schedule_ends_at').datetimepicker('date').format('YYYY-MM-DD HH:mm:ss');
                name = $('.select-video').select2('data');
                // var data = $('your-original-element').select2('data')
                // alert($('.select-video'));
                // alert(data[0].id);

                // console.log(name);
                // batch_id = $('#period_batch_id').val();

                formData = new FormData(this);
                formData.append('starts_at', starts_at);
                formData.append('ends_at', ends_at);
                formData.append('type', 'create');
                // formData.append('name', name);

                let title = "Video Title";
                // starts_at =

                $.ajax({
                    url: ajaxUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(data) {
                        displayMessage("Video Schedule created.");

                        calendar.fullCalendar('renderEvent', {
                            id: data.id,
                            title: data.title,
                            start: starts_at,
                            end: ends_at,
                            // allDay: allDay
                        }, true);

                        calendar.fullCalendar('unselect');
                        $('#scheduleModal').modal('hide');
                    }
                });

                // $.ajax({
                //     url: url,
                //     type: 'POST',
                //     data: formData,
                //     contentType: false,
                //     processData: false,
                //     success: function(response) {
                //         //Refresh page.
                //         let url = "{{ route('admin.manage.batch.subscription.index', ['gize_channel_id' => ':gize_channel_id', 'batch_id' => ':batch_id']) }}";
                //         let gize_channel_id = "{{ $gize_channel->id }}";
                //         url = url.replace(':gize_channel_id', gize_channel_id);
                //         url = url.replace(':batch_id', batch_id);

                //         window.location.replace(url);

                //     },
                //     error: function(xhr) {},
                // });
            });




            function displayMessage(message) {
                toastr.success(message, 'Event');
            }
        });
    </script>



@endsection
