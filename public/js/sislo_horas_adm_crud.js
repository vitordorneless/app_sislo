$(document).ready(function () {
    $('#entrada').mask('00:00');
    $('#ida_almoco').mask('00:00');
    $('#volta_almoco').mask('00:00');
    $('#saida').mask('00:00');

    $("#sislo_ajuste_horas").validate({
        messages: {
            data_ponto: {
                required: 'Campo Obrigatório!!!'
            },
            entrada: {
                required: 'Campo Obrigatório!!!'
            },
            ida_almoco: {
                required: 'Campo Obrigatório!!!'
            },
            volta_almoco: {
                required: 'Campo Obrigatório!!!'
            },
            saida: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_ajustahora",
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
                    var conteudo = response === '1' ? success_note('Horas') + buttonBack('ajax_list_ajuste_horas') : error_note('Horas') + buttonBack('ajax_list_ajuste_horas');
                    $('#sislo_ajuste_horas')[0].reset();
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