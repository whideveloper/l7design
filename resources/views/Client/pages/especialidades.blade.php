@extends('Client.core.main')
@section('content')
    <section class="especialidades"> 
        <div class="especialidades__content">
            <h3 class="especialidades__title">Especialidades</h3>
            <div class="especialidades__text">
                <p>
                    O projeto TeleNordeste conta com um time de especialistas para apoiá-los com as teleinterconsultas e teleconsultorias. Abaixo você pode conhecê-lo um pouco mais:
                </p>
            </div>
            
            <div class="especialidades__categories">
                <ul class="especialidades__categories__list">
                    <li class="especialidades__categories__item"><a href="">Cardiologia</a></li>
                    <li class="especialidades__categories__item"><a href="">Endocrinologia</a></li>
                    <li class="especialidades__categories__item"><a href="">Psiquiatria adulto</a></li>
                    <li class="especialidades__categories__item"><a href="">Psiquiatria infantil</a></li>
                    <li class="especialidades__categories__item"><a href="">Neurologia adulto</a></li>
                    <li class="especialidades__categories__item"><a href="">Neurologia pediátrica</a></li>
                    <li class="especialidades__categories__item"><a href="">Fisiatria</a></li>
                    <li class="especialidades__categories__item"><a href="">Médico de Família e Comunidade</a></li>
                    <li class="especialidades__categories__item"><a href="">Nutricionista</a></li>
                    <li class="especialidades__categories__item"><a href="">Enfermagem</a></li>
                </ul>
            </div>
            @php
                $content = [
                    'title' => 'Lucas Deporon Toldo',
                    'date' => '',
                    'funcao' => 'Cardiologista',
                    'crm' => 'CRM: 0000000',            
                    'image' => asset('Client/assets/images/doctor-image.png'),
                    'text' => 'Sexta-feira das 9h00 às 11h00 A partir de 18 anos',
                    'btnName' => 'Ver perfil completo',
                ];
            @endphp
        
            @for ($i = 0; $i < 9; $i++)
                @include('Client.models.mdl-box', $content)
            @endfor

            <!-- The Modal -->
            <div id="modal-especialidade" class="modal-especialidade">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <!-- Conteúdo do modal aqui -->
                </div>
            </div>
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
    document.getElementById("modal-especialidade").style.display = "block";
    }
    // Função para fechar o modal
    function closeModal() {
    document.getElementById("modal-especialidade").style.display = "none";
    }
    </script>
@endsection