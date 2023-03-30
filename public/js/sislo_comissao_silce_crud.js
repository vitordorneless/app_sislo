$(document).ready(function () {
    $('#referencia').mask('00/0000');
    $('#comissao').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });
    $('#comissao_total').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $(".addline").click(function () {
        var novo;
        novo = $("tr.theline:first").clone();
        novo.find("input").val("");
        novo.find("input").val("");
        novo.insertAfter("tr.theline:last");
        initMaskMoney('input[id="comissao"]');
        initMaskMoney('input[id="comissao_total"]');
    });

    $(".addlineremove").click(function () {
        $("tr.theline:last").remove();        
    });

    function initMaskMoney(selector) {
        $(selector).maskMoney({
            alloNegative: true,
            thousands: ".",
            decimal: ",",
            precision: 2
        });
    }

    $("#sislo_comissao_jogos_silce_loterias").validate({
        messages: {
            referencia: {
                required: 'Campo Obrigatório!!!'
            },
            dia_inicial: {
                required: 'Campo Obrigatório!!!'
            },
            dia_final: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_comissao_jogos_silce_loterias_form",
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
                    var conteudo = response === '1' ? success_note('Comissão de jogos') + buttonBack('sislo_comissao_silce') : error_note('Comissão de jogos') + buttonBack('sislo_comissao_silce');
                    $('#sislo_comissao_jogos_silce_loterias')[0].reset();
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