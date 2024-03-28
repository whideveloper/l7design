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
function changeBanner(c) {
    for (let i = 0; i < c.length; i++) {
        if (window.innerWidth < 720) {
            if (c[i].dataset.mobileBanner != "") {
                /*verifica se há um banner mobile, caso sim, troca a img, caso não ele mantem o banner grande*/
                c[i].style.backgroundImage =
                    "url(" + c[i].dataset.bannerMobile + ")";
            }
        } else {
            if (c[i].dataset.desktopBanner != "") {
                /*volta para o banner grande caso o banner mude a resolução da tela*/
                c[i].style.backgroundImage =
                    "url(" + c[i].dataset.bannerDesktop + ")";
            }
        }
    }
}

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



if (document.getElementById("newslleter-message")) {
    // console.log('success')
    setTimeout(function () {
        document.querySelector("#newslleter-message").classList.toggle("off");
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function () {
    new Splide('#image-carousel', {
        heightRatio: 0.5,
        dots: true,
        arrows: false,
        type: 'fade', 
        autoplay: true, 
        speed: 1000, 
        interval: 3000, 
    }).mount();
});
$(document).ready(function(){
    $(".depoimento").owlCarousel({
        loop:true,
        margin:25,
        center:true,
        nav:true,
        dots:false,
        autoplay:false,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });
});











