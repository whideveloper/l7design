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
            </div>
        </div>
    </section>
@endsection