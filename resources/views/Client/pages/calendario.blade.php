@extends('Client.core.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js"></script>
    <section class="calendar-page__header">
        <div class="calendar__content">
            <div class="calendar-page">
                <div class="wrap style">        
                    <ul class="calendar-page__tags"></ul>
        
                    <div class="calendar"></div>
                    <legend class="page-legend__content-f">
                        <h5 class="calendar-page__legend__title">Feriados</h5>
                        <div class="calendar-page__legend"></div>
                    </legend>
                    
                    <aside id="eventPanel" class="calendar-page__aside">                        
                        <ul class="events-list">
                            @foreach ($eventAll as $event)                                
                                @php
                                    $data = Carbon\Carbon::parse($event->date_start)->format('d/m/Y'); 
                                    $text = $event->text;
                                    $texto = strip_tags($text); 

                                    $eventsListObj = [
                                        'date' => $data,
                                        'time' => $event->description,
                                        'title' => $event->title,
                                        'text' => $texto,
                                    ];
                                @endphp
                                @include('Client.models.events-list__item', $eventsListObj)
                            @endforeach                           
                        </ul>{{-- END .events-list --}}
                    </aside>{{-- END .calender-page__aside --}}
                </div>
            </div>{{-- END .calendar-page --}}
        </div>
    </section>
@endsection
{{-- END . --}}

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tagsInfo = {     
            'religioso': {
                friendlyUrl: 'religioso',
                title: 'Religioso',
                color: '#00B0B9',
            },
            'institucional': {
                friendlyUrl: 'institucional',
                title: 'Institucional',
                color: '#00B0B9',
            }
        };

        const route = "{{ route('calendario') }}";

        const events = [
            @foreach ($eventAll as $evento)
                {
                    id: "{!! $evento->id !!}",
                    title: "{!! $evento->title !!}",
                    start: "{!! $evento->date_start !!}",
                    backgroundColor: tagsInfo['{!! $evento->tag !!}'] ? tagsInfo['{!! $evento->tag !!}'].color : tagsInfo['institucional'].color,
                    borderColor: tagsInfo['{!! $evento->tag !!}'] ? tagsInfo['{!! $evento->tag !!}'].color : tagsInfo['institucional'].color,
                },
            @endforeach

            @foreach ($holidays as $holiday)                
                {
                    title: "{!! $holiday->title !!}",
                    start: new Date().getFullYear() + '-{!! \Carbon\Carbon::parse($holiday->date_holiday)->format('m-d') !!}',
                    allDay: true
                },
            @endforeach
        ];

        const today = new Date();
        let initialDate = today.getFullYear() +
            '-' +
            (today.getMonth() + 1 < 10 ? '0' + (today.getMonth() + 1) : today.getMonth() + 1) +
            '-' + (today.getDate() < 10 ? '0' + today.getDate() : today.getDate());

        const expectedUrlArray = window.location.pathname.split('/');
        const expectedUrlDate = new Date(expectedUrlArray[2]);

        if (!isNaN(expectedUrlDate)) {
            initialDate = expectedUrlArray[2];
        }

        function formatDate(date) {
            return date.getFullYear() + '-' + (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-' + (date.getDate() < 10 ? '0' + date.getDate() : date.getDate());
        }

        const holidays = [
            @foreach($holidays as $holidayM)
                {
                    title: "{!! $holidayM->title !!}",
                    date: new Date(new Date().getFullYear(), {!! (int) \Carbon\Carbon::parse($holidayM->date_holiday)->format('m') !!} - 1, {!! (int) \Carbon\Carbon::parse($holidayM->date_holiday)->format('d') !!})
                },
            @endforeach
        ];

        function getMonthName(date) {
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            return months[date.getMonth()];
        }

        function formatDay(date) {
            return date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
        }

        function updateHolidayList(month) {
            const currentMonthHolidays = holidays.filter(holiday => holiday.date.getMonth() === month);
            let holidayList = `<ul>`;
            currentMonthHolidays.forEach(holiday => {
                holidayList += `<li>${formatDay(holiday.date)} de ${getMonthName(holiday.date)}: <span>${holiday.title}</span></li>`;
            });
            holidayList += '</ul>';
            document.querySelector('.calendar-page__legend').innerHTML = holidayList;
        }

        let listItems = '';

        // for (const key in tagsInfo) {
        //     listItems +=
        //         `<li class='calendar-page__tags__item' style='background-color: ${tagsInfo[key].color}'><a href='${route + '/categoria/' + tagsInfo[key].friendlyUrl}'>${tagsInfo[key].title}</a></li>`;
        // }

        document.querySelector('.calendar-page__tags').innerHTML = listItems;

        const calendarEl = document.querySelector('.calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pt-br',
            initialView: 'dayGridMonth',
            initialDate: initialDate,
            selectable: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: events,
            // eventClick: info => {
            //     window.location.assign(
            //         `${ route }/${ info.event.start.getFullYear() }-${info.event.start.getMonth() + 1 < 10 ? '0'+(info.event.start.getMonth()+1) : info.event.start.getMonth()+1 }-${info.event.start.getDate()<10 ? '0'+info.event.start.getDate() : info.event.start.getDate()}/${info.event.id}#ancora`
            //     );
            // },
            datesSet: info => {
                updateHolidayList(info.view.currentStart.getMonth());
            }
        });

        calendar.render();
        updateHolidayList(today.getMonth());

        document.querySelector('[data-date="' + initialDate + '"]').classList.add('fc-selectedDate');
    });
</script>


<style>
    .fc-toolbar-chunk:nth-of-type(3){
        display: none;
    }
    .fc .fc-toolbar-title{
        text-align: center;
        margin-top: -35px !important;
        margin-bottom: 27px !important;
    }
    .fc-direction-ltr .fc-toolbar>*>:not(:first-child){
        display: none !important;
    }
    .fc .fc-button-group>.fc-button{
        border-radius: 100%;
        flex: inherit !important;
        border-radius: 100% !important;
    }
    .fc .fc-button-group{
        width: 100%;
        display: flex;
        justify-content: space-between;
    }
    .fc-toolbar-chunk{
        width: 100%;
    }
    .fc .fc-toolbar{
        flex-direction: column;
    }
    .calendar-page__tags{
        display: none !important;
    }
    .fc .fc-button-primary{
        transition: ease 0.3s;
    }
    .fc .fc-button-primary:hover{
        transition: ease 0.3s;
        background-color: var(--laranja) !important;
        border-color: var(--laranja) !;
        color: var(--white) !important;
        transform: scale(1.2);    
    }
</style>
