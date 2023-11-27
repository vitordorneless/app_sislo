$(document).ready(function () {

    $("#sislo_stars").validate({
        messages: {
            pergunta: {
                required: 'Campo Obrigatório!!!'
            },
            resposta_1: {
                required: 'Campo Obrigatório!!!'
            },
            pontuacao_1: {
                required: 'Campo Obrigatório!!!'
            },
            resposta_2: {
                required: 'Campo Obrigatório!!!'
            },
            pontuacao_2: {
                required: 'Campo Obrigatório!!!'
            },
            resposta_3: {
                required: 'Campo Obrigatório!!!'
            },
            pontuacao_3: {
                required: 'Campo Obrigatório!!!'
            },
            resposta_4: {
                required: 'Campo Obrigatório!!!'
            },
            pontuacao_4: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_star_metodo",
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
                    var conteudo = response === '1' ? success_note('Método Star') + buttonBack('sislo_star') : error_note('Método Star') + buttonBack('sislo_star');
                    $('#sislo_stars')[0].reset();
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