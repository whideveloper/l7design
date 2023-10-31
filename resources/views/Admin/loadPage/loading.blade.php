<style>
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
        <img src="{{asset('Admin/assets/images/load.gif')}}" alt="Carregando..." />

        <h4 >Carregando...</h4>
    </div>
</div>

