@extends('Client.core.main')
@section('content')
<!-- Folha de estilos do Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<section class="desempenho"> 
    <div class="desempenho__content">
        @if(isset($sectionTitlePerformance) && $sectionTitlePerformance->title !== null || isset($sectionTitlePerformance) && $sectionTitlePerformance->description !== null)
            <h3 class="desempenho__title">{{isset($sectionTitlePerformance) && $sectionTitlePerformance->title !== null ? $sectionTitlePerformance->title : ''}}</h3>
            <div class="desempenho__text">
                {!!isset($sectionTitlePerformance) && $sectionTitlePerformance->description !== null ? $sectionTitlePerformance->description : ''!!}
            </div>
        @endif

        <div class="desempenho__grafico">
            {{-- <img src="{{asset('Client/assets/images/desempenho.jpg')}}" alt="Desempenho"> --}}
            <iframe width="100%" height="1360" 
            src=https://lookerstudio.google.com/embed/reporting/bd0121d7-cb44-4ad5-9574-0b1b02e086dc/page/rTWzD 
            frameborder="0" 
            style="border:0" 
            allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
            </iframe>
        </div>
    </div>
</section>
<section id="mapa__atuacao" class="mapa__atuacao">
    <div class="mapa__atuacao__content">
        <h3 class="mapa__atuacao__title">Mapa de Atuação</h3>

        <div id="map" style="width: 100%; height: 600px;z-index:0;"></div>
        <script>

            var map = L.map('map').setView([-10.5717, -37.3414], 8);

            // Adiciona um mapa de fundo
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        
            // Array de pings com coordenadas [latitude, longitude], título e descrição associados
            var pings = [
                @foreach ($maps as $map)
                    { 
                        coords: [{!! $map->latitude !!}, {!! $map->longitude !!}], 
                        title: "{!! $map->title !!}", 
                        description: "{!! $map->text !!}" 
                    },
                @endforeach
                // Adicione mais pings conforme necessário
            ];
        
            // Loop através dos pings e adiciona marcadores ao mapa
            for (var i = 0; i < pings.length; i++) {
                var ping = pings[i];
                var marker = L.marker(ping.coords).addTo(map);
                var popupContent = "<b>" + ping.title + "</b><br>" + ping.description;
                marker.bindPopup(popupContent);
            }
        </script>

        <div class="mapa__atuacao__text">
            <p>O <strong>TeleNordeste</strong> está presente em mais de 70 municípios de Sergipe, distribuídos em sete Regiões de Saúde: Itabaiana, Propriá, Lagarto, Aracaju, Estância, Nossa Senhora da Glória e Nossa Senhora do Socorro. Todos os municípios destacados neste mapa assinaram o termo de adesão ao TeleNordeste.</p>
        </div> 
    </div>
</section>
@if ($dataGraphs->count() > 0)
    <section class="quadro__geral">
        <div class="quadro__geral__content">
            <h3 class="quadro__geral__title">Quadro geral por UBS</h3>
            <div class="quadro__geral__table">
                <table>
                    <thead class="header-thead">
                        <tr class="header-table">                        
                            <th>CNES</th>
                            <th style="width:300px">Unidade Saúde</th>
                            <th>Município</th>
                            <th>Região de Saúde</th>
                            <th>Cardiologia</th>
                            <th>Endocrinologia e Metabologia</th>
                            <th>Enfermagem</th>
                            <th>Medicina de Família e Comunidade</th>
                            <th>Fisiatria</th>
                            <th>Neurologia</th>
                            <th>Neuropediatria</th>
                            <th>Nutricionista</th>
                            <th>Psiquiatria</th>
                            <th>Psiquiatria da Infância e Adolescência</th>
                            <th>Urologia</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dataGraphs as $dataGraph)
                            <tr>
                                <td>{{$dataGraph->cnes}}</td>
                                <td>{{$dataGraph->health_unit}}</td>
                                <td>{{$dataGraph->county}}</td>
                                <td>{{$dataGraph->health_region}}</td>
                                <td>{{$dataGraph->cardiology}}</td>
                                <td>{{$dataGraph->endocrinology_and_metabology}}</td>
                                <td>{{$dataGraph->nursing}}</td>
                                <td>{{$dataGraph->family_and_community_medicine}}</td>
                                <td>{{$dataGraph->physiatry}}</td>
                                <td>{{$dataGraph->neurology}}</td>
                                <td>{{$dataGraph->neuropediatrics}}</td>
                                <td>{{$dataGraph->nutritionist}}</td>
                                <td>{{$dataGraph->psychiatry}}</td>
                                <td>{{$dataGraph->child_and_adolescent_psychiatry}}</td>
                                <td>{{$dataGraph->urology}}</td>
                            </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endif
@endsection