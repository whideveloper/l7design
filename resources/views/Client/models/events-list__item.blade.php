
    <a id="ancora" href="#"></a>
    <li class="events-list__item">
        <div class="events-list__before">
            <h3 class="calendar-page__selected-date">{{$date}} - <span class="events-list__time">{{$time}}</span></h3>
            <h4 class="events-list__title">          
                {{$title}}
            </h4>
        </div>
        
        <div class="events-list__text">
            <p>{{$text}}</p>
        </div>
        

        <div class="eng-btn-event">
    {{--        <a href="{{route('evento-calendario', ['slug' => $evento->date_start])}}" class="btn-event">Ir para o evento</a>--}}
    {{--        <button id="adicionarClasseBtn" class="btn-more">Ver Mais <span class="icon-text">&#xe93e;</span></button>--}}
        </div>
    {{--    <button class="events-list__action-trigger">Ver Mais <span class="icon-text">&#xe93e;</span></button>--}}
    </li>{{-- END .events-list__item --}}

