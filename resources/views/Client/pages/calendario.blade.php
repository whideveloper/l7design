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
                            @foreach ($events as $event)                                
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
    /* Aqui é temos um grande obj composto de objetos menores que servem para configurar as tags e a cor dos eventos a partir das tags;
        Cada objeto precisa de uma chave por isso usei o próprio campo de url amigável (friendlyUrl) como nome da tag;
        Assim, quando for configurar os eventos, será buscado diretamente o objeto específico que ele precisa sem precisar rodar um array conparando a chave friendlyUrl pra cada evento.*/
    
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
       
    }

    /* rota base para montar lista de links pelas tags */
    const route = " {{ route('calendario') }}";

    /* a abaixo, os campos de backgroundColor e borderColor recebem a tag específica do */
    const events = [
            {
                id: "1",
                title: "1ª Oficina do Projeto TeleNordeste – Regional de Propriá",
                start: "2024-05-02",
                backgroundColor: tagsInfo['institucional'].color,
                borderColor: tagsInfo['institucional'].color,
            },
            {
                id: "2",
                title: "2ª Oficina do Projeto TeleNordeste – Regional de Propriá",
                start: "2024-05-06",
                backgroundColor: tagsInfo['religioso'].color,
                borderColor: tagsInfo['religioso'].color,
            },
            {
                title: 'Ano Novo',
                start: new Date().getFullYear() + '-01-01',
                allDay: true
            },
            {
                title: 'Carnaval',
                start: new Date().getFullYear() + '-02-25',
                allDay: true
            },
            {
                title: 'Sexta-feira Santa',
                start: new Date().getFullYear() + '-04-19',
                allDay: true
            },
            {
                title: 'Dia do Trabalhador',
                start: new Date().getFullYear() + '-05-01',
                allDay: true
            },
            {
                title: 'Independência do Brasil',
                start: new Date().getFullYear() + '-09-07',
                allDay: true
            },
            {
                title: 'Nossa Senhora Aparecida',
                start: new Date().getFullYear() + '-10-12',
                allDay: true
            },
            {
                title: 'Finados',
                start: new Date().getFullYear() + '-11-02',
                allDay: true
            },
            {
                title: 'Proclamação da República',
                start: new Date().getFullYear() + '-11-15',
                allDay: true
            },
            {
                title: 'Natal',
                start: new Date().getFullYear() + '-12-25',
                allDay: true
            }
    ]

    document.addEventListener('DOMContentLoaded', () => {
        /* PROCURAR DATA NA URL */
        /* caso não ache uma data válida na url usamos a data do dia atual*/
        const today = new Date();
        /* data iniciada com o valor vigente do dia que o usuário abre o calendário (hoje) */
        let initialDate = today.getFullYear() +
            '-' +
            (today.getMonth() + 1 < 10 ? '0' + (today.getMonth() + 1) : today.getMonth() + 1) +
            '-' + (today.getDate() < 10 ? '0' + today.getDate() : today.getDate());

        /* pega o pathname em array */
        const expectedUrlArray = window.location.pathname.split('/');
        /* tenta converter o valor da url na posição esperada em um obj do tipo date */
        const expectedUrlDate = new Date(expectedUrlArray[2]);

        /* se o obj tiver um valor de dia válido a data vinda da url será passada para data inicial */
        if (expectedUrlDate.getDate()) {
            initialDate = expectedUrlArray[2];
        }
        /* PROCURAR DATA NA URL */

        /* montando lista de links por tag */
        let listItems = '';

        // for (const key in tagsInfo) {
        //     8
        //     listItems +=
        //         `<li class='calendar-page__tags__item' style='background-color: ${tagsInfo[key].color}'><a href='${route + '/categoria/' + tagsInfo[key].friendlyUrl}'>${tagsInfo[key].title}</a></li>`
        // }

        // Adicione esta função para formatar a data no formato 'YYYY-MM-DD'
        function formatDate(date) {
            return date.getFullYear() + '-' + (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-' + (date.getDate() < 10 ? '0' + date.getDate() : date.getDate());
        }
    
        // Adicione os feriados do mês atual (você pode expandir isso para um intervalo de meses)
        const holidays = [
            { title: 'Ano Novo', date: new Date(new Date().getFullYear(), 0, 1) },
            { title: 'Carnaval', date: new Date(new Date().getFullYear(), 1, 25) },
            { title: 'Sexta-feira Santa', date: new Date(new Date().getFullYear(), 3, 19) },
            { title: 'Dia do Trabalhador', date: new Date(new Date().getFullYear(), 4, 1) },
            { title: 'Independência do Brasil', date: new Date(new Date().getFullYear(), 8, 7) },
            { title: 'Nossa Senhora Aparecida', date: new Date(new Date().getFullYear(), 9, 12) },
            { title: 'Finados', date: new Date(new Date().getFullYear(), 10, 2) },
            { title: 'Proclamação da República', date: new Date(new Date().getFullYear(), 10, 15) },
            { title: 'Natal', date: new Date(new Date().getFullYear(), 11, 25) }
        ];
    
        // Filtrar feriados do mês atual
        const currentMonthHolidays = holidays.filter(holiday => holiday.date.getMonth() === new Date().getMonth());
    
        // Montar a lista de feriados
        // let holidayList = '<ul>';
        // currentMonthHolidays.forEach(holiday => {
        //     holidayList += `<li>${formatDate(holiday.date)}: ${holiday.title}</li>`;
        // });
        // holidayList += '</ul>';
    
        // // Adicionar a lista de feriados abaixo do calendário
        // document.querySelector('.calendar-page__legend').innerHTML = holidayList;

        // Função para obter o nome do mês por extenso
        function getMonthName(date) {
            const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            return months[date.getMonth()];
        }

        // Função para formatar o dia no formato 'DD'
        function formatDay(date) {
            return date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
        }

        // Montar a lista de feriados
        let holidayList = `<ul>`;
        currentMonthHolidays.forEach(holiday => {
            holidayList += `<li>${formatDay(holiday.date)} de ${getMonthName(holiday.date)}: <span>${holiday.title}</span></li>`;
        });
        holidayList += '</ul>';

        // Adicionar a lista de feriados abaixo do calendário
        document.querySelector('.calendar-page__legend').innerHTML = holidayList;


        document.querySelector('.calendar-page__tags').innerHTML = listItems;

        /* montando e imprimindo calendário */
        new FullCalendar.Calendar(document.querySelector('.calendar'), {
            locale: 'pt-br',
            initialView: 'dayGridMonth',
            initialDate: initialDate,
            selectable: true,
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: events,
            /* NOTE: OS CLIQUES NOS DIAS E NOS EVENTOS REDIRECIONAM PARA ESSA MESMA PÁGINA COM A DANTA NO LINK */
            eventClick: info => {
                window.location.assign(
                    `${ route }/${ info.event.start.getFullYear() }-${info.event.start.getMonth() + 1 < 10 ? '0'+(info.event.start.getMonth()+1) : info.event.start.getMonth()+1 }-${info.event.start.getDate()<10 ? '0'+info.event.start.getDate() : info.event.start.getDate()}/${info.event.id}#ancora`
                );
            },
            dateClick: info => {
                // window.location.assign(`${route}/${info . dateStr}#eventPanel`);
            }
        }).render();

        /* pega o elemento cujo data é igual a selecionada e add a classe .fc-selectedDate, com ela é possível editar o css da célula do dia selecionado*/
        document.querySelector('[data-date="' + initialDate + '"]').classList.add('fc-selectedDate');
    })
</script>

<style>
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
