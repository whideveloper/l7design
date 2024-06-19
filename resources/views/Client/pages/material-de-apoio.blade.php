@extends('Client.core.main')
@section('content')
@if (!$protocolo)
    <style>
        .material{
            margin-top: -190px;
        }
        .material:nth-of-type(odd){
            margin-top: 0;
        }
    </style>
@endif
@if ($protocolo)
    <section id="{{$protocolo->slug}}" class="teleinterconsulta">
        <div class="teleinterconsulta__content {{ url()->current() == route('material-de-apoio') ? 'material-de-apoio' : ''  }}">
            <article class="{{ url()->current() == route('material-de-apoio') ? 'material-de-apoio' : ''  }}">
                @if ($protocolo->path_image)
                    <div class="teleinterconsulta__image mat">
                        <img src="{{asset('Client/assets/images/rendound-top.svg')}}" alt="redound-top" class="redound-top" title="redound-top">

                        <img src="{{asset('storage/'. $protocolo->path_image)}}" class="hover" alt="Material de apoio" title="Material de apoio">

                        <img src="{{asset('Client/assets/images/rendound-bottom.svg')}}" alt="redound-bottom" class="redound-bottom" title="redound-bottom">
                    </div>                    
                @endif
                @if(!$protocolo->path_image)
                    <style>
                        .teleinterconsulta__description{
                            width: 100%;
                        }
                    </style>
                @endif
                <div class="teleinterconsulta__description">
                    <h2 class="teleinterconsulta__title">{{$protocolo->title}}</h2>

                    <p class="teleinterconsulta__text">
                        {!! $protocolo->text !!}
                    </p>

                    @if ($protocolo->path_file)
                        <div class="teleinterconsulta__btn">
                            <a href="{{asset('storage/'. $protocolo->path_file)}}" target="_blank" class="consulta"><img src="{{asset('Client/assets/images/pdf.svg')}}" alt="Protocolos" title="Protocolos"> {{$protocolo->btn_title}}</a>
                        </div>
                    @endif
                </div>
            </article>
        </div>
    </section>
@endif

@foreach ($materialSections as $materialSection)
    @php
        // Obtém a página atual da seção, se existir
        $currentPage = request()->input('page_' . $materialSection->id, 1);

        // Carrega os documentos paginados para a seção atual
        $documents = \App\Models\MaterialDocument::where('material_id', $materialSection->id)
                    ->active()
                    ->orderBy('sorting', 'ASC')
                    ->paginate(6, ['*'], 'page_' . $materialSection->id, $currentPage);
    @endphp
    
    <section id="{{ $materialSection->slug }}" class="material">
        
        <div class="material__content">    
            <h2 class="title">{{ $materialSection->title }}</h2>
            <div class="description">
                {!! $materialSection->text !!}
            </div>
            <div class="material__content__list owl-carousel">
                @foreach ($documents as $document)
                    @php
                        $content = [
                            'title' => $document->title,
                            'text' => $document->description,
                            'link' => asset('storage/'.$document->path_file),
                            'btnName' => 'Download',
                        ];
                    @endphp
                    @include('Client.models.mdl-mt-apoio', $content)
                @endforeach
                {{-- PAGINATION --}}
            </div>
            <div class="pagi">
                {{ $documents->appends(['page_' . $materialSection->id => $documents->currentPage()])->fragment($materialSection->slug)->links() }}
            </div>
        </div>
    </section>
@endforeach



@endsection