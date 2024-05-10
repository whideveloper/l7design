@extends('Client.core.main')
@section('content')
    <section class="especialidades"> 
        <div class="especialidades__content">
            <h3 class="especialidades__title">{{$sessaoEspecialidade->title}}</h3>
            <div class="especialidades__text">
                <p>
                    {!!$sessaoEspecialidade->text!!}
                </p>
            </div>
            
            <div class="especialidades__categories">
                <ul class="especialidades__categories__list">
                    @foreach ($categorias as $category)
                        <li class="especialidades__categories__item"><a href="">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>
            @foreach ($especialistas as $especialista)    
                @php
                    $content = [
                        'title' => $especialista->name,
                        'date' => '',
                        'funcao' => $especialista->function,
                        'crm' => 'CRM:'. $especialista->crm,            
                        'image' => asset('storage/'. $especialista->path_image),
                        'text' => $especialista->description,
                        'btnName' => 'Ver perfil completo',
                    ];
                @endphp
                @include('Client.models.mdl-box', $content)
                
                <!-- The Modal -->
                <div id="modal-especialidade-{{$especialista->id}}" class="modal-especialidade">
                    <div class="modal-content">
                        <div class="modal-content-box">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <article class="modal-box">
                                <div class="modal-box__content">
                                    <div class="modal-box__image">
                                        <img src="{{asset('storage/' . $especialista->path_image)}}" alt="{{$especialista->name}}" title="{{$especialista->name}}" class="modal-box__left">
                                    </div>
                                    <div class="modal-box__description">
                                        <div class="modal-box__right">
                                            <h3 class="modal-box__title">{{$especialista->name}}</h3>
                                            <span class="modal-box__function">{{$especialista->function}}</span>
                                            <span class="modal-box__crm">CRM: {{$especialista->crm}}</span>
                                            <span class="modal-box__text">{!!$especialista->description!!}</span>
                                            <div class="modal-box__text__long">
                                                {!! $especialista->text !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </section>

    <section class="tutorial">
        <div class="tutorial__content">
            <div class="tutorial__content__left">
                <h3 class="tutorial__title">Tutoriais</h3>
                <div class="tutorial__text">
                    <p>
                        O tutorial para uso da plataforma virtual do <strong>TeleNordeste</strong> é um documento simples e intuitivo, que apoiará você em caso de dúvidas para realizar o cadastro de pacientes, agendamentos, acessar consultas, prontuários, relatórios, receitas e <strong>teleconsultorias assíncronas</strong>, entre outras funcionalidades.
                        <br><br>
                        Clique no botão abaixo para acessar o documento e, em caso de dúvidas, entre em contato conosco.
                    </p>
                </div>
                <div class="btn__tutorial">                    
                    <a href="" class="turoriaL_more"><img src="{{asset('Client/assets/images/pdf.svg')}}" alt="Ícone de pdf"> Download do tutorial</a>
                </div>
            </div>
            <div class="tutorial__content__right">
                <h3 class="tutorial__title right">Treinamento para uso da plataforma de teleatendimento:</h3>
                <div class="tutorial__text right">
                    <p>
                        Em caso de dúvidas, erros ou sugestões na plataforma, nos <strong>contate!</strong>
                    </p>
                </div>
                <ul class="tutorial__list">
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                    <li class="tutorial__item">
                        <a href="http://" class="tutorial__item_link">Botão Link Vídeo ou PDF</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="agendamento">
        <div class="agendamento__content">
            <div class="agendamento__text">
                <p>
                    O <strong>agendamento das teleinterconsultas</strong> pode ser feito através do botão ao lado.
                    <br><br>    
                    Consulte a disponibilidade das <strong>teleinterconsultas</strong> conforme a escala dos dias de atendimentos das especialidades, disponível nas abas específicas de cada especialidade.
                </p>
            </div>
            <div class="btn__agendamento">
                <div class="teleinterconsulta__btn">
                    <a href="" class="consulta"><img src="{{asset('Client/assets/images/cursor.svg')}}" alt="Agendar Consulta" title="Agendar Consulta"> Agende sua consulta</a>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Função para abrir o modal
    function openModal() {
    document.getElementById("modal-especialidade-{{$especialista->id}}").style.display = "block";
    document.body.classList.add("modal-open"); // Adiciona a classe para impedir a rolagem da página
    }

    // Função para fechar o modal
    function closeModal() {
    document.getElementById("modal-especialidade-{{$especialista->id}}").style.display = "none";
    document.body.classList.remove("modal-open"); // Remove a classe para permitir a rolagem da página
    }

    </script>
@endsection