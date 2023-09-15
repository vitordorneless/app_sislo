$(document).ready(function () {

    function limpa_formulario_cep() {
        $("#endereco").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }

    $("#cep").blur(function () {

        var cep = $(this).val().replace(/\D/g, '');

        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                $("#endereco").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        $("#endereco").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                    } else {
                        limpa_formulario_cep();
                        alerta('error', 'Aconteceu um erro!', 'CEP não encontrado.');
                        $("#cep").focus();
                    }
                });
            } else {
                limpa_formulario_cep();
                alerta('error', 'Aconteceu um erro!', 'Formato de CEP inválido.');
                $("#cep").focus();
            }
        } else {
            limpa_formulario_cep();
        }
    });

    $("#sislo_empresa").validate({
        messages: {
            cod_loterico: {
                required: 'Campo Obrigatório!!!'
            },
            nome_fantasia: {
                required: 'Campo Obrigatório!!!'
            },
            razao_social: {
                required: 'Campo Obrigatório!!!'
            },
            cnpj: {
                required: 'Campo Obrigatório!!!'
            },
            tel1: {
                required: 'Campo Obrigatório!!!'
            },
            tel2: {
                required: 'Campo Obrigatório!!!'
            },
            tel3: {
                required: 'Campo Obrigatório!!!'
            },
            whatsapp: {
                required: 'Campo Obrigatório!!!'
            },
            email: {
                required: 'Campo Obrigatório!!!'
            },
            cep: {
                required: 'Campo Obrigatório!!!'
            },
            endereco: {
                required: 'Campo Obrigatório!!!'
            },
            numero: {
                required: 'Campo Obrigatório!!!'
            },
            complemento: {
                required: 'Campo Obrigatório!!!'
            },
            bairro: {
                required: 'Campo Obrigatório!!!'
            },
            cidade: {
                required: 'Campo Obrigatório!!!'
            },
            uf: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_empresa",
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
                    var conteudo = response === '1' ? success_note('Empresa, \n\
clique em Área da Empresa para cadastrar suas vagas!!<br>Sua senha inicial \n\
é 102030')
                            + buttonBack('sislo') : error_note('Empresa')
                            + buttonBack('sislo');
                    $('#sislo_empresa')[0].reset();
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