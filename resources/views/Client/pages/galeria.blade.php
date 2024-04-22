@extends('Client.core.main')
@section('content')
    <section class="galeria">
        <div class="galeria__content">
            <div class="galeria__text">
                <p>Acompanhe a nossa galeria de fotos. Aqui compartilhamos os registros dos nossos eventos, treinamentos, visitas e muito mais!</p>
            </div>

            <div class="galeria__list">
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="galeria__item">
                    <a href="{{route('galeria-interna')}}" class="link-full"></a>
                    <h2 class="galeria__title">Evento</h2>
                    <div class="description">
                        <div class="galeria__image">
                            <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                        </div>
                        <div class="galeria__text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et ex vel ligula aliquam pharetra. Morbi id quam eget elit convallis sodales. Mauris imperdiet erat id velit porttitor pretium.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection