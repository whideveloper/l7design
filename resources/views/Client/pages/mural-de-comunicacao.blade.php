@extends('Client.core.main')
@section('content')
<section class="especialidades"> 
    <div class="especialidades__content">
        @if ($sessaoMuralDeComunicacao)
            <div class="especialidades__text">
                <p>
                    {!! $sessaoMuralDeComunicacao->text !!}
                </p>
            </div>
        @endif
        
        @if ($categorias->count() > 0)
            <div class="especialidades__categories">
                <ul class="especialidades__categories__list {{ url()->current() == route('mural-de-comunicacao') ? 'mural-de-comunicacao' : ''  }}">
                    @foreach ($categorias as $category)
                        <li class="especialidades__categories__item {{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{route('mural-de-comunicacao-category', [$category->slug])}}">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($muralDeComunicacoes->count() > 0)
            @foreach ($muralDeComunicacoes as $mural)
                @php
                    $imagePath = asset('storage/'. $mural->path_image);
                    $description = $mural->description;
                    $descricao = strip_tags($description);  
                    $data = Carbon\Carbon::parse($mural->publish_date)->format('d/m/Y');                

                    $content = [
                        'id' => $mural->id,
                        'title' => $mural->title,
                        'date' => $data,
                        'funcao' => '',
                        'crm' => '',            
                        'image' => $imagePath,
                        'text' => substr(strip_tags($descricao),0,150),
                        'link' => "{{route('mural-de-comunicacao-interna')}}",
                        'btnName' => 'saiba mais',
                    ];
                @endphp    
                @include('Client.models.mdl-box', $content)
            @endforeach
        @endif
       
        
        <!-- Elemento para mostrar o indicador de carregamento -->
        <div id="carregamento" style="display: none;"><img src="{{asset('Client/assets/images/loading.svg')}}" alt=""></div>
    </div>
</section>

{{-- <script>
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
</script> --}}

@endsection


