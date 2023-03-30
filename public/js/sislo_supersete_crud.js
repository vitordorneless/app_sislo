$(document).ready(function () {
    $('.convert_money').mask('#.##0,00', {reverse: true});

    $("#sislo_supersete").validate({
        messages: {
            concurso: {
                required: 'Campo Obrigatório!!!'
            },
            data_concurso: {
                required: 'Campo Obrigatório!!!'
            },
            dez_01: {
                required: 'Campo Obrigatório!!!'
            },
            dez_02: {
                required: 'Campo Obrigatório!!!'
            },
            dez_03: {
                required: 'Campo Obrigatório!!!'
            },
            dez_04: {
                required: 'Campo Obrigatório!!!'
            },
            dez_05: {
                required: 'Campo Obrigatório!!!'
            },
            dez_06: {
                required: 'Campo Obrigatório!!!'
            },
            dez_07: {
                required: 'Campo Obrigatório!!!'
            },
            saiu_ganhador: {
                required: 'Campo Obrigatório!!!'
            },
            premio_atual: {
                required: 'Campo Obrigatório!!!'
            },
            premio_acumulado: {
                required: 'Campo Obrigatório!!!'
            },
            arrecadacao_total: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_sislo_supersete",
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
                    var conteudo = response === '1' ? success_note('Super Sete') + buttonBack('sislo_supersete') : error_note('Super Sete') + buttonBack('sislo_supersete');
                    $('#sislo_supersete')[0].reset();
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