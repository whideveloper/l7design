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
    <section id="location" class="location">
        <div class="location__content">
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
                            <p class="location__area__text">
                                O projeto será ofertado aos 75 municípios do Estado de Sergipe, que são divididos em sete Regiões de Saúde (Itabaiana, Lagarto, Aracaju, Estância, Nossa Senhora do Socorro, Nossa Senhora da Glória e Propriá).
                            </p>
                        </div>
                        <a href=""><img src="{{asset('Client/assets/images/location.svg')}}" alt="Location" title="Location"> Mapa completo</a>
                    </div>
                </div>
            </div>

            <div class="location__column right">
                <h3 class="location__title right">Objetivos específicos</h3>
                
                <div class="location__values right">
                    <div class="location__values__box right">
                        <img src="{{asset('Client/assets/images/fluxo.svg')}}" alt="ícone">
                        <p class="location__area__text">Otimizar o fluxo assistencial</p>
                    </div>
                    <div class="location__values__box right">
                        <img src="{{asset('Client/assets/images/processo.svg')}}" alt="ícone">
                        <p class="location__area__text">Fortalecer processos de trabalho na APS</p>
                    </div>
                    <div class="location__values__box right">
                        <img src="{{asset('Client/assets/images/servico.svg')}}" alt="ícone">
                        <p class="location__area__text">Fortalecer processos de trabalho na APS</p>
                    </div>
                    <div class="location__values__box right">
                        <img src="{{asset('Client/assets/images/profissionais.svg')}}" alt="ícone">
                        <p class="location__area__text">Fortalecer processos de trabalho na APS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="teleinterconsulta">
        <div class="teleinterconsulta__content">
            <article>
                <div class="teleinterconsulta__image">
                    <img src="{{asset('Client/assets/images/rendound-top.svg')}}" alt="redound-top" class="redound-top" title="redound-top">

                    <img src="{{asset('Client/assets/images/teleinterconsulta.jpg')}}" class="hover" alt="Teleinterconsulta" title="Teleinterconsulta">

                    <img src="{{asset('Client/assets/images/rendound-bottom.svg')}}" alt="redound-bottom" class="redound-bottom" title="redound-bottom">
                </div>
                <div class="teleinterconsulta__description">
                    <h2 class="teleinterconsulta__title">O que é a Teleinterconsulta?</h2>

                    <p class="teleinterconsulta__text">A <b>Teleinterconsulta</b> e a <b>Teleconsultoria</b> são modalidades de compartilhamento do cuidado que ocorrem de forma remota, com o objetivo de fortalecer o processo de trabalho na Atenção Primária.
                    <br><br>
                    Elas visam a promover a ampliação e a resolutividade das ações e serviços de forma integrada e planejada, além de expandir a oferta de serviços de atenção especializada.
                    <br><br>
                    Na <b>Teleinterconsulta</b>, o profissional da APS, na presença do paciente na UBS (Unidade Básica de Saúde), troca informações e opiniões com o médico especialista por meio de tecnologias digitais.
                    <br><br>
                    A <b>Teleconsultoria</b> também funciona com a discussão de caso, porém sem a presença do paciente. Entre as especialidades disponibilizadas no projeto estão: Neurologia adulto e pediátrica; Psiquiatria adulto e pediátrica; Cardiologia; Endocrinologia adulto e pediátrica; Urologia; Fisiatria; Medicina de Família e Comunidade; Nutrição; e Enfermagem.
                    </p>

                    <div class="teleinterconsulta__btn">
                        <a href="" class="consulta"><img src="{{asset('Client/assets/images/cursor.svg')}}" alt="Agendar Consulta" title="Agendar Consulta"> Agende sua consulta</a>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <section class="funciona">
        <div class="funciona__content">
            <h2 class="funciona__title">Como funciona?</h2>

            <div class="funciona__steps">
                <article class="funciona__steps__step">
                    <div class="funciona__steps__step__number">1</div>
                    <p class="funciona__steps__step__description">
                        Inicialmente, os municípios interessados devem assinar o Termo de Adesão e preencher o formulário on-line com dados gerais da Rede de Atenção à Saúde local. É importante que o gestor municipal realize uma conversa com os profissionais de saúde para apresentação do projeto e alinhamentos de sua implantação na rotina das equipes, podendo contar com a equipe do <b>TeleNordeste</b>, de forma virtual.
                    </p>
                </article>
                <article class="funciona__steps__step">
                    <div class="funciona__steps__step__number">2</div>
                    <p class="funciona__steps__step__description">
                        Após a adesão, os profissionais cadastrados devem realizar o treinamento, de forma on-line, para uso da plataforma, e assim começar a realizar os agendamentos para <b>Teleinterconsultas</b>/ <b>Teleconsultorias</b>.
                    </p>
                </article>
                <article class="funciona__steps__step">
                    <div class="funciona__steps__step__number">3</div>
                    <p class="funciona__steps__step__description">
                        A partir de casos selecionados pelos médicos da APS, os pacientes chegam no horário agendado na Unidade de Saúde para a consulta com o médico que, por chamada de vídeo, se conecta com o especialista do, <b>Hospital Alemão Oswaldo Cruz</b> para a condução compartilhada do caso, com a possibilidade de três desfechos: retorno por <b>Teleinterconsulta</b>, alta para APS ou encaminhamento para a Atenção Especializada presencial.
                    </p>    
                </article>
            </div>
            <aside>
                <p class="funciona__steps__step__text">
                    Existem ainda outras modalidades de apoio por <b>Telessaúde</b> feitas sem a presença do paciente, no formato assíncrono, ou seja, sem a necessidade de agendamento, onde o questionamento do profissional da APS ao especialista é feito via plataforma, com resposta em até 72 horas úteis.
                    <br><br>
                    Ainda que o projeto promova um acesso imediato do paciente, seu grande legado é o aprimoramento dos profissionais da APS. As múltiplas interações com os especialistas permitem um aprendizado no manejo de situações que anteriormente geravam encaminhamentos para a atenção especializada.
                    <br><br>
                    Esse processo formativo garante a sustentabilidade dos ganhos desenvolvidos ao longo do projeto, qualificando desta forma os encaminhamentos à atenção especializada, otimizando o acesso para casos de fato necessários, com tendência à diminuição das filas de espera.
                </p>
            </aside>
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

                animateValue("cont-1", 0, 180, 2000); // Animação para o primeiro contador
                animateValue("cont-2", 0, 55, 2000); // Animação para o segundo contador

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
