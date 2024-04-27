@extends('Client.core.main')
@section('content')
    <section class="contato">
        <div class="contato__content">
            <h2 class="contato__title">Contatos TeleNordeste</h2>

            <div class="contato__list">
                <div class="contato__item">
                    <div class="contato__image">
                        <img src="{{asset('Client/assets/images/cont-1.jpg')}}" alt="Adriana Miyauchi" title="Adriana Miyauchi">
                    </div>
                    <div class="contato__description">
                        <p>Adriana Miyauchi</p>
                        <span>adriana.miyauchi@haoc.com.br</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection