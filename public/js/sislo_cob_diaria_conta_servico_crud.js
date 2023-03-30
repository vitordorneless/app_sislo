$(document).ready(function () {
    $('#referencia').mask('00/0000');
    $('#valor').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $(".addline").click(function () {
        var novo;
        novo = $("tr.theline:first").clone();
        novo.find("input").val("");
        novo.insertAfter("tr.theline:last");
        initMaskMoney('input[id="valor"]');
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

    $("#sislo_cob_diaria_conta_servicos").validate({
        messages: {
            data_inicial: {
                required: 'Campo Obrigatório!!!'
            },
            data_final: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_cob_diaria_conta_servico_form",
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
                    var conteudo = response === '1' ? success_note('Relatório') + buttonBack('sislo_cob_diaria_conta_servico') : error_note('Relatório') + buttonBack('sislo_cob_diaria_conta_servico');
                    $('#sislo_cob_diaria_conta_servicos')[0].reset();
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