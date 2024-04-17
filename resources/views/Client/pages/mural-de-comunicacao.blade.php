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
            $content = [
                'title' => 'Título lorem ipsum dolorem consectum vertun quantus',
                'date' => '21/02/2024',
                'funcao' => '',
                'crm' => '',            
                'image' => asset('Client/assets/images/com-1.jpg'),
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim tincidunt porttitor...',
                'link' => '/servicos',
                'btnName' => 'saiba mais',
            ];
        @endphp
    
        @for ($i = 0; $i < 9; $i++)
            @include('Client.models.mdl-box', $content)
        @endfor
    </div>
</section>
@endsection