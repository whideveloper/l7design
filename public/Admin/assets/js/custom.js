function slugify(text) {
    return text
        .toString() // Cast to string (optional)
        .normalize('NFKD') // The normalize() using NFKD method returns the Unicode Normalization Form of a given string.
        .toLowerCase() // Convert the string to lowercase letters
        .trim() // Remove whitespace from both sides of a string (optional)
        .replace(/\s+/g, '') // Replace spaces with -
        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
        .replace(/\-\-+/g, ''); // Replace multiple - with single -
}
function embedLinkYoutube(elem){
    var val = elem.val()
    let result = val.includes("watch?v=");

    if (result) {
        newLink = val.replace('watch?v=', 'embed/')
        elem.val(newLink)
    } else if(val) {
        arrayLink = val.split('/'),
        id = arrayLink[arrayLink.length - 1]
        elem.val(`https://www.youtube.com/embed/${id}`)
    }
}
$(function() {
    $('#linkVimeoEmbed').on('change', function(){
        var val = $(this).val(),
            arrayLink = val.split('/'),
            id = arrayLink[arrayLink.length - 1]
        $(this).val(`https://player.vimeo.com/video/${id}`)
    })
});

$(function() {

    Fancybox.bind('[data-fancybox]');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name=btnSelectItem]').on('click', function() {
        var btnDelete = $(this).parents('table').find('input[name=btnSelectAll]').val()
        if (!$(this).parents('table').find('.btnSelectItem:checked').length) {
            $(`.${btnDelete}`).fadeOut('fast');
        }if($(this).parents('table').find('.btnSelectItem:checked').length > 1){
            $(this).parents('table').find('input[name=btnSelectAll]').prop('checked', true)
            $(`.${btnDelete}`).fadeIn('fast');
            var checked = true
            $('#btSubmitDelete').css('display', 'block');
            $('#btSubmitDeleteForever').css('display', 'block');
            $('#btSubmitRestore').css('display', 'block');
        }else{
            $(this).parents('table').find('input[name=btnSelectAll]').prop('checked', false)
            $('#btSubmitDelete').css('display', 'none');
            $('#btSubmitDeleteForever').css('display', 'none');
            $('#btSubmitRestore').css('display', 'none');
        }
    })

    $('input[name=btnSelectAll]').on('click', function() {
        var btnDelete = $(this).val()

        if ($(this).parents('table').find('.btnSelectItem:checked').length == $(this).parents('table').find('.btnSelectItem').length) {
            $(`.${btnDelete}`).fadeOut('fast');
            var checked = false
            $('#btSubmitDelete').css('display', 'none');
            $('#btSubmitDeleteForever').css('display', 'none');
            $('#btSubmitRestore').css('display', 'none');
        } else {
            $(this).parents('table').find('input[name=btnSelectAll]').prop('checked', true)
            $(`.${btnDelete}`).fadeIn('fast');
            var checked = true
            $('#btSubmitDelete').css('display', 'block');
            $('#btSubmitDeleteForever').css('display', 'block');
            $('#btSubmitRestore').css('display', 'block');
        }
        $(this).parents('table').find('.btnSelectItem').each(function() {
            $(this).prop("checked", checked)
        })
    })

    $('#btSubmitDelete').on('click', function() {
        var $this = $(this),
            val = []

        $('.btnSelectItem:checked').each(function() {
            val.push($(this).val())
        })

        Swal.fire({
            title: "Tem certeza?",
            text: "Os itens excluídos permanecerão no lixo eletrônico até 30 dias, após esse prazo eles serão deletados permanentemente.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                $.ajax({
                    type: 'POST',
                    url: $this.data('route'),
                    data: { deleteAll: val },
                    dataType: 'JSON',
                    beforeSend: function() {},
                    success: function(response) {
                        switch (response.status) {
                            case 'success':
                                Swal.fire({ title: "Deletado!", text: response.message, icon: "success", showConfirmButton: false })
                                setTimeout(() => {
                                    window.location.href = window.location.href
                                }, 1000);
                                break;
                            default:
                                Swal.fire({ title: "Erro!", text: response.message, icon: "error", confirmButtonColor: "#4a4fea" })
                                break;
                        }
                    }
                })
            }
        });
    })
    $('.btSubmitDeleteItem').on('click', function(e) {
        e.preventDefault()
        var $this = $(this)
        Swal.fire({
            title: "Tem certeza?",
            text: "O item excluído permanecerá no lixo eletrônico até 30 dias, após esse prazo ele será deletado permanentemente.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                Swal.fire({ title: "Deletado!", text: "Item deletado com sucesso!", icon: "success", showConfirmButton: false })
                setTimeout(() => {
                    $this.parents('form').submit()
                }, 1000);
            }
        });
    })

    //Restaurar itens
    $('#btSubmitRestore').on('click', function() {
        var $this = $(this),
            val = []

        $('.btnSelectItem:checked').each(function() {
            val.push($(this).val())
        })

        Swal.fire({
            title: "Tem certeza?",
            text: "Ao restaurar os itens os mesmos retornarão para a listagem.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, restaure!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                $.ajax({
                    type: 'POST',
                    url: $this.data('route'),
                    data: { restoreAll: val },
                    dataType: 'JSON',
                    beforeSend: function() {},
                    success: function(response) {
                        switch (response.status) {
                            case 'success':
                                Swal.fire({ title: "Restaurado!", text: response.message, icon: "success", showConfirmButton: false })
                                setTimeout(() => {
                                    window.location.href = indexRoute;
                                }, 1000);
                                break;
                            default:
                                Swal.fire({ title: "Erro!", text: response.message, icon: "error", confirmButtonColor: "#4a4fea" })
                                break;
                        }
                    }
                })
            }
        });
    })
    $('.btSubmitRestoreItem').on('click', function(e) {
        e.preventDefault()
        var $this = $(this)
        Swal.fire({
            title: "Tem certeza?",
            text: "Os itens restaurado retornarão para a listagem.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, restaure!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                Swal.fire({ title: "Restaurado!", text: "Item restaurado com sucesso!", icon: "success", showConfirmButton: false })
                setTimeout(() => {
                    $this.parents('form').submit()
                }, 1000);
            }
        });
    })

    //Deletar permanentemente
    $('#btSubmitDeleteForever').on('click', function() {
        var $this = $(this),
            val = []

        $('.btnSelectItem:checked').each(function() {
            val.push($(this).val())
        })

        Swal.fire({
            title: "Tem certeza?",
            text: "Os itens serão deletados permanentemente. Esta ação não poderá ser revertida.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                $.ajax({
                    type: 'POST',
                    url: $this.data('route'),
                    data: { deleteAllForever: val },
                    dataType: 'JSON',
                    beforeSend: function() {},
                    success: function(response) {
                        switch (response.status) {
                            case 'success':
                                Swal.fire({ title: "Deletado!", text: response.message, icon: "success", showConfirmButton: false })
                                setTimeout(() => {
                                    window.location.href = window.location.href
                                }, 1000);
                                break;
                            default:
                                Swal.fire({ title: "Erro!", text: response.message, icon: "error", confirmButtonColor: "#4a4fea" })
                                break;
                        }
                    }
                })
            }
        });
    })
    $('.btSubmitDeleteItemForever').on('click', function(e) {
        e.preventDefault()
        var $this = $(this)
        Swal.fire({
            title: "Tem certeza?",
            text: "O item será deletado permanentemente. Esta ação não poderá ser revertida.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                Swal.fire({ title: "Deletado!", text: "Item deletado com sucesso!", icon: "success", showConfirmButton: false })
                setTimeout(() => {
                    $this.parents('form').submit()
                }, 1000);
            }
        });
    })

    $('.btSubmitDeleteItemCascade').on('click', function(e) {
        e.preventDefault()
        var $this = $(this)
        Swal.fire({
            title: "Tem certeza?",
            text: "Ao excluir este item, todos os conteúdos relacionados a este feed serão deletados.",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, exclua!",
            cancelButtonText: "Não, cancele!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function(e) {
            if (e.value) {
                Swal.fire({ title: "Deletado!", text: "Item deletado com sucesso!", icon: "success", showConfirmButton: false })
                setTimeout(() => {
                    $this.parents('form').submit()
                }, 1000);
            }
        });
    })

    $('.table-sortable tbody').sortable({
        handle: '.btnDrag'
    }).on('sortupdate', function(e, ui) {

        var arrId = []
        $(this).find('tr').each(function() {
            var id = $(this).data('code')
            arrId.push(id)
        })

        
        $.ajax({
            type: 'POST',
            url: $(this).data('route'),
            data: { arrId: arrId },
            success: function(data) {
                if (data.status) {
                    console.log('Sucesso')
                    $.NotificationApp.send("Sucesso!", "Registro ordenado com sucesso!", "bottom-left", "#00000080", "success", '3000');
                } else {
                    console.log('Primeiro erro')
                    $.NotificationApp.send("Erro!", "Ocorreu um erro ao ordenar o registro!", "bottom-left", "#00000080", "error", '10000');
                }
            },
            error: function() {
                console.log('Segundo erro')
                $.NotificationApp.send("Erro!", "Ocorreu um erro ao ordenar o registro!", "bottom-left", "#00000080", "error", '10000');
            }
        })
    });
    $('#settingTheme input[type=checkbox]').on('click', function() {
        setTimeout(() => {
            var formData = new FormData(),
                route = $(this).parents('form').attr('action')
            formData.append('color_scheme_mode', $(this).parents('form').find('[name=color-scheme-mode]:checked').val())
            formData.append('leftsidebar_color', $(this).parents('form').find('[name=leftsidebar-color]:checked').val())
            formData.append('leftsidebar_size', $(this).parents('form').find('[name=leftsidebar-size]:checked').val())
            formData.append('topbar_color', $(this).parents('form').find('[name=topbar-color]:checked').val())

            $.ajax({
                type: 'POST',
                url: route,
                data: formData,
                processData: false,
                contentType: false
            })
        }, 800);

    })

    $('.selectTypeInput').on('change', function() {
        var type = $(this).val()
        var html = `
            <div class="infoInputs">
                <div class="mb-3">
                    <label class="form-label">Titulo</label>
                    <input type="text" name="title_" required class="form-control inputSetTitle" placeholder="Nome que será exibido para o cliente">
                </div>
            `
        switch (type) {
            case 'select':
            case 'checkbox':
            case 'radio':
                html += `
                    <div class="mb-3">
                        <label class="form-label">Opções</label>
                        <input type="text" name="option_" required class="form-control inputSetOption" placeholder="Separar as opções com vírgula">
                    </div>
                `
                break;
        }
        html += '</div>'


        $(this).parents('.container-type-input').find('.infoInputs').remove()
        $(this).parents('.container-type-input').append(html);
    })

    $('body').on('change', '.inputSetTitle', function() {
        var val = $(this).val()
        var type = $(this).parents('.container-type-input').find('select').val()

        $(this).attr('name', 'title_' + slugify(val) + '_' + type)
        $(this).parents('.container-type-input').find('.inputSetOption').attr('name', 'option_' + slugify(val) + '_' + type)
    })

    $('.cloneTypeButton').on('click', function() {
        $('.container-type-input:first').clone(true).appendTo('.container-inputs-contact');
        $('.container-type-input:last').find('select option').removeAttr('selected');
        $('.container-type-input:last').find('select option:first').attr('selected', 'selected');
        $('.infoInputs:last').remove()
    })

    $('.deleteTypeButton').on('click', function() {
        if ($('.container-type-input').length > 1) {
            $(this).parents('.container-type-input').remove();
        }
    })

    $('body').on('click', '.dropify-clear', function() {
        var nameInput = $(this).parent().find('input:first').attr('name')
        $(this).parent().find('input[name=delete]').remove()
        $(this).parent().append(`<input type="hidden" name="delete_${nameInput}" value="${nameInput}" />`);
    })


    $('body').on('change, focusout', '.embedLinkYoutube', function(){
        embedLinkYoutube($(this))
    });

    $.each($('.modal'), function(i, value){
        if($(this).find('.modal').length){
            $(this).find('.modal').appendTo("body");
            // $(this).find('.modal').remove()
        }
    })

    $('body').on('focusout', '.ck-editor .ck-editor__editable', function(){
        if(!$(this).find('[data-cke-filler]').length){
            $(this).parent().parent().parent().find('textarea').html($(this).html())
        }
    })

    $('[data-plugins="dropify"]').dropify({
        messages: { default: "Arraste e solte um arquivo aqui ou clique", replace: "Arrastar e solte ou clicar para substituir", remove: "Remover", error: "Ooops, algo errado foi acrescentado." },
        error: { fileSize: "O tamanho do arquivo é muito grande (2M max)." },
    });

    $.each($('.CkEditorColumn'), function(i, value){
        var EHeight = $(this).data('height')

        $(this).addClass($(this).attr('id'))

        if(EHeight){
            $('.ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners').css('height', EHeight)
        }
    })

    $('body').on('click', '.cloneInput', function(){
        var taregtClone = $(this).data('clone-content')
        $(taregtClone).clone().appendTo($(this).parents('#contentInputCloned')).removeAttr('id').addClass('clonedInput');
        $(this).parents('#contentInputCloned').find('>div:last input').val('')
    })
    $('body').on('click', '.deleteCloneInput', function(){
        $(this).parents('.clonedInput').fadeOut('fast', function(){
            $(this).remove()
        })
    })

    $('[data-provide=datepicker]').attr('autocomplete', 'off');
    $('[data-provide=datepicker]').attr('readonly', 'readonly');
    $('[data-provide=datepicker]').on('focus', function(){
        this.removeAttribute('readonly');
    })
})

// $(document).ready(function () {
//     $("#loading-indicator").fadeIn("slow");

//     setTimeout(function () {
//         $("#loading-indicator").fadeOut("slow");
//     }, 1000);
// });
$(window).on('load', function () {
    $("#loading-indicator").fadeOut("slow");
});

$(document).ready(function () {
    $("#loading-indicator").fadeIn("slow");

    // Fallback para garantir que o loading-indicator seja removido
    setTimeout(function() {
        $("#loading-indicator").fadeOut("slow");
    }, 1000);
});




var toolbarOptions = [
    ['bold', 'italic', 'underline'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],      // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],  // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction

    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['image'],                                         // botão para inserir imagem
    ['clean']                                         // remove formatting button
];
var quill = new Quill('#snow-editor', {
    modules: {
        toolbar: toolbarOptions,
    },
    theme: 'snow'
});
// Atualize o valor do input escondido sempre que o conteúdo do editor mudar
quill.on('text-change', function() {
    document.querySelector('input[name="text"]').value = quill.root.innerHTML;
});