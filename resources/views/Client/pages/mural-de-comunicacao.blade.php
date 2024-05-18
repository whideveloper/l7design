@extends('Client.core.main')
@section('content')
@if ($categorias->count() > 0 || $sessaoMuralDeComunicacao || $muralDeComunicacoes->count())
    <section class="especialidades"> 
        <div class="especialidades__content">
            @if ($sessaoMuralDeComunicacao)
                <div class="especialidades__text">
                    <p>
                        {!! $sessaoMuralDeComunicacao->text !!}
                    </p>
                </div>
            @endif
            
            @if ($categorias->count() > 0)
                <div class="especialidades__categories">
                    <ul class="especialidades__categories__list {{ url()->current() == route('mural-de-comunicacao') ? 'mural-de-comunicacao' : ''  }}">
                        @foreach ($categorias as $category)
                            <li class="especialidades__categories__item {{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{route('mural-de-comunicacao-category', [$category->slug])}}">{{$category->title}}</a></li>
                        @endforeach
                        @if (Route::currentRouteName() ==  'mural-de-comunicacao-category')                        
                            <li class="especialidades__categories__item bt-all">
                                <a href="{{route('mural-de-comunicacao')}}">Ver todos</a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            
            @if ($muralDeComunicacoes->count() > 0)
                <div class="content-body">
                    @foreach ($muralDeComunicacoes as $mural)
                        @php
                            $imagePath = asset('storage/'. $mural->path_image);
                            $description = $mural->description;
                            $descricao = strip_tags($description);  
                            $data = Carbon\Carbon::parse($mural->publish_date)->format('d/m/Y');                

                            $content = [
                                'id' => $mural->id,
                                'title' => $mural->title,
                                'date' => $data,         
                                'image' => $imagePath,
                                'text' => substr(strip_tags($descricao),0,150),
                                'link' => isset($mural->link)?$mural->link:route('mural-de-comunicacao-interna', [$mural->category_slug, $mural->mural_slug]),
                                'btnName' => isset($mural->btn_title)?$mural->btn_title:'saiba mais',
                            ];
                        @endphp    
                        @include('Client.models.mdl-box-interna', $content)
                    @endforeach
                </div>
                {{-- PAGINATION --}}
                <div class="pagi">
                    {{$muralDeComunicacoes->links()}}
                </div>
            @endif
        </div>
    </section>
@endif
@endsection


