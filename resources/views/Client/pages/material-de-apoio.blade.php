@extends('Client.core.main')
@section('content')
<section class="teleinterconsulta">
    <div class="teleinterconsulta__content">
        <article class="{{ url()->current() == route('material-de-apoio') ? 'material-de-apoio' : ''  }}">
            <div class="teleinterconsulta__image">
                <img src="{{asset('Client/assets/images/rendound-top.svg')}}" alt="redound-top" class="redound-top" title="redound-top">

                <img src="{{asset('Client/assets/images/mt-apoio.jpg')}}" class="hover" alt="Material de apoio" title="Material de apoio">

                <img src="{{asset('Client/assets/images/rendound-bottom.svg')}}" alt="redound-bottom" class="redound-bottom" title="redound-bottom">
            </div>
            <div class="teleinterconsulta__description">
                <h2 class="teleinterconsulta__title">Os protocolos</h2>

                <p class="teleinterconsulta__text">
                    O <strong>Hospital Alemão Oswaldo Cruz</strong> apresenta um conjunto de 24 compilações e elaborações de protocolos clínicos para a Atenção Primária à Saúde (APS).
                    <br><br>
                    Essa entrega é fruto da sinergia entre times do Hospital, que atua no Programa de Apoio ao Desenvolvimento Institucional do Sistema Único de Saúde (PROADI-SUS), conhecido como <strong>TeleNordeste</strong>, voltado para a APS de Sergipe no triênio 2021-2023, a partir de demanda da Secretaria de Atenção Primária à Saúde, do Ministério da Saúde (SAPS/MS) e do Conselho Nacional dos Secretários de Saúde (CONASS), e também do setor de Gestão de Saúde Populacional (GSP) do <strong>Hospital Alemão Oswaldo Cruz</strong>, publicamente conhecido como Saúde Integral.
                    <br><br>
                    Esta produção é formatada para apoio à tomada de decisões no cuidado integral, continuado, coordenado e contextualizado de pessoas afetadas por condições clínicas relevantes.
                    <br><br>
                    Foi construída tendo em vista as necessidades clínicas cotidianas de equipes de APS, especialmente de seus médicos. No caso de municípios que desejem validá-la e assumi-la localmente, também pode ser apoio para enfermeiros, farmacêuticos e demais profissionais autorizados a atuar conforme protocolos.
                </p>

                <div class="teleinterconsulta__btn">
                    <a href="" class="consulta"><img src="{{asset('Client/assets/images/pdf.svg')}}" alt="Agendar Consulta" title="Agendar Consulta"> Download dos protocolos</a>
                </div>
            </div>
        </article>
    </div>
</section>

<section class="material">
    <h2 class="title">Material de leitura</h2>
    <p>Reservamos esse espaço em nosso site para compartilhar com vocês diversos materiais de leitura como artigos, manuais, Portarias e linhas de cuidado. Nosso propósito é estabelecer um ambiente para o compartilhamento de conhecimento.</p>
    
    <div class="material__content">    
        @php
            $content = [
                'title' => 'Nome do documento',
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim tincidunt porttitor...',
                'link' => '/servicos',
                'btnName' => 'Download',
            ];
        @endphp
    
        @for ($i = 0; $i < 9; $i++)
            @include('Client.models.mdl-mt-apoio', $content)
        @endfor
    </div>
</section>
@endsection