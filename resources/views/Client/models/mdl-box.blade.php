<article class="mdl-box">
    <div class="mdl-box__content">
        @if ($image)
            <div class="mdl-box__image">
                <img src="{{ $image }}" alt="" class="mdl-box__left">
            </div>
        @endif
        <div class="mdl-box__description">
            <div class="mdl-box__right">
                <h3 class="mdl-box__title">{{ $title }}</h3>
                <span class="mdl-box__function">{{ $funcao }}</span>
                <span class="mdl-box__crm">{{ $crm }}</span>
                <div class="mdl-box__text">{!! $text !!}</div>
            </div>
            <div class="mdl-box__btn">
                <a class="more" onclick="openModal({{$id}})">{{ $btnName }}</a>
            </div>
        </div>
    </div>
</article>