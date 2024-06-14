@extends('Client.core.main')
@section('content')
    <section class="galeria evento">
        <div class="galeria__content">
            <div class="galeria__text">
                {!! $galleryImages->text !!}
            </div>

            @if ($galleryImages->galleryImage)
                <div class="galeria__list">
                    @foreach ($galleryImages->galleryImage as $img)
                        <div class="galeria__item">
                            <div class="galeria__image interna">
                                <a href="{{asset('storage/'. $img->path_image)}}" data-fancybox="gallery" class="link-full"></a>
                                <img src="{{asset('storage/'. $img->path_image)}}" alt="imagem galeria">
                            </div>
                        </div>
                    @endforeach                        
                </div>
            @endif
        </div>
    </section>
@endsection