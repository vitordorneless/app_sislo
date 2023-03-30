$(document).ready(function () {
    $("#sislo_usuarios").validate({
        messages: {
            sislo_id_loterica: {
                required: 'Campo Obrigatório!!!'
            },
            sislo_login: {
                required: 'Campo Obrigatório!!!'
            },
            sislo_nome: {
                required: 'Campo Obrigatório!!!'
            },
            sislo_email: {
                required: 'Campo Obrigatório!!!'
            },
            sislo_pass: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_usuarios",
                dataType: "html",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#conteudo").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.log(e);
                },
                success: function (response) {
                    clearErrors();
                    var conteudo = response === '1' ? success_note('Usuario') + buttonBack('sislo_usuarios') : error_note('Usuario') + buttonBack('sislo_usuarios');
                    $('#sislo_usuarios')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success','Sucesso','Dados Salvos!!');                                                
                    } else {
                        alerta('error','Aconteceu um erro!','Tente Novamente!!');
                    }
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });
});