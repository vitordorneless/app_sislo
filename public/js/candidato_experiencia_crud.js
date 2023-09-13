$(document).ready(function () {

    $("#sislo_experiencias").validate({
        messages: {
            nome_empresa: {
                required: 'Campo Obrigatório!!!'
            },
            data_inicial: {
                required: 'Campo Obrigatório!!!'
            },
            cargo: {
                required: 'Campo Obrigatório!!!'
            },
            funcoes: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            let emprego_atual = $("#emprego_atual").is(":checked") === true ? 1 : 0;
            var emprego = "&emprego_atual=" + emprego_atual;
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_experiencia",
                dataType: "html",
                data: $(form).serialize() + emprego,
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
                    var conteudo = response === '1' ? success_note('Experiência') + buttonBack('candidato_experiencia') : error_note('Experiência') + buttonBack('candidato_experiencia');
                    $('#sislo_experiencias')[0].reset();
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