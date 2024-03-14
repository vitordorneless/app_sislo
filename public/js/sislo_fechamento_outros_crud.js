$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});

    $("#sislo_fechamento_outros").validate({
        messages: {
            data_fechamento: {
                required: 'Campo Obrigatório!!!'
            },
            total_credito: {
                required: 'Campo Obrigatório!!!'
            },
            total_debito: {
                required: 'Campo Obrigatório!!!'
            },
            caixa_inicial: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_fechamento_outros_form",
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
                    var conteudo = response === '1' ? success_note('Concluída a Liquidação') + buttonBack('sislo_fechamentos_outros') : error_note('Concluída a Liquidação') + buttonBack('sislo_fechamentos_outros');                    
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