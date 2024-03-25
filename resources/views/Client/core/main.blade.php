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

</head>

<body>

    <main id="page">
        @yield('content')
    </main>

    <script src="{{ asset(mix('Client/assets/js/main.js')) }}"></script>
    <script src="{{ asset(mix('Client/assets/js/splide.min.js')) }}"></script>
</body>

</html>
<!-- END -->
