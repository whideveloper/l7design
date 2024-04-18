@extends('Client.core.main')
@section('content')
<section class="teleinterconsulta">
    <div class="teleinterconsulta__content savs">
        <article class="{{ url()->current() == route('savs') ? 'savs' : ''  }}">
            <div class="teleinterconsulta__image">
                <img src="{{asset('Client/assets/images/rendound-top.svg')}}" alt="redound-top" class="redound-top" title="redound-top">

                <img src="{{asset('Client/assets/images/sav.jpg')}}" class="hover" alt="Material de apoio" title="Material de apoio">

                <img src="{{asset('Client/assets/images/rendound-bottom.svg')}}" alt="redound-bottom" class="redound-bottom" title="redound-bottom">
            </div>
            <div class="teleinterconsulta__description">
                <h2 class="teleinterconsulta__title">Sessões de Aprendizado Virtual (SAVs)</h2>

                <p class="teleinterconsulta__text">
                    As sessões de aprendizagem virtual (SAV) realizadas são aulas preparadas pelos especialistas do projeto com foco em temas relevantes para os profissionais da Atenção Primária. Essas sessões visam a fornecer conhecimento e habilidades práticas para os profissionais de Saúde que trabalham nesse contexto específico.
                    <br><br>
                    Durante essas sessões, os especialistas abordam uma variedade de tópicos que podem incluir, por exemplo, diagnóstico e manejo de condições de saúde comuns no dia a dia na Atenção Primária, diretrizes de prática clínica atualizadas, estratégias de prevenção da doença e promoção da saúde, entre outros.
                    <br><br>
                    As aulas ficam gravadas, permitindo que os profissionais acessem o conteúdo de forma flexível, adaptando-se aos seus horários e necessidades individuais.
                    <br><br>
                    Em resumo, as sessões de aprendizagem virtual do projeto oferecem uma oportunidade valiosa para os profissionais aprimorarem suas habilidades e conhecimentos, contribuindo assim para uma prestação de cuidados de saúde mais eficaz e de qualidade para os pacientes.
                    <br><br>
                    Não esqueça de colocar em sua agenda nossas próximas aulas, podendo participar em tempo real, junto ao especialista, tirando dúvidas e discutindo casos do dia a dia. Para conhecer a datas e temas, clique no botão abaixo.
                </p>

                <div class="row">
                    <div class="teleinterconsulta__btn sav-gravada">
                        <a href="" class="consulta"><img src="{{asset('Client/assets/images/pdf.svg')}}" alt="Sav's gravadas" title="Sav's gravadas"> Assista as SAVs gravadas</a>
                    </div>
                    <div class="teleinterconsulta__btn proxima-sav">
                        <a href="" class="consulta"><img src="{{asset('Client/assets/images/agenda.svg')}}" alt="Próximas Sav's" title="Próximas Sav's">Próximas SAVs</a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<section class="savs__gravadas">
    <div class="savs__gravadas__content">
        <h2 class="savs__gravadas__title">SAVs gravadas</h2>
        <p class="savs__gravadas__text">Selecione a SAV (sessão de aprendizagem virtual) desejada e clique no link para acessar a gravação. Será necessário o preenchimento de um breve formulário para acessar a aula.</p>
        
        <div class="savs__gravadas__list">
            <div class="savs__gravadas__item">
                <a href="#video-lead" id="click-lead" class="link-full"></a>
                <img src="{{asset('Client/assets/images/v1.jpg')}}" class="savs__gravadas__capa" alt="Imagem de capa">
                <div class="image__play">
                    <img src="{{asset('Client/assets/images/play.svg')}}" class="savs__gravadas__play" alt="Imagem de play">
                </div>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/Smgi8rJOO2E?si=nuM3xexSreI09keX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>          
            
            <div class="savs__gravadas__item">
                <img src="{{asset('Client/assets/images/v1.jpg')}}" class="savs__gravadas__capa" alt="Imagem de capa">
                <div class="image__play">
                    <img src="{{asset('Client/assets/images/play.svg')}}" class="savs__gravadas__play" alt="Imagem de play">
                </div>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/Smgi8rJOO2E?si=nuM3xexSreI09keX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>  
        </div>
    </div>
</section>
@endsection