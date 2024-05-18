
/* rolagem do btn de menu */
if (document.querySelector(".btn-mn-mbl")) {
    const btnMenu = document.querySelector(".btn-mn-mbl");

    window.addEventListener("scroll", () => {
        if (window.innerWidth < 920) {
            if (window.scrollY > 95) {
                if (btnMenu.style.position !== "fixed") {
                    btnMenu.style.position = "fixed";
                    btnMenu.style.right = "12px";
                    btnMenu.style.top = "30px";
                    btnMenu.style.zIndex = "1000";
                }
            } else {
                if (btnMenu.style.position !== "relative") {
                    btnMenu.style.position = "relative";
                    btnMenu.style.right = "unset";
                    btnMenu.style.top = "unset";
                    btnMenu.style.zIndex = "1000";
                }
            }
        } if(window.innerWidth < 720) {
            btnMenu.style.position = "fixed";
            btnMenu.style.right = "12px";
            btnMenu.style.top = "30px";
            btnMenu.style.zIndex = "1000";
        }
    });
}

/* rolagem do btn de menu */


/* BANNER HOME */
function changeBanner(images) {
    for (let i = 0; i < images.length; i++) {
        if (window.innerWidth <= 680) {
            if (images[i].dataset.bannerMobile != "") {
                // Verifica se há um banner mobile, caso sim, troca o src
                images[i].src = images[i].dataset.bannerMobile;
            }
        } else {
            if (images[i].dataset.bannerDesktop != "") {
                // Volta para o banner grande caso a resolução da tela mude
                images[i].src = images[i].dataset.bannerDesktop;
            }
        }
    }
}

// Para executar a função ao carregar a página e ao redimensionar a janela
window.addEventListener('load', function() {
    const banners = document.querySelectorAll('img[data-banner-mobile][data-banner-desktop]');
    changeBanner(banners);
});

window.addEventListener('resize', function() {
    const banners = document.querySelectorAll('img[data-banner-mobile][data-banner-desktop]');
    changeBanner(banners);
});

document.addEventListener('DOMContentLoaded', function() {
    const banners = document.querySelectorAll('img[data-banner-mobile][data-banner-desktop]');
    changeBanner(banners);

    window.addEventListener('resize', function() {
        changeBanner(banners);
    });
});

// function changeBanner(c) {
//     for (let i = 0; i < c.length; i++) {
//         if (window.innerWidth < 720) {
//             if (c[i].dataset.mobileBanner != "") {
//                 /*verifica se há um banner mobile, caso sim, troca a img, caso não ele mantem o banner grande*/
//                 c[i].style.backgroundImage =
//                     "url(" + c[i].dataset.bannerMobile + ")";
//             }
//         } else {
//             if (c[i].dataset.desktopBanner != "") {
//                 /*volta para o banner grande caso o banner mude a resolução da tela*/
//                 c[i].style.backgroundImage =
//                     "url(" + c[i].dataset.bannerDesktop + ")";
//             }
//         }
//     }
// }

if (document.querySelector("#banner")) {
    //carousel  com splide para o banner
    new Splide("#banner", {
        perPage: 1,
        perMove: 1,
        autoHeight: true,
        autoWidth: true,
        pagination: true,
        autoplay: true,
        interval: 10000,
        arrows: false,
    }).mount();

    /* banner responsivo */
    const carousels = document.querySelectorAll("#banner .splide__slide");
    changeBanner(carousels);

    window.addEventListener("resize", changeBanner.bind(null, carousels));
    /* banner responsivo */
}
/* BANNER HOME */



/* btn de rolagem */
if (document.querySelector(".btn-scroll")) {
    document.querySelector(".btn-scroll").addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector("#miolo").scrollIntoView({ behavior: "smooth" });
    });
}
/* btn de rolagem */

/* Mascaras usando inputmask.js */
/* ref: https://github.com/RobinHerbots/Inputmask */
if (document.querySelector(".cpf")) {
    document
        .querySelectorAll(".cpf")
        .forEach((item) => Inputmask({ mask: "999 999 999-99" }).mask(item));
}

if (document.querySelector(".cnpj")) {
    document
        .querySelectorAll(".cnpj")
        .forEach((item) =>
            Inputmask({ mask: "99 999 999/9999-99" }).mask(item)
        );
}

if (document.querySelector(".cep")) {
    document
        .querySelectorAll(".cep")
        .forEach((item) => Inputmask({ mask: "99 999-999" }).mask(item));
}

