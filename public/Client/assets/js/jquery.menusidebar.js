function sidebar(){
    $('[data-sidebar]').each(function(){
        var alvoSidebar = $(this).attr('data-sidebar');
        $(alvoSidebar).addClass('sidebar');
        $(alvoSidebar).prepend('<div class="closeSidebar"> <span></span> <span></span> <span></span> </div>');
        $(this).click(function(){
            $(alvoSidebar).addClass('aberto');
            $('body').addClass('no-scroll');
            if(!$('.fundo-sidebar').length){ // evita que crie mais de 1 fundo-sidebar
                $('body').prepend('<div class="fundo-sidebar closeSidebar"></div>');
            }
        });

        $('body').delegate('.closeSidebar','click', function(){
            $(alvoSidebar).removeClass('aberto');
            $('body').removeClass('no-scroll');
            $('.fundo-sidebar').remove();
        });
        
        $('body').delegate('.sidebar ul li','click', function(){
            setTimeout(function(){
                $(alvoSidebar).removeClass('aberto');
                $('body').removeClass('no-scroll');
                $('.fundo-sidebar').remove();
            },800);
        });
    });
}