$(document).ready(function () {
    
    $('#valor_global').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $("#sislo_convenios").validate({
        messages: {
            convenio: {
                required: 'Campo Obrigatório!!!'
            },
            valor_global: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_tipos_convenio",
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
                    var conteudo = response === '1' ? success_note('Convênio') + buttonBack('tipos_convenio') : error_note('Convênio') + buttonBack('tipos_convenio');
                    $('#sislo_convenios')[0].reset();
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