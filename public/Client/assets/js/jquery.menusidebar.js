// function sidebar() {
//     $('[data-sidebar]').each(function() {
//         var alvoSidebar = $(this).attr('data-sidebar');
//         $(alvoSidebar).addClass('sidebar');
//         $(alvoSidebar).prepend('<div class="closeSidebar"> <span></span> <span></span> <span></span> </div>');
//         $(this).click(function() {
//             $(alvoSidebar).addClass('aberto');
//             $('body').addClass('no-scroll');
//             if (!$('.fundo-sidebar').length) { // evita que crie mais de 1 fundo-sidebar
//                 $('body').prepend('<div class="fundo-sidebar closeSidebar"></div>');
//             }
//         });

//         $('body').delegate('.closeSidebar', 'click', function() {
//             $(alvoSidebar).removeClass('aberto');
//             $('body').removeClass('no-scroll');
//             $('.fundo-sidebar').remove();
//         });

//         // Fecha o sidebar apenas quando um item específico do submenu é clicado
//         $('body').delegate('.sidebar .submenu__item', 'click', function(event) {
//             $(alvoSidebar).removeClass('aberto');
//             $('body').removeClass('no-scroll');
//             $('.fundo-sidebar').remove();
//             event.stopPropagation();
//         });
//     });
// }

function sidebar() {
    $('[data-sidebar]').each(function() {
        var alvoSidebar = $(this).attr('data-sidebar');
        $(alvoSidebar).addClass('sidebar');
        $(alvoSidebar).prepend('<div class="closeSidebar"> <span></span> <span></span> <span></span> </div>');
        $(this).click(function() {
            $(alvoSidebar).addClass('aberto');
            $('body').addClass('no-scroll');
            if (!$('.fundo-sidebar').length) { // evita que crie mais de 1 fundo-sidebar
                $('body').prepend('<div class="fundo-sidebar closeSidebar"></div>');
            }
        });

        $('body').delegate('.closeSidebar', 'click', function() {
            $(alvoSidebar).removeClass('aberto');
            $('body').removeClass('no-scroll');
            $('.fundo-sidebar').remove();
        });

        // Fecha o sidebar apenas quando um item específico do submenu é clicado
        $('body').delegate('.sidebar .submenu__item', 'click', function(event) {
            $(alvoSidebar).removeClass('aberto');
            $('body').removeClass('no-scroll');
            $('.fundo-sidebar').remove();
            
            // Redireciona para a página correspondente e rola para a seção
            var targetSection = $(this).attr('data-target-section');
            if (targetSection) {
                window.location.href = targetSection;
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $(targetSection).offset().top
                    }, 500);
                }, 500); // Aguarde 500ms antes de rolar para a seção
            }
            
            event.stopPropagation();
        });
    });
}
