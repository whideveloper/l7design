@extends('Client.core.main')
@section('content')
    <section class="galeria evento">
        <div class="galeria__content">
            <div class="galeria__text">
                <p>Acompanhe a nossa galeria de fotos. Aqui compartilhamos os registros dos nossos eventos, treinamentos, visitas e muito mais!</p>
            </div>

            <div class="galeria__list">
                <div class="galeria__item">
                    <div class="galeria__image">
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
                <div class="galeria__item">
                    <div class="galeria__image">
                        <img src="{{asset('Client/assets/images/galeria-1.jpg')}}" alt="imagem galeria">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection