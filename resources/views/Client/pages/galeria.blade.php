@extends('Client.core.main')
@section('content')
    <section class="galeria">
        <div class="galeria__content">
            <div class="galeria__text text">
                <p>Acompanhe a nossa galeria de fotos. Aqui compartilhamos os registros dos nossos eventos, treinamentos, visitas e muito mais!</p>
            </div>

            <div class="galeria__list">
                @foreach ($galleries as $gallery)
                    <div class="galeria__item">
                        <a href="{{route('galeria-interna', ['gallery' => $gallery->slug])}}" class="link-full"></a>
                        <h2 class="galeria__title">{{$gallery->title}}</h2>
                        <div class="description">
                            <div class="galeria__image">
                                <img src="{{asset('storage/'. $gallery->path_image)}}" alt="imagem galeria">
                            </div>
                            <div class="galeria__text">
                                <p>{!! substr(strip_tags($gallery->description), 0, 180) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- PAGINATION --}}
            <div class="pagi">
                {{$galleries->links()}}
            </div>
        </div>
    </section>
@endsection