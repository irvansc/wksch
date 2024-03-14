
@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Agenda List')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Agenda List</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Agenda List
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div id="modal-action" class="modal" tabindex="-1">

    </div>
@endsection


@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    const modal = $('#modal-action')
        const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
            locale: '{{ config('app.locale') }}',
            events: `{{ route('admin.events.list') }}`,
            editable: true,
            dateClick: function (info) {
                $.ajax({
                    url: `{{ route('admin.events.create') }}`,
                    data: {
                        start_date: info.dateStr,
                        end_date: info.dateStr
                    },
                    success: function (res) {
                        modal.html(res).modal('show')
                        $('.datepicker').datepicker({
                            todayHighlight: true,
                            format: 'yyyy-mm-dd'
                        });

                        $('#form-action').on('submit', function(e) {
                            e.preventDefault()
                            const form = this
                            const formData = new FormData(form)
                            $.ajax({
                                url: form.action,
                                method: form.method,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                    iziToast.success({
                                        title: 'Success',
                                        message: res.message,
                                        position: 'topRight'
                                    });
                                },
                                error: function (res) {
                                    toastr.remove();
                                    $.each(res.responseJSON.errors, function(prefix, val) {
                                        $(form).find('span.' + prefix + '_error').text(val[0]);
                                    })
                                }
                            })
                        })
                    }
                })
            },
            eventClick: function ({event}) {
                // console.log(event);
                $.ajax({
                    url: `{{ url('admin/events') }}/${event.id}/edit`,
                    success: function (res) {
                        modal.html(res).modal('show')
                        $('.datepicker').datepicker({
                            todayHighlight: true,
                            format: 'yyyy-mm-dd'
                        });
                        $('#form-action').on('submit', function(e) {
                            e.preventDefault()
                            const form = this
                            const formData = new FormData(form)
                            $.ajax({
                                url: form.action,
                                method: form.method,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                    iziToast.success({
                                        title: 'Success',
                                        message: res.message,
                                        position: 'topRight'
                                    });
                                }
                            })
                        })
                    }
                })
            },
            eventDrop: function (info) {
                const event = info.event
                $.ajax({
                    url: `{{ url('admin/events') }}/${event.id}`,
                    method: 'put',
                    data: {
                        id: event.id,
                        start_date: event.startStr,
                        end_date: event.end.toISOString().substring(0, 10),
                        title: event.title,
                        category: event.extendedProps.category
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        accept: 'application/json'
                    },
                    success: function (res) {
                        iziToast.success({
                            title: 'Success',
                            message: res.message,
                            position: 'topRight'
                        });
                    },
                    error: function (res) {
                        const message = res.responseJSON.message
                        info.revert()
                        iziToast.error({
                            title: 'Error',
                            message: message ?? 'Something wrong',
                            position: 'topRight'
                        });
                    }
                })
            },
            eventResize: function (info) {
                const {event} = info
                $.ajax({
                    url: `{{ url('admin/events') }}/${event.id}`,
                    method: 'put',
                    data: {
                        id: event.id,
                        start_date: event.startStr,
                        end_date: event.end.toISOString().substring(0, 10),
                        title: event.title,
                        category: event.extendedProps.category
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        accept: 'application/json'
                    },
                    success: function (res) {
                        iziToast.success({
                            title: 'Success',
                            message: res.message,
                            position: 'topRight'
                        });
                    },
                    error: function (res) {
                        const message = res.responseJSON.message
                        info.revert()
                        iziToast.error({
                            title: 'Error',
                            message: message ?? 'Something wrong',
                            position: 'topRight'
                        });
                    }
                })
            }


            });
            calendar.render();
        });
</script>
@endpush
