$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});

    $('#extracao').mask('0.000-0');

    $("#total_bilhetes_recibo").focusout(function () {
        total_de_bilhetes();
    });

    $("#valor_liquido_recibo").focusout(function () {
        resumo();
    });

    function resumo() {

        var modalidade = $("#modalidade").val() === 1 ? 4 : 10;
        let total_bilhetes_recibo = $("#total_bilhetes_recibo").val();
        let total_bilhetes = total_bilhetes_recibo * 10;
        var valor_bruto = total_bilhetes * modalidade;
        $("#valor_bruto_liquido").val(parseFloat(valor_bruto));
        var valor_liquido_real = valor_bruto - converter_moeda($("#valor_liquido_recibo").val());
        $("#valor_liquido_real").val(parseFloat(valor_liquido_real));
        $("#lote").focus();
    }

    function total_de_bilhetes() {
        var total_bilhetes_recibo = $("#total_bilhetes_recibo").val();
        let total = total_bilhetes_recibo * 10;
        $("#total_bilhetes_liquido").val(total);
        $("#extracao").focus();
    }

    $("#sislo_loteria_federal").validate({
        messages: {
            total_bilhetes_recibo: {
                required: 'Campo Obrigatório!!!'
            },
            total_bilhetes_liquido: {
                required: 'Campo Obrigatório!!!'
            },
            extracao: {
                required: 'Campo Obrigatório!!!'
            },
            preco_plano: {
                required: 'Campo Obrigatório!!!'
            },
            valor_bruto_recibo: {
                required: 'Campo Obrigatório!!!'
            },
            comissao_recibo: {
                required: 'Campo Obrigatório!!!'
            },
            valor_liquido_recibo: {
                required: 'Campo Obrigatório!!!'
            },
            lote: {
                required: 'Campo Obrigatório!!!'
            },
            caixa: {
                required: 'Campo Obrigatório!!!'
            },
            data_extracao: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_sislo_loteria_federal",
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
                    var conteudo = response === '1' ? success_note('Bilhete Federal') + buttonBack('sislo_loteria_federal') : error_note('Bilhete Federal') + buttonBack('sislo_loteria_federal');
                    $('#sislo_loteria_federal')[0].reset();
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