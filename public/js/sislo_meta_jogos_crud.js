$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});    

    $("#sislo_meta_jogos").validate({
        messages: {
            ano: {
                required: 'Campo Obrigatório!!!'
            },
            janeiro: {
                required: 'Campo Obrigatório!!!'
            },
            fevereiro: {
                required: 'Campo Obrigatório!!!'
            },
            marco: {
                required: 'Campo Obrigatório!!!'
            },
            abril: {
                required: 'Campo Obrigatório!!!'
            },
            maio: {
                required: 'Campo Obrigatório!!!'
            },
            junho: {
                required: 'Campo Obrigatório!!!'
            },
            julho: {
                required: 'Campo Obrigatório!!!'
            },
            agosto: {
                required: 'Campo Obrigatório!!!'
            },
            setembro: {
                required: 'Campo Obrigatório!!!'
            },
            outubro: {
                required: 'Campo Obrigatório!!!'
            },
            novembro: {
                required: 'Campo Obrigatório!!!'
            },
            dezembro: {
                required: 'Campo Obrigatório!!!'
            },
            janeiro_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            fevereiro_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            marco_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            abril_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            maio_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            junho_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            julho_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            agosto_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            setembro_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            outubro_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            novembro_bolao: {
                required: 'Campo Obrigatório!!!'
            },
            dezembro_bolao: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_meta_jogos",
                dataType: "html",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#conteudo").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.log(e);
                    alerta('error', e, e);
                },
                success: function (response) {
                    clearErrors();
                    var conteudo = response === '1' ? success_note('Metas') + buttonBack('sislo_metas_jogos') : error_note('Metas') + buttonBack('sislo_metas_jogos');
                    $('#sislo_meta_jogos')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success', 'Sucesso', 'Dados Salvos!!');
                    } else {
                        alerta('error', 'Aconteceu um erro!', 'Tente Novamente!!');
                    }
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });

});