$(document).ready(function () {

    $("#sislo_pecs").validate({
        messages: {
            id_sislo_tipo_pec: {
                required: 'Campo Obrigatório!!!'
            },
            id_sislo_op_entrada: {
                required: 'Campo Obrigatório!!!'
            },
            nome_convenio: {
                required: 'Campo Obrigatório!!!'
            },
            convenio: {
                required: 'Campo Obrigatório!!!'
            },
            id_sislo_pec_destinacao: {
                required: 'Campo Obrigatório!!!'
            },
            id_sislo_pec_identificador: {
                required: 'Campo Obrigatório!!!'
            },
            vigencia: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_pec",
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
                    var conteudo = response === '1' ? success_note('PEC') + buttonBack('sislo_pec') : error_note('PEC') + buttonBack('sislo_pec');
                    $('#sislo_pecs')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success', 'Sucesso', 'Dados Salvos!!');
                    } else {
                        alerta('error', 'Aconteceu um erro!', 'Tente Novamente!!');
                    }
                    $("#conteudo").html(conteudo);
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");                    
                }
            });
            return false;
        }
    });
});