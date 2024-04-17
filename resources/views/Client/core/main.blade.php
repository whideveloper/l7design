<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>L7Design</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="CONTENT-LANGUAGE" content="Portuguese" />
    {{-- <link rel="shortcut icon" href="{{ asset(mix('Client/assets/images/')) }}" /> --}}

    <meta name="copyright" content="L7Design" />
    <meta name="title" content="L7Design" />
    <meta name="author" content="WHI - WEB DE ALTA INSPIRAÇÃO" />
    <meta name="description" content="Descrição" />
    <meta name="keywords" content="Palavras chave" />
    <!-- METAS DO FACEBOOK COMPARTILHAR -->
    <meta property="og:url" content="{{ url('') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="L7Design" />
    <meta property="og:description" content="Descrição" />
    {{-- <meta property="og:image" content="{{ asset(mix('')) }}" /> --}}
    <!-- METAS DO TWITTER COMPARTILHAR -->
    <meta name="twitter:card" content="L7Design" />
    <meta name="twitter:site" content="{{ url('') }}" />
    {{-- <meta name="twitter:image" content="{{ asset(mix('')) }}" /> --}}
    <meta name="twitter:creator" content="WHI - WEB DE ALTA INSPIRAÇÃO" />
    <meta name="twitter:title" content="L7Design" />
    <meta name="twitter:description" content="Descrição" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/main.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/responsivo.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/splide.min.css')) }}" />
    <!--fonts google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!--Animate CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!--Owl Carousel CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <header id="header" class="header">
        <div class="header__content">
            <div class="hearder__position">
                <div class="header__image">
                    <a href="">
                        <img src="{{ asset('Client/assets/images/logo-telenordeste.svg') }}" alt="Telenordeste" title="Telenordeste">
                    </a>
                </div>
                <nav class="header__nav">
                    <ul class="header__list">
                        <li class="header__item"><a href="{{route('home')}}" class="{{ Route::currentRouteName() == 'home' ? 'active' : ''}}">Home</a></li>
                        <li class="header__item"><a href="{{route('especialidades')}}" class="{{ Route::currentRouteName() == 'especialidades' ? 'active' : ''}}">Especialidades</a></li>
                        <li class="header__item"><a href="{{route('material-de-apoio')}}" class="{{ Route::currentRouteName() == 'material-de-apoio' ? 'active' : ''}}">Material de apoio</a></li>
                        <li class="header__item"><a href="{{route('mural-de-comunicacao')}}" class="{{ Route::currentRouteName() == 'mural-de-comunicacao' ? 'active' : ''}}">Mural de comunicação</a></li>
                        <li class="header__item"><a href="">SAVs</a></li>
                        <li class="header__item"><a href="">Desempenho</a></li>
                        <li class="header__item"><a href="">Galeria</a></li>
                        <li class="header__item"><a href="">Contatos e Sugestões</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    @if (Route::currentRouteName() !== 'home')    
        @php
            if (Route::currentRouteName() == 'especialidades') {
                $content = [
                    'title' => 'Especialidades',
                ];
            }
            if(Route::currentRouteName() == 'contato'){
                $content = [
                    'title' => 'Contato',
                ];
            }
            if(Route::currentRouteName() == 'mural-de-comunicacao'){
                $content = [
                    'title' => 'Mural de comunicação',
                ];
            }
            if(Route::currentRouteName() == 'material-de-apoio'){
                $content = [
                    'title' => 'Material de apoio',
                ];
            }
        @endphp
        @include('Client.models.banner-interno', $content)
    @endif

    

    <main id="page">
        @yield('content')
    </main>
     <section id="footer" class="footer">
        <div class="footer__logos">
            <ul class="footer__logos__items owl-carousel">
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/haoc-footer.svg')}}" alt="HAOC" title="HAOC"></a></li>
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/csemse.svg')}}" alt="CSEMSE" title="CSEMSE"></a></li>
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/conass.svg')}}" alt="CONASS" title="CONASS"></a></li>
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/proadi.svg')}}" alt="PROADI" title="PROADI"></a></li>
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/sus.svg')}}" alt="SUS" title="SUS"></a></li>
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/msaude.svg')}}" alt="MSAUDE" title="MSAUDE"></a></li>
                <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/brgov.svg')}}" alt="BRGOV" title="BRGOV"></a></li>
            </ul>
            <div class="footer__contact">
                <h6 class="footer__contact__title">Contato</h6>
                <div class="footer__contact__items">
                    <ul class="footer__contact__items__left">
                        <li><a href="https://wa.me/5511998208297"><img src="{{asset('Client/assets/images/wpp-footer.svg')}}" alt="Whatsapp" title="Whatsapp"> <b>Whatsapp:</b> 11 99820-8297</a></li> <span class="linha">|</span>
                        <li><a href="mailto:projetotelenordeste@haoc.com.br"><img src="{{asset('Client/assets/images/email-footer.svg')}}" alt="E-mail" title="E-mail"> projetotelenordeste@haoc.com.br</a></li>
                    </ul>
                    <ul class="footer__contact__items__right">
                        <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/proadi-footer.svg')}}" alt="PROADI" title="PROADI"></a></li> 
                        <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/haoc.svg')}}" alt="HAOC" title="HAOC"></a></li> 
                        <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/insta.svg')}}" class="insta" alt="Instagram" title="Instagram"></a></li> 
                        <li><a href="" target="_blank"><img src="{{asset('Client/assets/images/linkedin.svg')}}" class="linkedin" alt="LinkedIn" title="LinkedIn"></a></li>
                    </ul>
                </div>
            </div>
        </div>
     </section>
    <script src="{{ asset(mix('Client/assets/js/main.js')) }}"></script>
    <script src="{{ asset(mix('Client/assets/js/splide.min.js')) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>

</html>
<!-- END -->
