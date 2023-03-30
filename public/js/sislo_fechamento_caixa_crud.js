$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});

    $(".resumo_credito").keyup(function () {
        resumo_TFL();
    });

    $("#total_outros").focusout(function () {
        fechamento();
    });

    $("#caixa_inicial").focusout(function () {
        encerrar();
    });

    function resumo_TFL() {
        var credito = $("#total_credito").val() !== '' ? converter_moeda($("#total_credito").val()) : 0;
        var debito = $("#total_credito").val() !== '' ? converter_moeda($("#total_debito").val()) : 0;
        var total = (credito - debito);
        $("#resumo_tfl").val(parseFloat(total));
    }

    function encerrar() {
        var credito = $("#total_credito").val() !== '' ? converter_moeda($("#total_credito").val()) : 0;
        var debito = $("#total_credito").val() !== '' ? converter_moeda($("#total_debito").val()) : 0;
        var total = (credito - debito);        
        var total_suprimento = $("#total_suprimento").val() !== '' ? converter_moeda($("#total_suprimento").val()) : 0;
        var total_moedas = $("#total_moedas").val() !== '' ? converter_moeda($("#total_moedas").val()) : 0;
        var total_dinheiro = $("#total_dinheiro").val() !== '' ? converter_moeda($("#total_dinheiro").val()) : 0;
        var total_bolao = $("#total_bolao").val() !== '' ? converter_moeda($("#total_bolao").val()) : 0;
        var total_telesena = $("#total_telesena").val() !== '' ? converter_moeda($("#total_telesena").val()) : 0;
        var total_bilhete_federal = $("#total_bilhete_federal").val() !== '' ? converter_moeda($("#total_bilhete_federal").val()) : 0;
        var total_sangrias = $("#total_sangrias").val() !== '' ? converter_moeda($("#total_sangrias").val()) : 0;
        var total_sobra_cx = $("#total_sobra_cx").val() !== '' ? converter_moeda($("#total_sobra_cx").val()) : 0;
        var total_pix = $("#total_pix").val() !== '' ? converter_moeda($("#total_pix").val()) : 0;
        var caixa_inicial = $("#caixa_inicial").val() !== '' ? converter_moeda($("#caixa_inicial").val()) : 0;
        var resumo_tfl = total;
        var total_brinde = $("#total_brinde").val() !== '' ? converter_moeda($("#total_brinde").val()) : 0;
        var total_outros = $("#total_outros").val() !== '' ? converter_moeda($("#total_outros").val()) : 0;
        var dinheiro = 0;
        var excedente = 0;
        var diferenca = 0;
        var soma_geral = 0;
        var sup_caixa = 0;
        dinheiro = parseFloat(total_moedas) + parseFloat(total_dinheiro) + parseFloat(total_bolao) + parseFloat(total_telesena) + parseFloat(total_bilhete_federal);
        excedente = parseFloat(total_sangrias) + parseFloat(total_sobra_cx) + parseFloat(total_brinde) + parseFloat(total_outros) + parseFloat(total_pix);
        sup_caixa = parseFloat(caixa_inicial) + parseFloat(total_suprimento);
        soma_geral = (parseFloat(dinheiro) + parseFloat(excedente)) - parseFloat(sup_caixa);
        diferenca = (soma_geral - resumo_tfl);
        $("#soma_geral").val(parseFloat(soma_geral));
        $("#diferenca").val(diferenca);
    }

    function fechamento() {
        var total_brinde = $("#total_brinde").val();
        var total_outros = $("#total_outros").val();

        if (!total_brinde) {
            $("#obs_brinde").val("sem dados");
        }

        if (!total_outros) {
            $("#obs_outros").val("sem dados");
        }
    }

    $("#sislo_fechamento_caixa").validate({
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
                url: BASE_URL + "sislo_fechamento_caixa",
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
                    var conteudo = response === '1' ? success_note('Fechamento de Caixa') + buttonBack('sislo_fechamentos') : error_note('Fechamento de Caixa') + buttonBack('sislo_fechamentos');
                    $('#sislo_fechamento_caixa')[0].reset();
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