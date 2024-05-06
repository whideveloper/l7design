@extends('Client.core.main')
@section('content')
    <section class="mural-de-comunicacao-interna">
        <div class="mural-de-comunicacao-interna__content">
            <article>
                <h3 class="mural__de__comunicacao__title">Título lorem ipsum dolorem</h3>
                <div class="mural-de-comunicacao-interna__text">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis turpis orci, euismod non vestibulum vel, tempus et ex. Proin sem est, pellentesque vitae nisl id, consectetur vulputate orci. Nulla nec lorem facilisis, fringilla est ac, condimentum eros.
                        <br><br>
                        Curabitur tempus congue nulla id tincidunt. Donec quis erat eu magna tristique maximus. Phasellus hendrerit ligula eget blandit vulputate. Fusce auctor nisl elit, sed consectetur ante laoreet et. Nullam faucibus et arcu nec ultrices. Donec eleifend vehicula dui et varius. Nam eu gravida ipsum.
                        <br><br>
                        Cras gravida tempus lorem maximus efficitur. In sed leo ullamcorper, maximus velit eu, ultrices lacus. In suscipit dapibus elementum. <strong>Duis condimentum nisl</strong> iaculis odio auctor, venenatis cursus eros vulputate. Vivamus rhoncus, nibh quis iaculis lobortis, justo enim auctor est, condimentum tristique velit lacus a tortor.
                        <br><br>
                        Ut eget pretium ex, sit amet aliquet massa. Vestibulum ultrices nisl ut lorem venenatis convallis. Duis vel rutrum ex. Morbi tempor ornare dictum. Maecenas felis mi, volutpat vel mattis vel, efficitur id nunc. Vivamus et tortor libero.
                        <br><br>
                        Phasellus at efficitur orci. Quisque ultricies nisi at elit elementum, at consectetur massa malesuada. Aenean sit <strong>amet faucibus velit, quis tincidunt</strong> purus. Nunc et efficitur lorem, at aliquam justo. Sed a magna condimentum, fringilla odio a, porta magna.
                        <br><br>
                        <img src="{{asset('Client/assets/images/com-1.jpg')}}" alt=""> 
                        <br><br>
                        Nam ultrices diam quis enim scelerisque ornare dapibus eu orci. In felis risus, fermentum non mollis ornare, tempor quis lorem. Mauris tempus leo a nisl ullamcorper pretium. Mauris varius, lorem id feugiat commodo, magna massa pulvinar tortor, eu molestie massa lacus nec ligula.
                        <br><br>
                        Vivamus faucibus, tortor <strong>commodo rhoncus accumsan</strong>, purus eros pellentesque nibh, sed ullamcorper dolor neque ut eros. Aenean tristique tellus in luctus mollis. Sed eget neque sapien.
                        <br><br>
                        Maecenas at eros at arcu pellentesque vehicula sodales eu nunc. Phasellus mollis accumsan ligula, non aliquet metus congue in. Quisque pretium, odio vel mollis varius, felis ligula aliquam ipsum, id imperdiet arcu ligula a velit. In congue lectus dui.
                        <br><br>
                        Pellentesque nibh felis, vulputate quis mauris non, <strong>scelerisque condimentum</strong> diam. Proin tellus libero, malesuada non commodo sit amet, finibus eu metus.
                        <br><br>
                        Mauris semper quam risus, at gravida lectus scelerisque vel. Nam at tellus at urna scelerisque pellentesque. Quisque venenatis lorem at purus facilisis posuere.
                    </p>
                </div>
                <div class="goback mural">
                    <a href="{{route('mural-de-comunicacao')}}">Voltar</a>
                </div>
            </article>
            <aside>
                <h4 class="mural__de__comunicacao__title__aside">Conteúdos relacionados</h4>
                <div class="mural__de__comunicacao__aside__content owl-carousel">
                    @php
                        $content = [
                            'title' => 'Título lorem ipsum dolorem consectum vertun quantus',
                            'date' => '21/02/2024',
                            'funcao' => '',
                            'crm' => '',            
                            'image' => asset('Client/assets/images/com-1.jpg'),
                            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim tincidunt porttitor...',
                            'link' => '/servicos',
                            'btnName' => 'saiba mais',
                        ];
                    @endphp
                
                    @for ($i = 0; $i < 3; $i++)
                        @include('Client.models.mdl-box', $content)
                    @endfor
                </div>
            </aside>
        </div>
    </section>
@endsection