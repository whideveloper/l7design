@extends('Client.core.main')
@section('content')
<section class="especialidades"> 
    <div class="especialidades__content">
        <h3 class="especialidades__title">Especialidades</h3>
        <div class="especialidades__text">
            <p>
                O projeto TeleNordeste conta com um time de especialistas para apoiá-los com as teleinterconsultas e teleconsultorias. Abaixo você pode conhecê-lo um pouco mais:
            </p>
        </div>
        
        <div class="especialidades__categories">
            <ul class="especialidades__categories__list">
                <li class="especialidades__categories__item"><a href="">Cardiologia</a></li>
                <li class="especialidades__categories__item"><a href="">Endocrinologia</a></li>
                <li class="especialidades__categories__item"><a href="">Psiquiatria adulto</a></li>
                <li class="especialidades__categories__item"><a href="">Psiquiatria infantil</a></li>
                <li class="especialidades__categories__item"><a href="">Neurologia adulto</a></li>
                <li class="especialidades__categories__item"><a href="">Neurologia pediátrica</a></li>
                <li class="especialidades__categories__item"><a href="">Fisiatria</a></li>
                <li class="especialidades__categories__item"><a href="">Médico de Família e Comunidade</a></li>
                <li class="especialidades__categories__item"><a href="">Nutricionista</a></li>
                <li class="especialidades__categories__item"><a href="">Enfermagem</a></li>
            </ul>
        </div>
        @php
            $content = [
                'title' => 'Lucas Deporon Toldo',
                'date' => '',
                'funcao' => 'Cardiologista',
                'crm' => 'CRM: 0000000',            
                'image' => asset('Client/assets/images/doctor-image.png'),
                'text' => 'Sexta-feira das 9h00 às 11h00 A partir de 18 anos',
                'link' => '/servicos',
                'btnName' => 'Ver perfil completo',
            ];
        @endphp
    
        @for ($i = 0; $i < 9; $i++)
            @include('Client.models.mdl-box', $content)
        @endfor
    </div>
</section>
@endsection