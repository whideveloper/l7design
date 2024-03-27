@extends('Client.core.main')
@section('content')
    <section id="image-carousel" class="splide slide splide-fade" aria-label="Beautiful Images">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <img src="{{asset('Client/assets/images/banner.jpg')}}" alt="Conte com o time do Telenordeste" title="Conte com o time do Telenordeste">
                    <div class="splide__description">
                        <h2 class="splide__title">Conte com o time <br>do Telenordeste</h2>
                    </div>
                </li>
                <li class="splide__slide">
                    <img src="{{asset('Client/assets/images/black.jpg')}}" alt="Telenordeste: A telesaúde abraçando Sergipe" title="Telenordeste: A telesaúde abraçando Sergipe">
                    <div class="splide__description">
                        <h2 class="splide__title">Telenordeste: <br> A telesaúde <br>abraçando Sergipe</h2>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="telenordeste">
        <div class="telenordeste__content">
            <article>
                <h1 class="telenordeste__title">O que é o Telenordeste</h1>
    
                <p>
                    É um projeto que faz parte do Programa de Apoio ao Desenvolvimento Institucional do Sistema Único de Saúde (PROADI-SUS), executado pelo <b>Hospital Alemão Oswaldo Cruz</b> demandado pela Secretaria de Informação e Saúde Digital (SEIDIGI) do Ministério da Saúde (MS), com apoio do Conselho Nacional de Secretários de Saúde (CONASS). <br><br>Foi desenvolvido em Sergipe por meio da parceria com a Secretaria de Estado da Saúde de Sergipe (SES/SE), com o objetivo de conectar  profissionais da Atenção Primária à Saúde (APS) dos municípios a médicos especialistas de diversas áreas do Hospital Alemão Oswaldo Cruz, para apoio no atendimento de pacientes através das ações de <b>Telessaúde</b>, como a <b>Teleinterconsulta</b> e <b>Teleconsultoria</b>.<br><br>O projeto é uma proposta inovadora que otimiza o fluxo assistencial, com benefícios tanto para os pacientes quanto para os profissionais de saúde.
                </p>

                <div class="telenordeste__btn">
                    <a href="">
                        <img src="{{asset('Client/assets/images/wpp.svg')}}" alt="Whatsapp" title="Whatsapp">
                        Entre em contato
                    </a>
                </div>
            </article>
            <aside>
                <h4 class="telenordeste__event__title">Próximos Eventos</h4>
                
                <ul class="telenordeste__content__event">
                    <li class="telenordeste__content__event__list">
                        <a href="" class="link-full"></a>

                        <div class="telenordeste__content__event__date">
                            <span class="telenordeste__content__event__day">15</span>
                            <span class="telenordeste__content__event__month">12</span>
                        </div>
                        <p>Início das atividades de Apoiadores Regionais</p>                        
                    </li>
                    <li class="telenordeste__content__event__list">
                        <a href="" class="link-full"></a>

                        <div class="telenordeste__content__event__date">
                            <span class="telenordeste__content__event__day">15</span>
                            <span class="telenordeste__content__event__month">12</span>
                        </div>
                        <p>Início das atividades de Apoiadores Regionais</p>                        
                    </li>
                    <li class="telenordeste__content__event__list">
                        <a href="" class="link-full"></a>

                        <div class="telenordeste__content__event__date">
                            <span class="telenordeste__content__event__day">15</span>
                            <span class="telenordeste__content__event__month">12</span>
                        </div>
                        <p>Início das atividades de Apoiadores Regionais</p>                        
                    </li>
                    <li class="telenordeste__content__event__list">
                        <a href="" class="link-full"></a>

                        <div class="telenordeste__content__event__date">
                            <span class="telenordeste__content__event__day">15</span>
                            <span class="telenordeste__content__event__month">12</span>
                        </div>
                        <p>Início das atividades de Apoiadores Regionais</p>                        
                    </li>
                </ul>   
                
                <div class="telenordeste__btn agenda">
                    <a href="">
                        <img src="{{asset('Client/assets/images/agenda.svg')}}" alt="Agenda" title="Agenda">
                        Ver agenda completa
                    </a>
                </div>
            </aside>
        </div>
    </section>
    <section class="location">
        <div class="location__content">
            <div class="location__column">
                <h3 class="location__title">Localização</h3>
                
                <div class="location__values">
                    <img src="{{asset('Client/assets/images/mapa.svg')}}" alt="Mapa" title="Mapa">

                    <div class="lacation__values__content">
                        <div class="location__values__box">
                            <h4 class="location__value__number">00</h4>
                            <p class="location__value__title">municípios atendidos</p>
                        </div>
                        <div class="location__values__box">
                            <h4 class="location__value__number">0</h4>
                            <p class="location__value__title">regiões de <br>saúde de Sergipe</p>
                        </div>
                        <div class="location__text__area">
                            <p class="location__area__text">
                                O projeto será ofertado aos 75 municípios do Estado de Sergipe, que são divididos em sete Regiões de Saúde (Itabaiana, Lagarto, Aracaju, Estância, Nossa Senhora do Socorro, Nossa Senhora da Glória e Propriá).
                            </p>
                        </div>
                        <a href=""><img src="{{asset('Client/assets/images/location.svg')}}" alt="Location" title="Location"> Mapa completo</a>
                    </div>
                </div>
            </div>

            <div class="location__column">
                <h3 class="location__title">Objetivos específicos</h3>
                
                <div class="location__values">
                    <div class="location__values__box right">
                        <img src="{{asset('Client/assets/images/fluxo.svg')}}" alt="ícone">
                        <p class="location__value__text">Otimizar o fluxo assistencial</p>
                    </div>
                    <div class="location__values__box right">
                        <img src="{{asset('Client/assets/images/fluxo.svg')}}" alt="ícone">
                        <p class="location__value__text">Fortalecer processos de trabalho na APS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section>

        @php
            $content = [
                'title' => 'porque confiar na',
                'highlight' => 'whi',
                'image' => asset('Client/assets/images/cat-sqr.jpg'),
                'text' => 'Confie na gente para transformar sua marca em uma experiência digital incrível. Nossa agência une criatividade, tecnologia e compromisso para construir sua presença online de forma inovadora e impactante.',
            ];
        @endphp

        @for ($i = 0; $i < 3; $i++)
            @include('Client.models.mdl-article', $content)
        @endfor

    </section>
@endsection
