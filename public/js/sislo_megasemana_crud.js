$(document).ready(function () {

    $("#sislo_megasemana").validate({
        messages: {
            campanha: {
                required: 'Campo Obrigatório!!!'
            },
            ano_referencia: {
                required: 'Campo Obrigatório!!!'
            },
            dia_01: {
                required: 'Campo Obrigatório!!!'
            },
            dia_02: {
                required: 'Campo Obrigatório!!!'
            },
            dia_03: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_sislo_megasemana",
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
                    var conteudo = response === '1' ? success_note('MEGA Semana') + buttonBack('sislo_mega_semana') : error_note('MEGA Semana') + buttonBack('sislo_mega_semana');
                    $('#sislo_megasemana')[0].reset();
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