if (document.querySelector(".agency")) {
    document
        .querySelectorAll(".agency")
        .forEach((item) => Inputmask({ mask: "99999" }).mask(item));
}
if (document.querySelector(".digit")) {
    document
        .querySelectorAll(".digit")
        .forEach((item) => Inputmask({ mask: "9" }).mask(item));
}
if (document.querySelector(".current_account")) {
    document
        .querySelectorAll(".current_account")
        .forEach((item) => Inputmask({ mask: "999999999999" }).mask(item));
}
if (document.querySelector(".best_payment")) {
    document
        .querySelectorAll(".best_payment")
        .forEach((item) => Inputmask({ mask: "99" }).mask(item));
}

if (document.querySelector(".tel")) {
    document
        .querySelectorAll(".tel")
        .forEach((item) => Inputmask({ mask: "(99) 9999 99999" }).mask(item));
}

if (document.querySelector(".cel")) {
    document
        .querySelectorAll(".cel")
        .forEach((item) => Inputmask({ mask: "(99) 9 9999-999" }).mask(item));
}

if (document.querySelector(".ano")) {
    document
        .querySelectorAll(".ano")
        .forEach((item) => Inputmask({ mask: "9999" }).mask(item));
}
/* Mascaras usando inputmask.js */

// Material de apoio
document.addEventListener("click", function(event) {
    // Verifica se o elemento clicado não é o link principal "Material de apoio"
    if (event.target.id !== "material-de-apoio-click") {
        // Seleciona o submenu
        var submenu = document.getElementById("submenu-material-de-apoio");
        // Remove a classe 'active' do submenu
        submenu.classList.remove("active");
    }
});

document.getElementById("material-de-apoio-click").addEventListener("click", function(event) {
    // Evita que o evento de clique se propague para o documento
    event.stopPropagation();

    // Seleciona o submenu
    var submenu = document.getElementById("submenu-material-de-apoio");
    // Verifica se o submenu possui a classe 'active'
    var isActive = submenu.classList.contains("active");

    // Se o submenu já estiver ativo, remove a classe 'active'; caso contrário, adiciona a classe 'active'
    if (isActive) {
        submenu.classList.remove("active");
    } else {
        submenu.classList.add("active");
    }
});
//Final material de apoio

