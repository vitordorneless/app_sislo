$(document).ready(function () {
    $("#sislo_tfl").validate({
        messages: {
            cod_loterico: {
                required: 'Campo Obrigatório!!!'
            },
            terminal: {
                required: 'Campo Obrigatório!!!'
            },
            caixa_numero: {
                required: 'Campo Obrigatório!!!'
            },
            serie: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_tfl",
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
                    var conteudo = response === '1' ? success_note('TFL') + buttonBack('sislo_tfl') : error_note('TFL') + buttonBack('sislo_tfl');
                    $('#sislo_tfl')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success','Sucesso','Dados Salvos!!');                        
                    } else {
                        alerta('error','Aconteceu um erro!','Tente Novamente!!');                        
                    }
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });
});