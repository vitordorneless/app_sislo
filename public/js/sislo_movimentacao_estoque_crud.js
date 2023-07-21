$(document).ready(function () {
    $("#sislo_movimentacao_estoques").validate({
        messages: {
            quantidade_saida: {
                required: 'Campo Obrigatório!!!'
            },
            id_sislo_tfl: {
                required: 'Campo Obrigatório!!!'
            },
            externo: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_movimentacao_estoque",
                dataType: "html",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#conteudo").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.log(e);
                },
                success: function (response) {
                    clearErrors();
                    var conteudo = response === '1' ? success_note('Estoque') + buttonBack('sislo_movimentacao_estoque') : error_note('Estoque') + buttonBack('sislo_movimentacao_estoque');
                    $('#sislo_movimentacao_estoques')[0].reset();
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