if (document.getElementById("newslleter-message")) {
    // console.log('success')
    setTimeout(function () {
        document.querySelector("#newslleter-message").classList.toggle("off");
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function () {
    var splide = new Splide('#image-carousel', {
        heightRatio: 0.5,
        dots: true,
        arrows: false,
        type: 'fade', 
        autoplay: true, 
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        speed: 4000, 
        interval: 3000, 
    }).mount();

    // Função para reposicionar as "firulas" com o mesmo efeito de transição
    function reposicionarFirulas(slide) {
        var slideIndex = splide.index;

        // Verifica se o slide atual é o slide ativo
        if (slideIndex === splide.index) {
            slide.querySelector('.slide-fitula-1').style.transition = 'top 0.5s cubic-bezier(0, 0, 1, 1), left 0.5s cubic-bezier(0, 0, 1, 1)';
            slide.querySelector('.slide-fitula-2').style.transition = 'top 0.5s cubic-bezier(0, 0, 1, 1), left 0.5s cubic-bezier(0, 0, 1, 1)';
            slide.querySelector('.slide-fitula-3').style.transition = 'bottom 0.5s cubic-bezier(0, 0, 1, 1), left 0.5s cubic-bezier(0, 0, 1, 1)';

            switch (slideIndex) {
                case 0:
                    slide.querySelector('.slide-fitula-1').style = '';
                    slide.querySelector('.slide-fitula-2').style = '';
                    slide.querySelector('.slide-fitula-3').style = '';
                    break;
                case 1:
                    if ($(window).width() < 680) {
                        slide.querySelector('.slide-fitula-1').style.top = '120px';
                        slide.querySelector('.slide-fitula-1').style.left = '227px';
                        slide.querySelector('.slide .slide-fitula-2').style.top = '300px'; 
                        slide.querySelector('.slide .slide-fitula-3').style.left = '20px';                       
                    }else{
                        slide.querySelector('.slide-fitula-1').style.top = '90px';
                        slide.querySelector('.slide-fitula-1').style.left = '366px';
                        slide.querySelector('.slide-fitula-2').style.top = '-121px';
                        slide.querySelector('.slide-fitula-2').style.left = '40px';
                        slide.querySelector('.slide-fitula-3').style.bottom = '205px';
                        slide.querySelector('.slide-fitula-3').style.left = '40px';
                    }
                    
                    break;
                case 2:
                    if($(window).width() < 680){
                        slide.querySelector('.slide .slide-fitula-1').style.left = '8px';
                        slide.querySelector('.slide .slide-fitula-2').style.left = '219px';
                        slide.querySelector('.slide .slide-fitula-3').style.left = '225px';
                        slide.querySelector('.slide .slide-fitula-3').style.top = '119px';
                    }else{
                        slide.querySelector('.slide-fitula-1').style.top = '230px';
                        slide.querySelector('.slide-fitula-1').style.left = '166px';
                        slide.querySelector('.slide-fitula-2').style.top = '485px';
                        slide.querySelector('.slide-fitula-2').style.left = '485px';
                        slide.querySelector('.slide-fitula-3').style.bottom = '600px';
                        slide.querySelector('.slide-fitula-3').style.left = '600px';
                    }
                    break;
                case 3:
                    if ($(window).width() < 680) {
                        slide.querySelector('.slide-fitula-1').style.top = '120px';
                        slide.querySelector('.slide-fitula-1').style.left = '227px';
                        slide.querySelector('.slide .slide-fitula-2').style.top = '300px'; 
                        slide.querySelector('.slide .slide-fitula-3').style.left = '20px';  
                    }else{
                        slide.querySelector('.slide-fitula-1').style.top = '90px';
                        slide.querySelector('.slide-fitula-1').style.left = '366px';
                        slide.querySelector('.slide-fitula-2').style.top = '-121px';
                        slide.querySelector('.slide-fitula-2').style.left = '40px';
                        slide.querySelector('.slide-fitula-3').style.bottom = '205px';
                        slide.querySelector('.slide-fitula-3').style.left = '40px';
                    }
                    
                    break;
                default:
                    break;
            }
        } else {
            // Se o slide não estiver ativo, remova os estilos
            slide.querySelector('.slide-fitula-1').style = '';
            slide.querySelector('.slide-fitula-2').style = '';
            slide.querySelector('.slide-fitula-3').style = '';
        }
    }

    // Chama a função de reposicionamento ao mudar de slide
    splide.on('moved', function (newIndex) {
        var slides = splide.Components.Elements.slides;
        slides.forEach(function (slide) {
            reposicionarFirulas(slide);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Seletor para o botão flutuante
    var botaoFlutuante = document.getElementById('rolagem__top');
    // Seletor para a sessão do rodapé
    var footer = document.getElementById('footer');

    // Função para verificar a posição do scroll e mostrar o botão flutuante quando necessário
    function verificarPosicaoScroll() {
        var footerPos = footer.getBoundingClientRect();

        // Verificar se o rodapé está visível na janela de visualização
        if (footerPos.top <= window.innerHeight) {
            // O rodapé está visível na janela de visualização
            // Portanto, adicione a classe 'ft' ao botão flutuante
            botaoFlutuante.classList.add('ft');
        } else {
            // O rodapé não está visível na janela de visualização
            // Portanto, remova a classe 'ft' do botão flutuante
            botaoFlutuante.classList.remove('ft');
        }
    }
    
    // Adicionar um ouvinte de evento de rolagem ao objeto window
    window.addEventListener('scroll', verificarPosicaoScroll);
    
    // Chamar a função verificarPosicaoScroll() após o carregamento da página para garantir que o botão flutuante seja exibido corretamente
    window.addEventListener('load', verificarPosicaoScroll);

    // Adiciona um evento de clique ao botão flutuante para rolar para o topo da página
    botaoFlutuante.addEventListener('click', function(e) {
        e.preventDefault();

        // ID do elemento para onde deseja rolar
        const targetId = '#header';
        const target = document.querySelector(targetId);

        // Calcula a posição de rolagem com uma compensação de 20 pixels para parar acima da seção
        const offset = 20;
        const targetPosition = target.offsetTop - offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });
});

$(document).ready(function(){
    sidebar(); // CHAMA A FUNCAO SIDEBAR
    // Header flutuante
    var header = document.getElementById("header");  
    // Obtém a posição inicial do cabeçalho
    var headerOffset = header.offsetTop;

    window.addEventListener("scroll", function() {
        // Verifica se a posição de rolagem ultrapassou a posição inicial do cabeçalho
        if (window.pageYOffset > headerOffset) {
            header.classList.add("flutuante");
        } else {
            header.classList.remove("flutuante");
        }
    });

    if ($(window).width() < 961) {
        $(".mural__de__comunicacao__aside__content").addClass("carrossel-relacionados");
    }
    $(window).resize(function(){
        if ($(window).width() <= 961) {
            $(".fmural__de__comunicacao__aside__content").addClass("carrossel-relacionados");
        } else {
            $(".fmural__de__comunicacao__aside__content").removeClass("carrossel-relacionados");
        }
    });
    function initializeCarousel() {
        $(".carrossel-relacionados").owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1.1, // Exibe uma parte do segundo item
                    margin: 0 
                },
                475: {
                    items: 1.1, // Exibe uma parte do segundo item
                    margin: 0 // Reduz a margem para que o segundo item seja parcialmente visível
                },
                530: {
                    items: 2
                },
                730: {
                    items: 3
                }
            }
        });
    }

    // Chama a função quando a página é carregada
    initializeCarousel();

    // Chama a função quando a janela é redimensionada
    $(window).resize(function() {
        initializeCarousel();
    });   

    $(".depoimento").owlCarousel({
        loop:true,
        margin:25,
        center:true,
        nav:true,
        dots:false,
        // autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        smartSpeed: 1600,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            768:{
                items:2
            },
            1024:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });

    if ($(window).width() <= 768) {
        $(".footer__logos__items").addClass("carrossel-logos");
    }
    
    $(window).resize(function(){
        if ($(window).width() <= 768) {
            $(".footer__logos__items").addClass("carrossel-logos");
        } else {
            $(".footer__logos__items").removeClass("carrossel-logos");
        }
    });
    
    $(".carrossel-logos").owlCarousel({
        loop: true,
        autoplay: true, 
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        margin: 20,
        responsiveClass: true,
        smartSpeed: 1300,
        responsive:{
            0:{
                items: 2, // Número de itens visíveis em resoluções menores que 768px
            },
            768:{
                items: 3, // Número de itens visíveis em resoluções maiores ou igual a 768px
            }
        }
    });

    if ($(window).width() <= 680) {
        $(".location-carrossel-mobile").addClass("carrossel-mobile");
    }
    
    $(window).resize(function(){
        if ($(window).width() <= 680) {
            $(".location-carrossel-mobile").addClass("carrossel-mobile");
        } else {
            $(".location-carrossel-mobile").removeClass("carrossel-mobile");
        }
    });
    $(".carrossel-mobile").owlCarousel({
        loop: false,
        autoplay: false, 
        nav:false,
        dots:true,
        margin: 20,
        responsiveClass: true,
        smartSpeed: 1600,
        responsive:{
            0:{
                items: 2,
            },
            475:{
                items: 2,
            },
            680:{
                items: 3,
            }
        }
    });
    
    if ($(window).width() <= 680) {
        $(".funciona__steps").addClass("funciona__steps__mobile");
    }
    
    $(window).resize(function(){
        if ($(window).width() <= 680) {
            $(".funciona__steps").addClass("funciona__steps__mobile");
        } else {
            $(".funciona__steps").removeClass("funciona__steps__mobile");
        }
    });
    $(".funciona__steps__mobile").owlCarousel({
        loop: false,
        autoplay: false, 
        nav:false,
        dots:true,
        margin: 20,
        responsiveClass: true,
        smartSpeed: 1600,
        responsive:{
            0:{
                items: 1,
            },
            680:{
                items: 1,
            }
        }
    });

    if ($(window).width() <= 525) {
        $(".material__content__list").addClass("material-mobile");
    }
    
    $(window).resize(function(){
        if ($(window).width() <= 525) {
            $(".material__content__list").addClass("material-mobile");
        } else {
            $(".material__content__list").removeClass("material-mobile");
        }
    });
    function initializeCarousel1() {
        $(".material-mobile").owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1.1, // Exibe uma parte do segundo item
                    margin: 10 
                },
                525: {
                    items: 1.1, // Exibe uma parte do segundo item
                    margin: 10 // Reduz a margem para que o segundo item seja parcialmente visível
                },
            }
        });
    }

    // Chama a função quando a página é carregada
    initializeCarousel1();

    // Chama a função quando a janela é redimensionada
    $(window).resize(function() {
        initializeCarousel1();
    });  

});












