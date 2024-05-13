@extends('adminlte::page')

@section('title'){!! $titulo !!}
@endsection

@section('content_header')
{!! $titulo !!}
@stop

@section('content')
   @if (session('mensaje'))
    <div class="alert alert-success alert-dismissable">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card border-primary">
            <div id='calendar'></div>
        </div>
    </div>
</div>


@stop

@section('css')
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
@stop

@section('js')
{{-- <script src='fullcalendar/dist/index.global.js'></script> --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="{{ asset('public/vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#t03nombre").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#t03slug',
            space: '-'
        });

        $("#guardar").click(function(){
            $("#btnSubmit").click();
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            themeSystem: 'bootstrap5',
            timeZone: 'UTC',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                // right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                initialView: 'timeGridDay'


            },
            // weekNumbers: true,
            // dayMaxEvents: true,
            events: @json($events)
        });
        calendar.render();
      });

</script>
@stop
