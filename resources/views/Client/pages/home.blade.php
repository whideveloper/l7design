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
