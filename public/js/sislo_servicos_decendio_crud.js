$(document).ready(function () {

    $(".addline").click(function () {
        var novo;
        novo = $("tr.theline:first").clone();
        novo.find("input").val("");
        novo.insertAfter("tr.theline:last");
    });

    $(".addlineremove").click(function () {
        $("tr.theline:last").remove();
    });

    $("#sislo_dec_servicos").validate({
        messages: {
            id_sislo_tipo_servico: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "ajax_save_form_dec_servicos",
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
                    var conteudo = response === '1' ? success_note('Serviços de Decêndio Cadastrados') + buttonBack('servicos_decendio') : error_note('Serviços de Decêndio Cadastrados') + buttonBack('servicos_decendio');
                    $('#sislo_dec_servicos')[0].reset();
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