$(document).ready(function () {
    $('#cnpj').mask('00.000.000.0000/00');
    $('#whats').mask('00-00000-0000');
    $('#tel').mask('00-00000-0000');
    $("#sislo_fornecedores").validate({
        messages: {
            cod_loterico: {
                required: 'Campo Obrigatório!!!'
            },
            nome: {
                required: 'Campo Obrigatório!!!'
            },
            cnpj: {
                required: 'Campo Obrigatório!!!'
            },
            contato: {
                required: 'Campo Obrigatório!!!'
            },
            whats: {
                required: 'Campo Obrigatório!!!'
            },
            email: {
                required: 'Campo Obrigatório!!!'
            },
            tel: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_fornecedores",
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
                    var conteudo = response === '1' ? success_note('Fornecedor') + buttonBack('sislo_fornecedores') : error_note('Fornecedor') + buttonBack('sislo_fornecedores');
                    $('#sislo_fornecedores')[0].reset();
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