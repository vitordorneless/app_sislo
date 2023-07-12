$(document).ready(function () {
    $("#sislo_item_estoque").validate({
        messages: {            
            item: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_item_estoque",
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
                    var conteudo = response === '1' ? success_note('Estoque') + buttonBack('sislo_item_estoque') : error_note('Estoque') + buttonBack('sislo_item_estoque');
                    $('#sislo_item_estoque')[0].reset();
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