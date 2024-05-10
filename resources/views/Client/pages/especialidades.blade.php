@extends('Client.core.main')
@section('content')
@if ($sessaoEspecialidade)
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
                $description = $especialista->description;
                $descricao = strip_tags($description);   

                    $content = [
                        'id' => $especialista->id,
                        'title' => $especialista->name,
                        'date' => '',
                        'funcao' => $especialista->function,
                        'crm' => 'CRM:'. $especialista->crm,            
                        'image' => asset('storage/'. $especialista->path_image),
                        'text' => $descricao,
                        'btnName' => 'Ver perfil completo',
                    ];
                @endphp
                @include('Client.models.mdl-box', $content)
                
                <!-- The Modal -->
                <div id="modal-especialidade-{{$especialista->id}}" class="modal-especialidade">
                    <div class="modal-content">
                        <div class="modal-content-box">
                            <span class="close" onclick="closeModal({{$especialista->id}})">&times;</span>
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
@endif
@if ($tutorial)
    <section class="tutorial">
        <div class="tutorial__content">
            <div class="tutorial__content__left">
                @if (!$trainingForUse && $arquivoTreinamentos->count() < 1)
                    <style>
                        .tutorial .tutorial__content .tutorial__content__left{
                            max-width: 100%;
                        }
                    </style>
                @endif
                <h3 class="tutorial__title">{{$tutorial->title}}</h3>
                <div class="tutorial__text">
                    <p>
                        {!! $tutorial->text !!}
                    </p>
                </div>
                @if ($tutorial->path_file)
                    <div class="btn__tutorial">                    
                        <a href="{{asset('storage/' . $tutorial->path_file)}}" download="" class="turoriaL_more"><img src="{{asset('Client/assets/images/pdf.svg')}}" alt="Ícone de pdf"> {{ $tutorial->btn_title}}</a>
                    </div>
                @endif
            </div>
            @if ($trainingForUse || $arquivoTreinamentos->count() > 0)                    
                <div class="tutorial__content__right">
                    @if ($trainingForUse)
                        <h3 class="tutorial__title right">{{$trainingForUse->title}}</h3>
                        <div class="tutorial__text right">
                            <p>
                                {!! $trainingForUse->text !!}
                            </p>
                        </div>
                    @endif
                    <ul class="tutorial__list">
                        @foreach ($arquivoTreinamentos as $arquivo)
                            <li class="tutorial__item">
                                @if ($arquivo->link_youtube || $arquivo->link_vimeo && !$arquivo->path_file)
                                    <a href="{{isset($arquivo->link_youtube) ? $arquivo->link_youtube : $arquivo->link_vimeo}}" target="_blank" class="tutorial__item_link">{{$arquivo->btn_title}}</a>     
                                    @else
                                    <a href="{{asset('storage/' . $arquivo->path_file)}}" download="" class="tutorial__item_link">{{$arquivo->btn_title}}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endif
@if (!$sessaoEspecialidade && !$tutorial)
    <style>
        .agendamento__content{
            margin-top: 33px
        }
    </style>
@endif
@if ($agendamento)
    <section class="agendamento">
        <div class="agendamento__content">
            <div class="agendamento__text">
                <p>
                    {!! $agendamento->text !!}
                </p>
            </div>
            <div class="btn__agendamento">
                <div class="teleinterconsulta__btn">
                    <a href="" class="consulta"><img src="{{asset('Client/assets/images/cursor.svg')}}" alt="Agendar Consulta" title="Agendar Consulta"> {{$agendamento->btn_title}}</a>
                </div>
            </div>
        </div>
    </section>
@endif

<script>
    // Função para abrir o modal
    function openModal(id) {
        var modal = document.getElementById("modal-especialidade-" + id);
        if (modal) {
            modal.style.display = "block";
            document.body.classList.add("modal-open"); // Adiciona a classe para impedir a rolagem da página
        } else {
            console.error("Modal element not found for ID: " + id);
        }
    }

    // Função para fechar o modal
    function closeModal(id) {
        var modal = document.getElementById("modal-especialidade-" + id);
        if (modal) {
            modal.style.display = "none";
            document.body.classList.remove("modal-open"); // Remove a classe para permitir a rolagem da página
        } else {
            console.error("Modal element not found for ID: " + id);
        }
    }
</script>

  
@endsection