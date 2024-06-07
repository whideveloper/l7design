@extends('Client.core.main')
@section('content')
<!-- Folha de estilos do Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<section class="desempenho"> 
    <div class="desempenho__content">
        <h3 class="desempenho__title">Números gerais do TeleNordeste em 2024</h3>
        <div class="desempenho__text">
            <p>
                Abaixo encontra-se a relação dos principais indicadores do Projeto TeleNordeste em 2024.
                <br><br>
                Explore o painel do TeleNordeste e verifique os números, atualizados mensalmente.            
            </p>
        </div>

        <div class="desempenho__grafico">
            <img src="{{asset('Client/assets/images/desempenho.jpg')}}" alt="Desempenho">
            {{-- <iframe width="1920" height="1080" 
            src=https://lookerstudio.google.com/embed/reporting/bd0121d7-cb44-4ad5-9574-0b1b02e086dc/page/rTWzD 
            frameborder="0" 
            style="border:0" 
            allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
            </iframe> --}}
        </div>
    </div>
</section>
<section id="mapa__atuacao" class="mapa__atuacao">
    <div class="mapa__atuacao__content">
        <h3 class="mapa__atuacao__title">Mapa de Atuação</h3>

        <div id="map" style="width: 100%; height: 600px;z-index:0;"></div>
        <script>
            // Cria um mapa Leaflet com centro na Bahia
            var map = L.map('map').setView([-23.5489, -46.6388], 6);
        
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
         
        <!-- Biblioteca do Leaflet -->
        {{-- <div class="image">
            <img src="{{asset('Client/assets/images/map.png')}}" alt="">
        </div>--}}

        <div class="mapa__atuacao__text">
            <p>O <strong>TeleNordeste</strong> está presente em 70 municípios de Sergipe, distribuídos em sete Regiões de Saúde: Itabaiana, Propriá, Lagarto, Aracaju, Estância, Nossa Senhora da Glória e Nossa Senhora do Socorro. Todos os municípios destacados neste mapa assinaram o termo de adesão ao TeleNordeste.</p>
        </div> 
    </div>
</section>
<section class="quadro__geral">
    <div class="quadro__geral__content">
        <h3 class="quadro__geral__title">Quadro geral por UBS</h3>

        <div class="quadro__geral__table">
            <table>
                <thead>
                    <tr>                        
                        <th>UBS</th>
                        <th>CNES</th>
                        <th>Cardiologia</th>
                        <th>Endrocrinologista</th>
                        <th>Psiquiatria</th>
                        <th>Total</th>
                        <th>Região</th>
                    </tr>
                </thead>

                <tbody>                    
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                    <tr>
                        <td>Titulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                        <td>SubTitulo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection