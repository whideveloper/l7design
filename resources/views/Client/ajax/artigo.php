<?php
$content = [
    'title' => 'Título lorem ipsum dolorem consectum vertun quantus',
    'date' => '21/02/2024',
    'funcao' => '',
    'crm' => '',            
    'image' => 'Client/assets/images/com-1.jpg',
    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim tincidunt porttitor...',
    'link' => 'mural-de-comunicacao-interna',
    'btnName' => 'saiba mais',
];

// Aqui você pode construir a estrutura HTML para o próximo artigo usando os dados acima
$html = '<article class="mdl-box mural-de-comunicacao">' .
        '<div class="mdl-box__content">' .
        '<div class="mdl-box__image">' .
        '<img src="' . $content['image'] . '" alt="" class="mdl-box__left">' .
        '</div>' .
        '<div class="mdl-box__description">' .
        '<div class="mdl-box__right">' .
        '<h3 class="mdl-box__title">' . $content['title'] . '</h3>' .
        '<span class="mdl-box__date">' . $content['date'] . '</span>' .
        '<span class="mdl-box__function">' . $content['funcao'] . '</span>' .
        '<span class="mdl-box__crm">' . $content['crm'] . '</span>' .
        '<p class="mdl-box__text">' . $content['text'] . '</p>' .
        '</div>' .
        '<div class="mdl-box__btn">' .
        '<a href="' . $content['link'] . '" class="more">' . $content['btnName'] . '</a>' .
        '</div>' .
        '</div>' .
        '</div>' .
        '</article>';

echo $html;
?>
