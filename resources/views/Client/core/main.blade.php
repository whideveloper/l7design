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
    <link rel="stylesheet" href="{{ asset(mix('Client/assets/css/splide.min.css')) }}" />
    <!--fonts google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    

</head>

<body>
    <header class="header">
        <div class="header__content">
            <div class="hearder__position">
                <div class="header__image">
                    <a href="">
                        <img src="{{ asset('Client/assets/images/logo-telenordeste.svg') }}" alt="Telenordeste" title="Telenordeste">
                    </a>
                </div>
                <nav class="header__nav">
                    <ul class="header__list">
                        <li class="header__item"><a href="" class="active">Home</a></li>
                        <li class="header__item"><a href="">Especialidades</a></li>
                        <li class="header__item"><a href="">Material de apoio</a></li>
                        <li class="header__item"><a href="">Mural de comunicação</a></li>
                        <li class="header__item"><a href="">SAVs</a></li>
                        <li class="header__item"><a href="">Desempenho</a></li>
                        <li class="header__item"><a href="">Galeria</a></li>
                        <li class="header__item"><a href="">Contatos e Sugestões</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main id="page">
        @yield('content')
    </main>

    <script src="{{ asset(mix('Client/assets/js/main.js')) }}"></script>
    <script src="{{ asset(mix('Client/assets/js/splide.min.js')) }}"></script>
</body>

</html>
<!-- END -->
