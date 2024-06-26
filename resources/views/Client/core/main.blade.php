<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Projeto Telenordeste</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="CONTENT-LANGUAGE" content="Portuguese" />
    <link rel="shortcut icon" href="{{ asset('Client/assets/images/favicon.png') }}" />

    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Organization",
          "name": "Projeto Telenordeste",
          "url": "https://telenordeste-se.com.br/",
          "sameAs": [
            "https://www.linkedin.com/company/hospitais-proadi-sus/",
            "https://www.instagram.com/hospitaisproadisus/"
          ],
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Rua Treze de Maio, 1815 Bela Vista",
            "addressLocality": "São Paulo",
            "addressRegion": "SP",
            "postalCode": "01327-001",
            "addressCountry": "BR"
          }
        }
    </script>
                

    <meta name="copyright" content="Projeto Telenordeste" />
    <meta name="title" content="Projeto Telenordeste" />
    <meta name="author" content="WHI - WEB DE ALTA INSPIRAÇÃO" />
    <meta name="description" content="Projeto que faz parte do Programa de Apoio ao Desenvolvimento Institucional do Sistema Único de Saúde (PROADI-SUS), executado pelo Hospital Alemão Oswaldo Cruz." />
    <meta name="keywords" content="Telenordeste Sergipe, Projeto, Projeto Telenordeste, Telenordeste, Telenordeste-se, SUS, Proadi, Hospital Alemão Oswaldo Cruz, Conass, Sergipe, Saúde, TeleInterconsulta, hospital oswaldo cruz telefone, hospital oswaldo cruz agendamento de exames, agendamento de consultas, oswaldo cruz agendamento, convenio hospital oswaldo cruz, oswaldo cruz, sistema para hospital, hospital oswaldo cruz sp, oswaldo cruz cursos, hospital oswaldo cruz agendamento, hospital publico, enfermagem oswaldo cruz, telefone hospital oswaldo cruz, hospital oswaldo cruz sus, agendamento oswaldo cruz, hospital oswaldo cruz atende pelo sus, hospital oswaldo cruz tem convênio próprio, hospital oswaldo cruz telefone agendamento, hospital oswaldo cruz marcação de consultas, hospital oswaldo cruz atende sus, hospital oswaldo cruz brasilia, tecnico de enfermagem oswaldo cruz, haoc hospital alemão oswaldo cruz, instituto alemao oswaldo cruz, proadi sus oswaldo cruz, hospital oswaldo cruz tem convênio próprio, hospital oswaldo cruz telefone agendamento, hospital oswaldo cruz marcação de consultas, hospital oswaldo cruz atende sus, hospital oswaldo cruz brasilia, tecnico de enfermagem oswaldo cruz, haoc hospital alemão oswaldo cruz, instituto alemao oswaldo cruz, proadi sus oswaldo cruz" />
    <!-- METAS DO FACEBOOK COMPARTILHAR -->
    <meta property="og:url" content="{{ url('https://www.telenordeste-se.com.br/') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Projeto Telenordeste" />
    <meta property="og:description" content="Projeto que faz parte do Programa de Apoio ao Desenvolvimento Institucional do Sistema Único de Saúde (PROADI-SUS), executado pelo Hospital Alemão Oswaldo Cruz." />
    <meta property="og:image" content="{{ asset('Client/assets/images/img-compartilhamento.png') }}" />
    <!-- METAS DO TWITTER COMPARTILHAR -->
    <meta name="twitter:card" content="Projeto Telenordeste" />
    <meta name="twitter:site" content="{{ url('https://www.telenordeste-se.com.br/') }}" />
    <meta name="twitter:image" content="{{ asset('Client/assets/images/img-compartilhamento.png') }}" />
    <meta name="twitter:creator" content="WHI - WEB DE ALTA INSPIRAÇÃO" />
    <meta name="twitter:title" content="Projeto Telenordeste" />
    <meta name="twitter:description" content="Projeto que faz parte do Programa de Apoio ao Desenvolvimento Institucional do Sistema Único de Saúde (PROADI-SUS), executado pelo Hospital Alemão Oswaldo Cruz." />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/main.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/fancybox.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/responsivo.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/splide.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/lgpd.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/lgpd-responsivo.css')) }}" />
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
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W29LG6G7');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FDQ871C1KN"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-FDQ871C1KN');
    </script>
    
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W29LG6G7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header id="header" class="header">
        <div class="header__content">
            <div class="hearder__position">
                <div class="header__image">
                    <a href="{{route('home')}}">
                        <img src="{{ asset('Client/assets/images/logo-telenordeste.svg') }}" alt="Telenordeste" title="Telenordeste">
                    </a>
                </div>
                <nav class="header__nav">
                    <ul class="header__list">
                        <li class="header__item"><a href="{{route('home')}}" class="{{ Route::currentRouteName() == 'home' ? 'active' : ''}}">Home</a></li>
                        <li class="header__item"><a href="{{route('especialidades')}}" class="{{ Route::currentRouteName() == 'especialidades' ? 'active' : ''}} {{ Route::currentRouteName() == 'especialidades-category' ? 'active' : ''}}">Especialidades</a></li>
                        <li class="header__item" id="material-de-apoio-click">
                            <a class="{{ Route::currentRouteName() == 'material-de-apoio' ? 'active' : ''}}">Material de apoio</a>
                            <ul class="submenu" id="submenu-material-de-apoio">
                                @if ($protocolo)                    
                                    <li class="submenu__item">
                                        <a href="{{route('material-de-apoio')}}#{{$protocolo->slug}}">{{$protocolo->title}}</a>
                                    </li>
                                @endif
                                @foreach ($materialSections as $materialSection)                                    
                                    <li class="submenu__item">
                                        <a href="{{route('material-de-apoio')}}#{{$materialSection->slug}}">{{$materialSection->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        
                        
                        <li class="header__item"><a href="{{route('mural-de-comunicacao')}}" class="{{ Route::currentRouteName() == 'mural-de-comunicacao' ? 'active' : ''}}">Mural de comunicação</a></li>
                        <li class="header__item"><a href="{{route('savs')}}" class="{{ Route::currentRouteName() == 'savs' ? 'active' : ''}}">SAVs</a></li>
                        <li class="header__item"><a href="{{route('desempenho')}}" class="{{ Route::currentRouteName() == 'desempenho' ? 'active' : ''}}">Desempenho</a></li>
                        <li class="header__item"><a href="{{route('galeria')}}" class="{{ Route::currentRouteName() == 'galeria' ? 'active' : ''}}">Galeria</a></li>
                        <li class="header__item"><a href="{{route('contato')}}" class="{{ Route::currentRouteName() == 'contato' ? 'active' : ''}}">Contatos e Sugestões</a></li>
                    </ul>
                </nav>
                <div class="sandwich">
                    <a class="botao-sidebar" href="#menu_sidebar" data-sidebar="#menu_sidebar">
                        <div class="span">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>        
    </header>
    <div id="menu_sidebar" class="sidebar">
        <div class="logo">
            <a href="{{route('home')}}">
                <img src="{{ asset('Client/assets/images/logo-telenordeste.svg') }}" alt="Telenordeste" title="Telenordeste">
            </a>
        </div>
        <nav>
            <ul class="menu">
                <li class="header__item"><a href="{{route('home')}}" class="{{ Route::currentRouteName() == 'home' ? 'active' : ''}}">Home</a></li>
                <li class="header__item"><a href="{{route('especialidades')}}" class="{{ Route::currentRouteName() == 'especialidades' ? 'active' : ''}}">Especialidades</a></li>
                <li class="header__item" id="material-de-apoio-click">
                    <a class="{{ Route::currentRouteName() == 'material-de-apoio' ? 'active' : ''}} dropdown-toggle" id="material-de-apoio-dropdown">Material de apoio</a>
                    <ul class="submenu" id="submenu-material-de-apoio-mobile">
                        @if ($protocolo)                    
                            <li class="submenu__item">
                                <a href="{{route('material-de-apoio')}}#{{$protocolo->slug}}">{{$protocolo->title}}</a>
                            </li>
                        @endif
                        @foreach ($materialSections as $materialSection)                                    
                            <li class="submenu__item">
                                <a href="{{route('material-de-apoio')}}#{{$materialSection->slug}}">{{$materialSection->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>              
                <li class="header__item"><a href="{{route('mural-de-comunicacao')}}" class="{{ Route::currentRouteName() == 'mural-de-comunicacao' ? 'active' : ''}}">Mural de comunicação</a></li>
                <li class="header__item"><a href="{{route('savs')}}" class="{{ Route::currentRouteName() == 'savs' ? 'active' : ''}}">SAVs</a></li>
                <li class="header__item"><a href="{{route('desempenho')}}" class="{{ Route::currentRouteName() == 'desempenho' ? 'active' : ''}}">Desempenho</a></li>
                <li class="header__item"><a href="{{route('galeria')}}" class="{{ Route::currentRouteName() == 'galeria' ? 'active' : ''}}">Galeria</a></li>
                <li class="header__item"><a href="{{route('contato')}}" class="{{ Route::currentRouteName() == 'contato' ? 'active' : ''}}">Contatos e Sugestões</a></li>
            </ul>
        </nav>
    </div> 
    <!--Button flutuante-->
    <button id="rolagem__top" class="rolagem__top">
        <a href="#header">
            <img src="{{asset('Client/assets/images/top-1.svg')}}" alt="Rolagem Top" title="Rolagem Top" class="top-1">
            <img src="{{asset('Client/assets/images/top-2.svg')}}" alt="Rolagem Top" title="Rolagem Top" class="top-2">            
        </a>
    </button>

    @if (Route::currentRouteName() !== 'home')    
        @php
            if (Route::currentRouteName() == 'especialidades' || Route::currentRouteName() == 'especialidades-category') {
                $contentTitle = [
                    'title' => 'Especialidades',
                ];
            }
            if(Route::currentRouteName() == 'contato'){
                $contentTitle = [
                    'title' => 'Contato',
                ];
            }
            if(Route::currentRouteName() == 'mural-de-comunicacao' || Route::currentRouteName() == 'mural-de-comunicacao-category' ||Route::currentRouteName() == 'mural-de-comunicacao-interna'){
                $contentTitle = [
                    'title' => 'Mural de comunicação',
                ];
            }
            if(Route::currentRouteName() == 'material-de-apoio'){
                $contentTitle = [
                    'title' => 'Material de apoio',
                ];
            }
            if(Route::currentRouteName() == 'savs'){
                $contentTitle = [
                    'title' => "SAV's",
                ];
            }
            if(Route::currentRouteName() == 'galeria'){
                $contentTitle = [
                    'title' => "Galeria",
                ];
            }
            if(Route::currentRouteName() == 'galeria-interna'){
                $contentTitle = [
                    'title' => "Evento",
                ];
            }
            if(Route::currentRouteName() == 'desempenho'){
                $contentTitle = [
                    'title' => "Desempenho",
                ];
            }
            if(Route::currentRouteName() == 'contato'){
                $contentTitle = [
                    'title' => "Contato e sugestões",
                ];
            }
            if(Route::currentRouteName() == 'calendario'){
                $contentTitle = [
                    'title' => "Agenda",
                ];
            }
        @endphp
        @include('Client.models.banner-interno', $contentTitle)
    @endif
    @include('Client.core.lgpd.lgpd')
    <main id="page">
        @yield('content')
    </main>
    @if ($partners->count() < 1)
        <style>
            .footer{
                height: 140px;
            } 
            .footer .footer__logos{
                height: 100%;
            }
        </style>
    @endif
     <section id="footer" class="footer">
        <div class="footer__logos">
            @if ($partners->count())
                <ul class="footer__logos__items owl-carousel">
                    @foreach($partners as $partners)
                        <li>
                            @if ($partners->link)
                                <a href="{{$partners->link}}" target="_blank" class="link-full"></a>
                            @endif
                            <img src="{{asset('storage/' . $partners->path_image)}}" alt="{{$partners->title}}" title="{{$partners->title}}">                        
                        </li>
                    @endforeach
                </ul>
            @endif
            <div id="foo" class="footer__contact">
                <h6 class="footer__contact__title">Contato</h6>
                <div class="footer__contact__items">
                    <ul class="footer__contact__items__left">
                        <li><a href="https://wa.me/5511998208297"><img src="{{asset('Client/assets/images/wpp-footer.svg')}}" alt="Whatsapp" title="Whatsapp"> <b>Whatsapp:</b> 11 99820-8297</a></li> <span class="linha">|</span>
                        <li><a href="mailto:projetotelenordeste@haoc.com.br"><img src="{{asset('Client/assets/images/email-footer.svg')}}" alt="E-mail" title="E-mail"> projetotelenordeste@haoc.com.br</a></li>
                    </ul>
                    <ul class="footer__contact__items__right">
                        <li><a href="https://hospitais.proadi-sus.org.br/" target="_blank"><img src="{{asset('Client/assets/images/proadi-footer.svg')}}" alt="PROADI" title="PROADI"></a></li> 
                        <li><a href="https://www.hospitaloswaldocruz.org.br/" target="_blank"><img src="{{asset('Client/assets/images/haoc.svg')}}" alt="HAOC" title="HAOC"></a></li> 
                        <li><a href="https://www.instagram.com/hospitaisproadisus/" target="_blank"><img src="{{asset('Client/assets/images/insta.svg')}}" class="insta" alt="Instagram" title="Instagram"></a></li> 
                        <li><a href="https://www.linkedin.com/company/hospitais-proadi-sus/" target="_blank"><img src="{{asset('Client/assets/images/linkedin.svg')}}" class="linkedin" alt="LinkedIn" title="LinkedIn"></a></li>
                    </ul>
                    <div class="logo-whi-footer">
                        
                        <div class="image">
                            <a href="https://www.l7design.com.br/" target="_blank" rel="noopener noreferrer">
                                <img src="{{asset('Client/assets/images/l7-design.svg')}}" alt="L7design" title="L7design">
                            </a>
                            <a href="https://whi.dev.br/" target="_blank" rel="noopener noreferrer">
                                <img src="{{asset('Admin/assets/images/whi.png')}}" alt="WHI - Web de alta inspiração" title="WHI - Web de alta inspiração">
                            </a>
                        </div>
                        <div class="copyright">
                            <script>
                                var currentYear = new Date().getFullYear();
                                document.write('<p> © ' + currentYear + ' Projeto Telenordeste. Todos os direitos reservados.</p>');
                            </script>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <script src="{{ asset(mix('Client/assets/js/main.js')) }}"></script>
    <script src="{{ asset(mix('Client/assets/js/jquery.menusidebar.js')) }}"></script>
    <script src="{{ asset(mix('Client/assets/js/fancybox.js')) }}"></script>
    <script src="{{ asset(mix('Client/assets/js/splide.min.js')) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset(mix('Client/assets/js/lgpd.js')) }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdown = document.getElementById('material-de-apoio-dropdown');
            var submenu = document.getElementById('submenu-material-de-apoio-mobile');
            
            dropdown.addEventListener('click', function() {
                if (submenu.style.display === 'block') {
                    submenu.style.display = 'none';
                } else {
                    submenu.style.display = 'block';
                }
            });
        });
    </script>
</body>

</html>
<!-- END -->
