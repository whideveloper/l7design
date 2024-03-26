@extends('Client.core.main')
@section('content')
    <section id="image-carousel" class="splide slide" aria-label="Beautiful Images">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <img src="{{asset('Client/assets/images/banner.jpg')}}" alt="">
                    <div class="splide__description">
                        <h2 class="splide__title">Conte com o time Telenordeste</h2>
                    </div>
                </li>
                <li class="splide__slide">
                    <img src="{{asset('Client/assets/images/banner.jpg')}}" alt="">
                </li>
            </ul>
        </div>
    </section>
    <section class="telenordeste">
        <div class="telenordeste__content">
            <article>
                <h1 class="telenordeste__title">O que é o Telenordeste</h1>
    
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <br> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <br> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                
                <div class="telenordeste__btn">
                    <a href="">
                        <img src="" alt="">
                        Entre em contato
                    </a>
                </div>
            </article>
            <aside>
                <h3 class="telenordeste__event__title">Próximos Eventos</h3>
                
                <ul class="telenordeste__content__event">
                    <li class="telenordeste__content__event__list">
                        <a href="" class="link-full"></a>

                        <div class="telenordeste__content__event__date">
                            <span class="telenordeste__content__event__day">15</span>
                            <span class="telenordeste__content__event__month">12</span>
                        </div>
                        <p>Início das atividades de Apoiadores Regionais</p>                        
                    </li>
                </ul>   
                
                <div class="telenordeste__btn agenda">
                    <a href="">
                        <img src="" alt="">
                        Ver agenda completa
                    </a>
                </div>
            </aside>
        </div>
    </section>
    <section>

        @php
            $content = [
                'title' => 'porque confiar na',
                'highlight' => 'whi',
                'image' => asset('Client/assets/images/cat-sqr.jpg'),
                'text' => 'Confie na gente para transformar sua marca em uma experiência digital incrível. Nossa agência une criatividade, tecnologia e compromisso para construir sua presença online de forma inovadora e impactante.',
            ];
        @endphp

        @for ($i = 0; $i < 3; $i++)
            @include('Client.models.mdl-article', $content)
        @endfor

    </section>
@endsection
