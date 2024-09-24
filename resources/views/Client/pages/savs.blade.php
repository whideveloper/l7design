@extends('Client.core.main')
@section('content')
@if ($sav)
    <section class="teleinterconsulta">
        <div class="teleinterconsulta__content savs">
            <article class="{{ url()->current() == route('savs') ? 'savs' : ''  }}">
                @if ($sav->path_image)
                    <div class="teleinterconsulta__image">
                        <img src="{{asset('Client/assets/images/rendound-top.svg')}}" alt="redound-top" class="redound-top" title="redound-top">

                        <img src="{{asset('storage/'. $sav->path_image)}}" class="img-sav hover" alt="Sav" title="Sav">

                        <img src="{{asset('Client/assets/images/rendound-bottom.svg')}}" alt="redound-bottom" class="redound-bottom" title="redound-bottom">
                    </div>
                    @else
                    <style>
                        .teleinterconsulta__content.savs .savs .teleinterconsulta__description{
                            width: 100%;
                        }
                    </style>
                @endif
                <div class="teleinterconsulta__description">
                    <h2 class="teleinterconsulta__title">{{$sav->title}}</h2>

                    <p class="teleinterconsulta__text">
                        {!! $sav->text !!}
                    </p>

                    <div class="row">
                        @if ($savGravadas->count() > 0)
                            <div class="teleinterconsulta__btn sav-gravada">
                                <a href="#savs__gravadas" class="consulta"><img src="{{asset('Client/assets/images/savs-gravadas.svg')}}" alt="Sav's gravadas" title="Sav's gravadas"> Assista as SAVs gravadas</a>
                            </div>
                        @endif
                        <div class="teleinterconsulta__btn proxima-sav">
                            <a href="{{route('calendario')}}" class="consulta"><img src="{{asset('Client/assets/images/agenda.svg')}}" alt="Próximas Sav's" title="Próximas Sav's">Próximas SAVs</a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endif
@if ($savGravadas->count() > 0)
    <section id="savs__gravadas" class="savs__gravadas">
        <div class="savs__gravadas__content">
            <h2 class="savs__gravadas__title">SAVs gravadas</h2>
            <p class="savs__gravadas__text">Selecione a SAV (sessão de aprendizagem virtual) desejada e clique no link para acessar a gravação. Será necessário o preenchimento de um breve formulário para acessar a aula.</p>
            
            <div class="savs__gravadas__list">
                @foreach ($savGravadas as $savGravada)
                    <div class="savs__gravadas__item">
                        <a id="myModal-{{$savGravada->id}}" class="link-full click-lead" data-id="{{$savGravada->id}}" data-title="{{$savGravada->title}}" data-link="{{$savGravada->link}}"></a>
                        @if ($savGravada->path_image)
                            <img src="{{asset('storage/'. $savGravada->path_image)}}" class="savs__gravadas__capa" alt="Imagem de capa">
                        @endif
                        <div class="image__play">
                            <img src="{{asset('Client/assets/images/play.svg')}}" class="savs__gravadas__play" alt="Imagem de play">
                        </div>
                        <iframe width="100%" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>      
                    
                    <div id="myModal-{{$savGravada->id}}-modal" class="modal">
                        <div class="modal-content">
                            <div class="modal-content-form">
                                <h6 class="modal-title">Para assistir digite seu nome completo e e-mail:</h6>
                                <form action="{{route('admin.dashboard.lead.leadSave')}}" method="post">   
                                    @csrf 
                                    <input type="hidden" name="link" class="modal-link" value="{{$savGravada->link}}">
                                    <input type="hidden" name="video_id" class="modal-video_id" value="{{$savGravada->id}}">
                                    <input type="hidden" name="video_title" class="modal-video_title" value="{{$savGravada->title}}">  
                                    <input type="hidden" id="dataHoraAutomatica" name="dataHora">             
                                    <input type="text" name="name" required placeholder="Nome completo">                     
                                    <input type="text" name="email" required placeholder="E-mail">
                                    <input type="hidden" id="localidade" name="localidade">
                                    <input type="text" name="locality" id="locality" required placeholder="Cidade/Município">
                                    <div class="modal-content-btn">
                                        <button type="submit" class="button"><span>Assistir</span></button>
                                        <button type="button" class="close-btn"><span>Sair</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- PAGINATION --}}
                <div class="pagi">
                    {{$savGravadas->links()}}
                </div>
                
                <!-- Elemento para mostrar o indicador de carregamento -->
                {{-- <div id="carregamento-savs" style="display: none;"><img src="{{asset('Client/assets/images/loading.svg')}}" alt=""></div> --}}
                
            </div>
            <div class="row">
                <div class="teleinterconsulta__btn proxima-sav">
                    <a href="{{route('calendario')}}" class="consulta"><img src="{{asset('Client/assets/images/agenda.svg')}}" alt="Próximas Sav's" title="Próximas Sav's">Próximas SAVs</a>
                </div>
            </div>
        </div>
    </section>
