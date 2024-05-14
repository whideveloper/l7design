@extends('Client.core.main')
@section('content')
@if ($contatos->count() > 0)
    <section class="contato">
        <div class="contato__content">
            <h2 class="contato__title">Contatos TeleNordeste</h2>

            <div class="contato__list">
                @foreach ($contatos as $contato)
                    <div class="contato__item">
                        <div class="contato__container">
                            <div class="contato__image">
                                <img src="{{asset('storage/'. $contato->path_image)}}" alt="{{$contato->name}}" title="{{$contato->name}}">
                            </div>
                            <div class="contato__description">
                                <p>{{$contato->name}}</p>
                                <span>{{$contato->email}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="contato__wpp">
        <div class="contato__wpp__content">
            <div class="contato__wpp__btn contato__wpp__link">
                <a href=""><img src="{{asset('Client/assets/images/wpp.svg')}}" alt=""> Contato pelo Whatsapp</a>
            </div>
        </div>
    </section>
@endif
@if ($googleForm)
    <section class="google__form">
        <div class="google__form__content">
            <h3 class="google__form__title">{{$googleForm->title}}</h3>
            <div class="google__form__text">
                <p>
                    {!! $googleForm->text !!}
                </p>
            </div>

            <div class="google__form__response">
                <iframe src="{{$googleForm->link}}" 
                width="640" 
                height="659" 
                frameborder="0" 
                marginheight="0" 
                marginwidth="0">Carregando…</iframe>            
            </div>
        </div>
    </section>
@endif
    
@endsection