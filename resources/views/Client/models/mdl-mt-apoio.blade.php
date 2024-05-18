<article class="box__document">
    <div class="box__document__content">
        <h4 class="box__document__title">{{$title}}</h4>
        <p class="box__document__text">{!!$text!!}</p>
        @if ($document->path_file)
            <div class="box__document__btn">
                <a href="{{$link}}" download class="box__document__link">{{$btnName}}</a>
            </div>
        @endif
    </div>
</article>