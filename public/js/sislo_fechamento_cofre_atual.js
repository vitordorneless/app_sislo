$(document).ready(function () {

    $('#acumulado_comissao').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });
    $('#comissao').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });
    $('#pag_lot_fed').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });
    $('#pag_telesena').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });
    $('#pag_outros').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $("#sislo_fechamento_cofre").validate({
        messages: {
            os_gtv: {
                required: 'Campo Obrigatório!!!'
            },
            guia_gtv: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_fechamento_cofre_novo_execute_atual",
                dataType: "HTML",
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
                    var conteudo = response === 1 ? success_note('Fechamento de Cofre') + buttonBack('sislo') : error_note('Fechamento de Cofre') + buttonBack('sislo');
                    $('#sislo_fechamento_cofre')[0].reset();
                    $("#conteudo").empty();
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });

});