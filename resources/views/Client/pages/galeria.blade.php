@extends('Client.core.main')
@section('content')
    <section class="galeria">
        <div class="galeria__content">
            <div class="galeria__text">
                <p>Acompanhe a nossa galeria de fotos. Aqui compartilhamos os registros dos nossos eventos, treinamentos, visitas e muito mais!</p>
            </div>

            <div class="galeria__list">
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Elemento para mostrar o indicador de carregamento -->
            <div id="carregamento" style="display: none;"><img src="{{asset('Client/assets/images/loading.svg')}}" alt=""></div>
        </div>
    </section>

    <script>
       $(window).resize(function() {
            if ($(window).width() <= 530) {
                var carregando = false;
                var artigoAtual = 4; // O próximo artigo a ser carregado

                // Função para carregar os artigos adicionais
                function carregarArtigos() {
                    // Se o usuário rolar até o final do terceiro box e não estiver carregando
                    if ($(window).scrollTop() >= $('.galeria__item:nth-child(3)').offset().top + $('.galeria__item:nth-child(3)').outerHeight() - $(window).height() && !carregando) {
                        carregando = true;
                        $('#carregamento').show(); // Mostra o indicador de carregamento

                        // Simula uma requisição assíncrona para carregar o próximo artigo
                        setTimeout(function() {
                            for (var i = 0; i < 3; i++) {
                                $('.galeria__list').append(
                                    '<div class="galeria__item">' +
                                    '<a href="{{route('galeria-interna')}}" class="link-full"></a>' +
                                    '<h2 class="galeria__title">Evento</h2>' +
                                    '<div class="description">' +
                                    '<div class="galeria__image">' +
                                    '<img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">' +
                                    '</div>' +
                                    '<div class="galeria__text">' +
                                    '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'
                                );
                            }
                            artigoAtual += 3;
                            carregando = false;
                            $('#carregamento').hide(); // Esconde o indicador de carregamento
                        }, 2000); // Tempo simulado de carregamento
                    }
                }

                // Chama a função de carregar os artigos ao fazer o resize da janela
                carregarArtigos();

                // Evento de scroll para chamar a função de carregar os artigos
                $(window).scroll(carregarArtigos);
            }
        }).resize(); // Executa a verificação inicial ao carregar a página

    </script>
@endsection