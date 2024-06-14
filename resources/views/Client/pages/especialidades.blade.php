@extends('Client.core.main')
@section('content')
@if ($sessaoEspecialidade || $categorias->count() > 0 && $especialistas->count() > 0)
    <section class="especialidades"> 
        <div class="especialidades__content">
            @if ($sessaoEspecialidade)
                <h3 class="especialidades__title">{{$sessaoEspecialidade->title}}</h3>
                <div class="especialidades__text">
                    <p>
                        {!!$sessaoEspecialidade->text!!}
                    </p>
                </div>
            @endif
            <div class="especialidades__categories">
                <ul class="especialidades__categories__list">
                    @foreach ($categorias as $category)
                        <li class="especialidades__categories__item {{ request()->category == $category->slug ? 'active' : '' }}">
                            <a href="{{route('especialidades-category', [$category->slug])}}">{{$category->title}}</a>
                        </li>
                    @endforeach
                    @if (Route::currentRouteName() ==  'especialidades-category')                        
                        <li class="especialidades__categories__item bt-all">
                            <a href="{{route('especialidades')}}">Limpar filtro</a>
                        </li>
                    @endif
                </ul>
            </div>

            @foreach ($especialistas as $especialista)
                @php  
                    if ($especialista->path_image) {                        
                        $image = asset('storage/'. $especialista->path_image);
                    }else{
                        $image = '';
                    }
                    $content = [
                        'id' => $especialista->id,
                        'title' => $especialista->name,
                        'funcao' => $especialista->title,
                        'crm' => ($especialista->crm != null) ? $especialista->crm : '',            
                        'image' => $image,
                        'text' => $especialista->description,
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
                                    @if ($especialista->path_image)                                        
                                        <div class="modal-box__image">
                                            <img src="{{asset('storage/' . $especialista->path_image)}}" alt="{{$especialista->name}}" title="{{$especialista->name}}" class="modal-box__left">
                                        </div>
                                    @endif
                                    <div class="modal-box__description">
                                        <div class="modal-box__right">
                                            <h3 class="modal-box__title">{{$especialista->name}}</h3>
                                            <span class="modal-box__function">{{$especialista->title}}</span>
                                            <span class="modal-box__crm">{{($especialista->crm != null) ? 'CRM: '. $especialista->crm : ''}}</span>
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
            {{-- PAGINATION --}}
            <div class="pagi">
                {{$especialistas->links()}}
            </div>
        </div>
    </section>
@endif

@if ($tutorial || $trainingForUse || $arquivoTreinamentos->count() > 0)
    <section class="tutorial">
        <div class="tutorial__content">
            @if (!$trainingForUse && $arquivoTreinamentos->count() < 1)
                <style>
                    .tutorial .tutorial__content .tutorial__content__left{
                        max-width: 100%;
                    }
                </style>
            @endif
            @if ($tutorial)
                <div class="tutorial__content__left">
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
            @endif
            @if ($trainingForUse || $arquivoTreinamentos->count() > 0)   
                @if (!$tutorial)
                    <style>
                        .tutorial .tutorial__content .tutorial__content__right{
                            max-width: 100%;
                        }
                    </style>
                @endif                 
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
                    <a href="https://haoc.nilocare.app/login" target="_blank" class="consulta"><img src="{{asset('Client/assets/images/cursor.svg')}}" alt="Agendar Consulta" title="Agendar Consulta"> {{$agendamento->btn_title}}</a>
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

<script>
 // Seleciona todos os elementos <li> dentro do container
var listItems = document.querySelectorAll('.modal-box__text__long li');

// Se não houver nenhum item de lista
if (listItems.length === 0) {
    // Seleciona o container principal
    var textContainer = document.querySelector('.modal-box__text__long');

    // Obtém o texto dentro do container
    var text = textContainer.textContent;

    // Decodifica as entidades HTML e remove as tags HTML
    var decodedText = text.replace(/<\/?[^>]+(>|$)/g, ''); // Remove as tags HTML
    decodedText = decodedText.replace(/&nbsp;/g, ' '); // Remove entidades &nbsp;

    // Quebra o texto em diferentes partes usando um separador
    var textParts = decodedText.split('. ');

    // Cria um novo elemento <p>
    var paragraph = document.createElement('p');

    // Itera sobre as diferentes partes do texto
    for (var i = 0; i < textParts.length; i++) {
        // Adiciona cada parte do texto como um parágrafo
        paragraph.innerHTML += textParts[i];
        // Adiciona uma quebra de linha (<br>) após cada parte do texto, exceto a última
        if (i < textParts.length - 1) {
            paragraph.innerHTML += '<br>';
        }
    }

    // Limpa o conteúdo original do container
    textContainer.innerHTML = '';

    // Adiciona o novo elemento <p> ao container original
    textContainer.appendChild(paragraph);
}
else {
    // Para cada item de lista
    listItems.forEach(function(item) {
        // Obtém o texto dentro do item
        var text = item.innerHTML;

        // Decodifica as entidades HTML e remove as tags HTML
        var decodedText = text.replace(/<[^>]+>/g, ''); // Remove as tags HTML
        decodedText = decodedText.replace(/&nbsp;/g, ' '); // Remove entidades &nbsp;

        // Cria um novo elemento <p>
        var paragraph = document.createElement('p');

        // Insere o texto decodificado dentro do elemento <p>
        paragraph.textContent = decodedText;

        // Limpa o conteúdo original do item
        item.innerHTML = '';

        // Adiciona o novo elemento <p> ao item da lista
        item.appendChild(paragraph);
    });
}

</script>
@endsection