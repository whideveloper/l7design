@extends('Client.core.main')
@section('content')
    <section class="galeria evento">
        <div class="galeria__content">
            <div class="galeria__text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium. Praesent velit enim, facilisis quis suscipit vel, gravida fringilla tortor. Proin at mi congue, feugiat magna eget, faucibus enim. Etiam laoreet rhoncus feugiat. Donec et ante ut erat convallis mattis.</p>
            </div>

            <div class="galeria__list">
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-2.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-2.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
            </div>

            <!-- Elemento para mostrar o indicador de carregamento -->
            <div id="carregamento" style="display: none;"><img src="{{asset('Client/assets/images/loading.svg')}}" alt=""></div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            var carregando = false;
            var artigoAtual = 4; // O próximo artigo a ser carregado

            // Função para carregar os artigos adicionais
            function carregarArtigos() {
                // Se o usuário rolar até o final do terceiro box e não estiver carregando
                if ($(window).scrollTop() >= $(document).height() - $(window).height() && !carregando) {
                    carregando = true;
                    $('#carregamento').show(); // Mostra o indicador de carregamento

                    // Simula uma requisição assíncrona para carregar o próximo artigo
                    setTimeout(function() {
                        for (var i = 0; i < 3; i++) {
                            $('.galeria__list').append(
                                '<div class="galeria__item">' +
                                '<div class="galeria__image">' +
                                '<a href="{{asset('Client/assets/images/galeria-1.jpg')}}" data-fancybox="gallery" class="link-full"></a>' +
                                '<img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">' +
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

            // Chama a função de carregar os artigos ao fazer o scroll da página
            $(window).scroll(carregarArtigos);

            // Chama a função de carregar os artigos ao fazer o resize da janela
            $(window).resize(carregarArtigos);

            // Chama a função de carregar os artigos ao carregar a página
            carregarArtigos();
        });

    </script>
@endsection