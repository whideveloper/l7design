<style>
/* KEY FRAMES PARA FAZER OS GIROS */
@-webkit-keyframes rodaroda {
    0% { -webkit-transform:rotate(0deg); -moz-transform:rotate(0deg); -ms-transform:rotate(0deg); -o-transform:rotate(0deg); transform:rotate(0deg); }
    50% { -webkit-transform:rotate(180deg); -moz-transform:rotate(180deg); -ms-transform:rotate(180deg); -o-transform:rotate(180deg); transform:rotate(180deg); }
    100% { -webkit-transform:rotate(360deg); -moz-transform:rotate(360deg); -ms-transform:rotate(360deg); -o-transform:rotate(360deg); transform:rotate(360deg); }
}
@-moz-keyframes rodaroda {
    0% { -webkit-transform:rotate(0deg); -moz-transform:rotate(0deg); -ms-transform:rotate(0deg); -o-transform:rotate(0deg); transform:rotate(0deg); }
    50% { -webkit-transform:rotate(180deg); -moz-transform:rotate(180deg); -ms-transform:rotate(180deg); -o-transform:rotate(180deg); transform:rotate(180deg); }
    100% { -webkit-transform:rotate(360deg); -moz-transform:rotate(360deg); -ms-transform:rotate(360deg); -o-transform:rotate(360deg); transform:rotate(360deg); }
}
@-ms-keyframes rodaroda {
    0% { -webkit-transform:rotate(0deg); -moz-transform:rotate(0deg); -ms-transform:rotate(0deg); -o-transform:rotate(0deg); transform:rotate(0deg); }
    50% { -webkit-transform:rotate(180deg); -moz-transform:rotate(180deg); -ms-transform:rotate(180deg); -o-transform:rotate(180deg); transform:rotate(180deg); }
    100% { -webkit-transform:rotate(360deg); -moz-transform:rotate(360deg); -ms-transform:rotate(360deg); -o-transform:rotate(360deg); transform:rotate(360deg); }
}
@-o-keyframes rodaroda {
    0% { -webkit-transform:rotate(0deg); -moz-transform:rotate(0deg); -ms-transform:rotate(0deg); -o-transform:rotate(0deg); transform:rotate(0deg); }
    50% { -webkit-transform:rotate(180deg); -moz-transform:rotate(180deg); -ms-transform:rotate(180deg); -o-transform:rotate(180deg); transform:rotate(180deg); }
    100% { -webkit-transform:rotate(360deg); -moz-transform:rotate(360deg); -ms-transform:rotate(360deg); -o-transform:rotate(360deg); transform:rotate(360deg); }
}
@keyframes rodaroda {
    0% { -webkit-transform:rotate(0deg); -moz-transform:rotate(0deg); -ms-transform:rotate(0deg); -o-transform:rotate(0deg); transform:rotate(0deg); }
    50% { -webkit-transform:rotate(180deg); -moz-transform:rotate(180deg); -ms-transform:rotate(180deg); -o-transform:rotate(180deg); transform:rotate(180deg); }
    100% { -webkit-transform:rotate(360deg); -moz-transform:rotate(360deg); -ms-transform:rotate(360deg); -o-transform:rotate(360deg); transform:rotate(360deg); }
}
    .loading-indicator {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        text-align: center;
        z-index: 9999;
    }
    .loading-indicator .row img{
        width: 100%;
        max-width: 100px;
    }
    .loading-indicator .row{
        display:flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .loading-indicator .row h4{
        color:#262626;
        font-size:1.25rem;
        font-family: Roboto,sans-serif;
        text-align: center;
    }
    #load{
        /* CÓDIGO PARA CHAMAR A ANIMAÇÃO */
        -webkit-animation: rodaroda 3s linear alternate 3;
        -moz-animation: rodaroda 3.0s linear infinite;
        -ms-animation: rodaroda 3.0s linear infinite;
        -o-animation: rodaroda 3.0s linear infinite;
        animation: rodaroda 3.0s linear infinite;
    }
</style>
<div id="loading-indicator"
     style="position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;" class="loading-indicator">
    <div class="row">
        <img id="load" src="{{asset('Admin/assets/images/load-telenordeste.svg')}}" alt="Carregando..." />

        <h4 >Carregando...</h4>
    </div>
</div>

