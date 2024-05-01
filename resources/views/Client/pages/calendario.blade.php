@extends('Client.core.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js"></script>
    <section class="calendar-page__header">
        <div class="calendar__content">
            <div class="calendar-page">
                <div class="wrap style">
                    {{-- <div class="icon-ttl">
                        <div class="icon-ttl__icon">
                            <img src="{{ asset('Client/assets/images/icon-ttl-index-eventos.svg') }}" alt="Ícone de eventos">
                        </div>
                        <h3 class="icon-ttl__title">Calendário e Eventos</h3>
                    </div>END .icon-ttl --}}
        
                    <ul class="calendar-page__tags"></ul>
        
                    <div class="calendar"></div>
        
                    <aside id="eventPanel" class="calendar-page__aside">
                        
                        <h3 class="calendar-page__selected-date">01/05/2024 - <span>9h às 12h</span></h3>
                        
                        <ul class="events-list">
        
                            @include('Client.models.events-list__item')
        
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

        'Titulo da categoria do evento': {
            friendlyUrl: 'titulo-do-evento',
            title: 'Titulo da categoria do evento',
            color: '#000',
        },
       
    }

    /* rota base para montar lista de links pelas tags */
    const route = " {{ route('calendario') }}";

    /* a abaixo, os campos de backgroundColor e borderColor recebem a tag específica do */
    const events = [
            {
                id: "1",
                title: "Evento 01",
                start: "01/05",
                backgroundColor: tagsInfo['Titulo da categoria do evento'].color,
                borderColor: tagsInfo['Titulo da categoria do evento'].color,
            },
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