@endif

<script>
    // Função para obter a localização do usuário - API de geolocalização por IP
    function getLocation() {
        return fetch('https://ipapi.co/json/')
            .then(response => response.json())
            .then(data => {
                return {
                    city: '',
                    region: data.region,
                    country: data.country
                };
            })
            .catch(error => {
                console.error('Erro ao obter localização:', error);
                return {
                    city: '',
                    region: '',
                    country: ''
                };
            });
    }
    // Função para obter a data e hora atuais no formato 'YYYY-MM-DD HH:MM:SS'
    function getCurrentDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Janeiro é 0!
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    // Função para configurar os campos do modal
    function setModalFields(modal, location) {
        const form = modal.querySelector('form');
        form.querySelector('#localidade').value = `${location.city}, ${location.region}, ${location.country}`;
        form.querySelector('#locality').value = location.city;
        form.querySelector('#dataHoraAutomatica').value = getCurrentDateTime();
        
    }

    // Adicionar eventos de clique para cada link do modal
    document.querySelectorAll('.link-full').forEach(link => {
        link.addEventListener('click', function() {
            const modalId = `#myModal-${this.dataset.id}-modal`;
            const modal = document.querySelector(modalId);
            
            getLocation().then(location => {
                setModalFields(modal, location);
            });

            // Mostrar o modal
            modal.style.display = 'block';
        });
    });

    // Adicionar evento de clique para os botões de fechar do modal
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.modal').style.display = 'none';
        });
    });
</script>


<script>
    // Obtenha todos os links que abrem o modal
    const modalLinks = document.querySelectorAll('.click-lead');

    // Para cada link, adicione um evento de clique
    modalLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evita o comportamento padrão do link
            const modalId = this.getAttribute('id'); // Obtenha o ID do modal a partir do atributo ID do link
            const modal = document.getElementById(modalId + '-modal'); // Obtenha o modal com base no ID

            // Verifique se o modal foi encontrado
            if (modal) {
                modal.style.display = "block"; // Exiba o modal
                document.body.style.overflow = "hidden"; // Desative a rolagem da página principal
            }
        });
    });

    // Função para fechar o modal e limpar os campos do formulário
    function closeModal(modal) {
        modal.style.display = "none"; // Oculte o modal
        document.body.style.overflow = "auto"; // Reative a rolagem da página principal
        const form = modal.querySelector('form'); // Obtenha o formulário dentro do modal
        if (form) {
            form.reset(); // Limpe os campos do formulário
        }
    }

    // Obtenha todos os botões de fechar o modal
    const closeButtons = document.querySelectorAll('.close-btn');

    // Para cada botão de fechar, adicione um evento de clique
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal'); // Obtenha o modal pai do botão de fechar
            if (modal) {
                closeModal(modal); // Feche o modal e limpe os campos do formulário
            }
        });
    });

    // Feche o modal quando clicar fora dele
    window.addEventListener("click", function(event) {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target); // Feche o modal clicado e limpe os campos do formulário
        }
    });

</script>

@endsection
