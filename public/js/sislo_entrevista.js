$(document).ready(function () {
    $('.convert_money').mask('#.##0,00', {reverse: true});

    $("#sislo_vagas_entrevista").validate({
        messages: {
            data_entrevista: {
                required: 'Campo Obrigatório!!!'
            },
            hora_entrevista: {
                required: 'Campo Obrigatório!!!'
            },
            parecer_rh: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            let compareceu_check = $("#compareceu").is(":checked") === true ?
                    1 : 0;
            var compareceu = "&compareceu=" + compareceu_check;

            let resp1_1 = $("#resposta1_1").is(":checked") === true ? 1 : 0;
            var resposta1_1 = "&resposta1_1=" + resp1_1;
            let resp2_1 = $("#resposta2_1").is(":checked") === true ? 1 : 0;
            var resposta2_1 = "&resposta2_1=" + resp2_1;
            let resp3_1 = $("#resposta3_1").is(":checked") === true ? 1 : 0;
            var resposta3_1 = "&resposta3_1=" + resp3_1;
            let resp4_1 = $("#resposta4_1").is(":checked") === true ? 1 : 0;
            var resposta4_1 = "&resposta4_1=" + resp4_1;

            let resp1_2 = $("#resposta1_2").is(":checked") === true ? 1 : 0;
            var resposta1_2 = "&resposta1_2=" + resp1_2;
            let resp2_2 = $("#resposta2_2").is(":checked") === true ? 1 : 0;
            var resposta2_2 = "&resposta2_2=" + resp2_2;
            let resp3_2 = $("#resposta3_2").is(":checked") === true ? 1 : 0;
            var resposta3_2 = "&resposta3_2=" + resp3_2;
            let resp4_2 = $("#resposta4_2").is(":checked") === true ? 1 : 0;
            var resposta4_2 = "&resposta4_2=" + resp4_2;

            let resp1_3 = $("#resposta1_3").is(":checked") === true ? 1 : 0;
            var resposta1_3 = "&resposta1_3=" + resp1_3;
            let resp2_3 = $("#resposta2_3").is(":checked") === true ? 1 : 0;
            var resposta2_3 = "&resposta2_3=" + resp2_3;
            let resp3_3 = $("#resposta3_3").is(":checked") === true ? 1 : 0;
            var resposta3_3 = "&resposta3_3=" + resp3_3;
            let resp4_3 = $("#resposta4_3").is(":checked") === true ? 1 : 0;
            var resposta4_3 = "&resposta4_3=" + resp4_3;

            let resp1_4 = $("#resposta1_4").is(":checked") === true ? 1 : 0;
            var resposta1_4 = "&resposta1_4=" + resp1_4;
            let resp2_4 = $("#resposta2_4").is(":checked") === true ? 1 : 0;
            var resposta2_4 = "&resposta2_4=" + resp2_4;
            let resp3_4 = $("#resposta3_4").is(":checked") === true ? 1 : 0;
            var resposta3_4 = "&resposta3_4=" + resp3_4;
            let resp4_4 = $("#resposta4_4").is(":checked") === true ? 1 : 0;
            var resposta4_4 = "&resposta4_4=" + resp4_4;

            let resp1_5 = $("#resposta1_5").is(":checked") === true ? 1 : 0;
            var resposta1_5 = "&resposta1_5=" + resp1_5;
            let resp2_5 = $("#resposta2_5").is(":checked") === true ? 1 : 0;
            var resposta2_5 = "&resposta2_5=" + resp2_5;
            let resp3_5 = $("#resposta3_5").is(":checked") === true ? 1 : 0;
            var resposta3_5 = "&resposta3_5=" + resp3_5;
            let resp4_5 = $("#resposta4_5").is(":checked") === true ? 1 : 0;
            var resposta4_5 = "&resposta4_5=" + resp4_5;

            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_entrevista",
                dataType: "html",
                data: $(form).serialize() +
                        resposta1_1 + resposta2_1 + resposta3_1 + resposta4_1 +
                        resposta1_2 + resposta2_2 + resposta3_2 + resposta4_2 +
                        resposta1_3 + resposta2_3 + resposta3_3 + resposta4_3 +
                        resposta1_4 + resposta2_4 + resposta3_4 + resposta4_4 +
                        resposta1_5 + resposta2_5 + resposta3_5 + resposta4_5 +
                        compareceu,
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
                    var conteudo = response === '1' ? success_note('Entrevista')
                            + buttonBack('sislo') : error_note('Entrevista')
                            + buttonBack('sislo');
                    $('#sislo_vagas_entrevista')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success', 'Sucesso', 'Dados Salvos!!');
                    } else {
                        alerta('error', 'Aconteceu um erro!',
                                'Tente Novamente!!');
                    }
                    $('html,body').animate(
                            {scrollTop: document.body.scrollHeight},
                            "fast");
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });
});