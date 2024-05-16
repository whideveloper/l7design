@extends('Client.core.main')
@section('content')
    <section class="mural-de-comunicacao-interna">
        <div class="mural-de-comunicacao-interna__content">
            @if ($muralDeComunicacaoRelacionados->count() < 1)
                <style>
                    .mural-de-comunicacao-interna__content article,
                    .mural-de-comunicacao-interna__text p{
                        width: 100%;
                    }
                </style>
            @endif
            <article>
                <h3 class="mural__de__comunicacao__title">{{$muralDeComunicacao->title}}</h3>
                <div class="mural-de-comunicacao-interna__text">
                    <p>
                        {!! $muralDeComunicacao->text !!}
                    </p>
                </div>
                <div class="goback mural">
                    <a href="{{route('mural-de-comunicacao')}}">Voltar</a>
                </div>
            </article>
            @if ($muralDeComunicacaoRelacionados->count() > 0)
                <aside>
                    <h4 class="mural__de__comunicacao__title__aside">Conteúdos relacionados</h4>
                    <div class="mural__de__comunicacao__aside__content owl-carousel">
                        @foreach ($muralDeComunicacaoRelacionados as $relacionados)
                            @php
                                $imagePath = asset('storage/'. $relacionados->path_image);
                                $description = $relacionados->description;
                                $descricao = strip_tags($description);  
                                $data = Carbon\Carbon::parse($relacionados->publish_date)->format('d/m/Y'); 

                                $content = [
                                    'title' => $relacionados->title,
                                    'date' => $data,          
                                    'image' => $imagePath,
                                    'text' => substr(strip_tags($descricao),0,150),
                                    'link' => route('mural-de-comunicacao-interna', [$relacionados->category_slug, $relacionados->mural_slug]),
                                    'btnName' => isset($relacionados->btn_title)?$relacionados->btn_title:'saiba mais',                                    
                                ];
                            @endphp                   
                            @include('Client.models.mdl-box-interna', $content)
                        @endforeach
                        
                    </div>
                </aside>
            @endif
        </div>
    </section>
@endsection