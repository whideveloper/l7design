@extends('Client.core.main')
@section('content')
<section class="especialidades"> 
    <div class="especialidades__content">
        <div class="especialidades__text">
            <p>
                Seja bem-vindo ao nosso mural de comunicação!
                <br><br>
                Este é o espaço onde compartilhamos as últimas novidades, destaques do projeto, eventos emocionantes, atualizações e avisos importantes.
                <br><br>
                Mantenha-se informado sobre tudo o que está acontecendo.
            </p>
        </div>
        
        <div class="especialidades__categories">
            <ul class="especialidades__categories__list {{ url()->current() == route('mural-de-comunicacao') ? 'mural-de-comunicacao' : ''  }}">
                <li class="especialidades__categories__item"><a href="">Notícias e Novidades</a></li>
                <li class="especialidades__categories__item"><a href="">TeleNordeste em destaque</a></li>
                <li class="especialidades__categories__item"><a href="">Eventos e Calendários</a></li>
                <li class="especialidades__categories__item"><a href="">Treinamentos e Capacitações</a></li>
                <li class="especialidades__categories__item"><a href="">Avisos e alertas</a></li>
            </ul>
        </div>
        
        @php
            $imagePath = asset('Client/assets/images/com-1.jpg');

            $content = [
                'title' => 'Título lorem ipsum dolorem consectum vertun quantus',
                'date' => '21/02/2024',
                'funcao' => '',
                'crm' => '',            
                'image' => $imagePath,
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim tincidunt porttitor...',
                'link' => 'mural-de-comunicacao-interna',
                'btnName' => 'saiba mais',
            ];
        @endphp
    
        @for ($i = 0; $i < 3; $i++)
            @include('Client.models.mdl-box', $content)
        @endfor
        
        <!-- Elemento para mostrar o indicador de carregamento -->
        <div id="carregamento" style="display: none;"><img src="{{asset('Client/assets/images/loading.svg')}}" alt=""></div>
    </div>
</section>

<script>
    // Verifica se a largura da tela é maior ou igual a 530px antes de executar o código JavaScript
    $(window).resize(function() {
        if ($(window).width() <= 530) {
            var carregando = false;
            var artigoAtual = 4; // O próximo artigo a ser carregado

            $(window).scroll(function() {
                // Se o usuário rolar até o final do terceiro box e não estiver carregando
                if ($(window).scrollTop() >= $('.mdl-box:nth-child(3)').offset().top + $('.mdl-box:nth-child(3)').outerHeight() - $(window).height() && !carregando) {
                    carregando = true;
                    $('#carregamento').show(); // Mostra o indicador de carregamento
            
                    // Simula uma requisição assíncrona para carregar o próximo artigo
                    setTimeout(function() {
                        $('.especialidades__content').append(
                            '<article class="mdl-box mural-de-comunicacao">' +
                            '<div class="mdl-box__content">' +
                            '<div class="mdl-box__image">' +
                            "<img src='{{ $imagePath }}' alt='' class='mdl-box__left'>" +
                            '</div>' +
                            '<div class="mdl-box__description">' +
                            '<div class="mdl-box__right">' +
                            '<h3 class="mdl-box__title">Título lorem ipsum dolorem consectum vertun quantus</h3>' +
                            '<span class="mdl-box__date">21/02/2024</span>' +
                            '<span class="mdl-box__function"></span>' +
                            '<span class="mdl-box__crm"></span>' +
                            '<p class="mdl-box__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim tincidunt porttitor...</p>' +
                            '</div>' +
                            '<div class="mdl-box__btn">' +
                            '<a href="" class="more">saiba mais</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</article>'
                        );
                        artigoAtual++;
                        carregando = false;
                        $('#carregamento').hide(); // Esconde o indicador de carregamento
                    }, 2000); // Tempo simulado de carregamento
                }
            });
        }
    }).resize(); // Executa a verificação inicial ao carregar a página
</script>

@endsection


