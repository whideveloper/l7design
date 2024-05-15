@extends('Client.core.main')
@section('content')
<!-- Folha de estilos do Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<section class="desempenho"> 
    <div class="desempenho__content">
        <h3 class="desempenho__title">Especialidades</h3>
        <div class="desempenho__text">
            <p>
                O projeto TeleNordeste conta com um time de especialistas para apoiá-los com as teleinterconsultas e teleconsultorias. Abaixo você pode conhecê-lo um pouco mais:
            </p>
        </div>

        <div class="desempenho__grafico">
            <img src="{{asset('Client/assets/images/desempenho.jpg')}}" alt="Desempenho">
        </div>
    </div>
</section>
<section class="mapa__atuacao">
    <div class="mapa__atuacao__content">
        <h3 class="mapa__atuacao__title">Mapa de Atuação</h3>

        <div id="map" style="width: 100%; height: 600px;z-index:0;"></div>

        <script>
            // Cria um mapa Leaflet com centro na Bahia
            var map = L.map('map').setView([-12.9714, -38.5014], 4);
        
            // Adiciona um mapa de fundo
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        
            // Array de pings com coordenadas [latitude, longitude] e pop-ups associados
            var pings = [
                { coords: [-12.9714, -38.5014], popup: "Salvador" },
                { coords: [-13.0068, -38.5267], popup: "Lauro de Freitas" },
                { coords: [-12.7777, -38.5014], popup: "Camaçari" }
                // Adicione mais pings conforme necessário
            ];
        
            // Loop através dos pings e adiciona marcadores ao mapa
            for (var i = 0; i < pings.length; i++) {
                var ping = pings[i];
                L.marker(ping.coords).addTo(map).bindPopup(ping.popup);
            }
        </script>
        
        <!-- Biblioteca do Leaflet -->
        {{-- <div class="image">
            <img src="{{asset('Client/assets/images/map.png')}}" alt="">
        </div>--}}

        {{-- <div class="mapa__atuacao__text">
            <p>O <strong>TeleNordeste</strong> está presente em 70 municípios de Sergipe, distribuídos em sete Regiões de Saúde: Itabaiana, Propriá, Lagarto, Aracaju, Estância, Nossa Senhora da Glória e Nossa Senhora do Socorro. Todos os municípios destacados neste mapa assinaram o termo de adesão ao TeleNordeste.</p>
        </div>  --}}
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