<article class="mdl-box mural-de-comunicacao">
    <div class="mdl-box__content">
        <div class="mdl-box__image">
            <img src="{{ $image }}" alt="" class="mdl-box__left">
        </div>
        <div class="mdl-box__description">
            <div class="mdl-box__right">
                <h3 class="mdl-box__title">{{ $title }}</h3>
                <span class="mdl-box__date">{{ $date }}</span>
                <p class="mdl-box__text">{!! $text !!}</p>
            </div>
            <div class="mdl-box__btn">
                <a href="{{$link}}" {{isset($mural->link)?'target="_blank"':''}} class="more">{{ $btnName }}</a>
            </div>
        </div>
    </div>
</article>