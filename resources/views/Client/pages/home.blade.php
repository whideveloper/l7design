@extends('Client.core.main')
@section('content')
    <section id="image-carousel" class="splide slide splide-fade" aria-label="Beautiful Images">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($slides as $slide)
                    <li class="splide__slide"> <!--Resolucao imagem 1440x684-->
                        <img src="{{asset('storage/'. $slide->path_image)}}" alt="{{$slide->title.' '.$slide->subtitle}}" title="{{$slide->title.' '.$slide->subtitle}}">
                        <div class="splide__description">
                            @php
                                $title = $slide->title;
                                $title = str_replace('<br>', "\n", $title);

                                $subtitle = $slide->subtitle;
                                $subtitle = str_replace('<br>', "\n", $subtitle);
                            @endphp

                            <h2 class="splide__title">{{$title}} <br>{{$subtitle}}</h2>
                        </div>
                        <img src="{{asset('Client/assets/images/circulo.svg')}}" alt="circulo" class="slide-fitula-1">
                        <img src="{{asset('Client/assets/images/meia-lua.svg')}}" alt="meia-lua" class="slide-fitula-2">
                        <img src="{{asset('Client/assets/images/rosquinha.svg')}}" alt="rosquinha" class="slide-fitula-3">
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    
    @if ($telenordeste)
    @if ($eventAll->count() < 1)
        <style>
            .telenordeste__content article{
                width: 100%;
            }
        </style>
    @endif
        <section id="telenordeste" class="telenordeste">
            <div class="telenordeste__content">
                <article>
                    <h1 class="telenordeste__title">{{$telenordeste->title}}</h1>
        
                    <p>{!!$telenordeste->text!!}</p>

                    <div class="telenordeste__btn">
                        <a href="https://wa.me/5511998208297" target="_blank">
                            <img src="{{asset('Client/assets/images/wpp.svg')}}" alt="Whatsapp" title="Whatsapp">
                            Entre em contato
                        </a>
                    </div>
                </article>
                @if ($eventAll->count() > 0)
                    <aside>
                        <h4 class="telenordeste__event__title">Próximos Eventos</h4>
                        
                        <ul class="telenordeste__content__event">
                            @foreach($eventAll as $event)
                                @php
                                    $data = Carbon\Carbon::parse($event->date_start)->format('d/m/Y'); 
                                    $dia = Carbon\Carbon::parse($event->date_start)->format('d'); 
                                    $mes = Carbon\Carbon::parse($event->date_start)->format('m'); 
                                @endphp
                                <li class="telenordeste__content__event__list">
                                    {{-- <a href="{{route('calendario', $event->slug)}}" class="link-full"></a> --}}
                                    <div class="telenordeste__content__event__date">
                                        <span class="telenordeste__content__event__day">{{$dia}}</span>
                                        <span class="telenordeste__content__event__month">{{$mes}}</span>
                                    </div>
                                    <p>{{$event->title}}</p>                        
                                </li>
                            @endforeach
                        </ul>   
                        
                        <div class="telenordeste__btn agenda">
                            <a href="{{route('calendario')}}">
                                <img src="{{asset('Client/assets/images/agenda.svg')}}" alt="Agenda" title="Agenda">
                                Ver agenda completa
                            </a>
                        </div>
                    </aside>
                @endif
            </div>
        </section>
    @endif
    @if ($location || $objectives->count() > 0)
        <section id="location" class="location">
            <div class="location__content">
                @if ($location)    
                    <div class="location__column">
                        <h3 class="location__title">Localização</h3>
                        
                        <div class="location__values">
                            <img src="{{asset('Client/assets/images/mapa.svg')}}" alt="Mapa" title="Mapa">

                            <div class="location__values__content">
                                <div class="location__values__box">
                                    <h4 id="cont-1" class="location__value__number">00</h4>
                                    <p class="location__value__title">municípios atendidos</p>
                                </div>
                                <div class="location__values__box">
                                    <h4 id="cont-2" class="location__value__number">0</h4>
                                    <p class="location__value__title">regiões de <br>saúde de Sergipe</p>
                                </div>
                                <div class="location__text__area">
                                    <div class="location__area__text">
                                        {!!$location->description!!}
                                    </div>
                                </div>
                                <a href=""><img src="{{asset('Client/assets/images/location.svg')}}" alt="Location" title="Location"> Mapa completo</a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($objectives->count() > 0)    
                    <div class="location__column right">
                        <h3 class="location__title right">Objetivos específicos</h3>
                        
                        <div class="location__values right location-carrossel-mobile">
                            @foreach($objectives as $objective)
                                <div class="location__values__box right">
                                    <img src="{{asset('storage/' . $objective->path_image)}}" alt="ícone">
                                    <p class="location__area__text">{{$objective->title}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif
    @if ($teleinterconsulta)
        <section class="teleinterconsulta">
            <div class="teleinterconsulta__content">
                <article>
                    @if ($teleinterconsulta->path_image)    
                        <div class="teleinterconsulta__image">
                            <img src="{{asset('Client/assets/images/rendound-top.svg')}}" alt="redound-top" class="redound-top" title="redound-top">

                            <img src="{{asset('storage/' . $teleinterconsulta->path_image)}}" class="hover" alt="{{$teleinterconsulta->title}}" title="{{$teleinterconsulta->title}}">

                            <img src="{{asset('Client/assets/images/rendound-bottom.svg')}}" alt="redound-bottom" class="redound-bottom" title="redound-bottom">
                        </div>
                    @endif

                    @if (!$teleinterconsulta->path_image)
                        <style>
                            .teleinterconsulta__description{
                                width: 100%;
                            }
                        </style>
                    @endif
                    <div class="teleinterconsulta__description">
                        <h2 class="teleinterconsulta__title">{{$teleinterconsulta->title}}</h2>

                        <div class="teleinterconsulta__text">
                            {!!$teleinterconsulta->text!!}
                        </div>

                        <div class="teleinterconsulta__btn">
                            <a href="" class="consulta"><img src="{{asset('Client/assets/images/cursor.svg')}}" alt="Agendar Consulta" title="Agendar Consulta"> Agende sua consulta</a>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    @endif
    @if ($howItWork || $stepToSteps->count() > 0)
        
        <section class="funciona">
            <div class="funciona__content">
                <h2 class="funciona__title">Como funciona?</h2>
                @if (!$howItWork)
                    <style>
                        .funciona__steps{
                            width: 100% !important;
                        }
                        .funciona__content article{
                            width: 86% !important;    
                        }
                    </style>
                @endif
                @if ($stepToSteps->count() > 0)
                    <div class="funciona__steps owl-carousel">
                        @foreach ($stepToSteps as $stepToStep)
                            <article class="funciona__steps__step">
                                <div class="funciona__steps__step__number">{{isset($stepToStep->ordem) ? $stepToStep->ordem : ''}}</div>
                                <div class="funciona__steps__step__description">
                                    {!!$stepToStep->text!!}
                                </div>
                            </article>
                            
                        @endforeach
                    </div>
                @endif

                @if ($stepToSteps->count() < 1)
                    <style>
                        .funciona aside{
                            width: 100% !important;
                        }
                    </style>
                @endif

                @if ($howItWork)
                    <aside>
                        <div class="funciona__steps__step__text">
                            {!!$howItWork->text!!}
                        </div>
                    </aside>
                @endif
            </div>
        </section>        
    @endif
    @if ($hospital)
        <section class="hospital">
            <div class="hospital__content">
                <h2 class="hospital__title">{{$hospital->title}}</h2>
                <article>
                    <div class="hospital__image">
                        <img src="{{asset('Client/assets/images/logo-oswaldo-cruz.jpg')}}" alt="Hospital Alemão Oswaldo Cruz" title="Hospital Alemão Oswaldo Cruz">
                    </div>
                    <p>
                        {!!$hospital->text!!}
                    </p>
                    <div class="hospital__image__bottom">
                        <img src="{{asset('Client/assets/images/image-bottom.jpg')}}" alt="image-bottom" title="image-bottom">
                    </div>
                </article>
            </div>
        </section>
    @endif
    @if ($proadi)
        <section class="proadi">
            <div class="proadi__content">
                <h2 class="proadi__title">{{$proadi->title}}</h2>
                <div class="proadi__content__items">
                    <article>
                        <p>
                            {!!$proadi->text!!}
                        </p>
                    </article>
                    <div class="proadi__image">
                        <img src="{{asset('Client/assets/images/proadi.png')}}" alt="Proadi-SUS" title="Proadi-SUS">
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if($depoiments->count() > 0)
        <section id="depoimento">
            <div class="depoimento__content">
                <h2 class="depoimento__title">Depoimentos</h2>

                <div class="depoimento owl-carousel owl-theme">
                    @foreach($depoiments as $depoiment)
                        <div class="item">
                            <div class="item__description">
                                <p>
                                    {!!$depoiment->text!!}
                                </p>
                                <h5 class="item__title">{{$depoiment->name}}</h5>
                                <span>{{$depoiment->cargo}}</span>
                            </div>
                        </div>                    
                    @endforeach  
                </div>
            </div>
        </section>
    @endif

    {{-- <span id="footer"></span> --}}

    <script>
        // Função para verificar se a sessão está visível na tela
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Função para iniciar a contagem quando a sessão está visível na tela
        function startCountersWhenVisible() {
            var locationSection = document.querySelector('.location');
            var isCountingStarted = false;

            function startCounters() {
                if (isCountingStarted) return;

                animateValue("cont-1", 0, {{isset($location->number_county)?$location->number_county:00}}, 2000); // Animação para o primeiro contador
                animateValue("cont-2", 0, {{isset($location->number_region)?$location->number_region:0}}, 2000); // Animação para o segundo contador

                isCountingStarted = true;
            }

            function handleScroll() {
                if (isElementInViewport(locationSection)) {
                    startCounters();
                    window.removeEventListener('scroll', handleScroll); // Remove o ouvinte de evento de rolagem após iniciar a contagem
                }
            }

            window.addEventListener('scroll', handleScroll);
        }

        // Função para animar o contador
        function animateValue(id, start, end, duration) {
            var obj = document.getElementById(id);
            var range = end - start;
            var current = start;
            var increment = end > start ? 1 : -1;
            var stepTime = Math.abs(Math.floor(duration / range));
            var timer = setInterval(function() {
                current += increment;
                obj.textContent = current;
                if (current == end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }

        // Inicia a contagem quando a sessão está visível na tela
        startCountersWhenVisible();

    </script>
    
@endsection
