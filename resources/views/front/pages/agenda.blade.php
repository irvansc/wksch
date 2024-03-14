@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Agenda')

@section('content')


<section class="agendas" id="agendas">
    <div class="section-title">
        <h2>AGENDA</h2>
    </div>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">

                <div id='calendar-container'>
                    <div id='calendar'></div>
                </div>
            </div>
            @livewire('front.sidebar-content')

        </div>
    </div>
    <!-- /.container -->
</section>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today,listWeek'
                },
            locale: '{{ config('app.locale') }}',
            events: `{{ route('events.list') }}`,

            });
            calendar.render();
        });
</script>
@endpush


