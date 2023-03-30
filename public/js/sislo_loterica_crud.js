$(document).ready(function () {

    function limpa_formulario_cep() {
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }

    $("#cep").blur(function () {

        var cep = $(this).val().replace(/\D/g, '');

        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                $("#logradouro").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                    } else {
                        limpa_formulario_cep();                        
                        alerta('error','Aconteceu um erro!','CEP não encontrado.');                        
                        $("#cep").focus();
                    }
                });
            } else {
                limpa_formulario_cep();
                alerta('error','Aconteceu um erro!','Formato de CEP inválido.');                
                $("#cep").focus();
            }
        } else {
            limpa_formulario_cep();
        }
    });

    $("#sislo_lotericas").validate({
        messages: {
            razao_social: {
                required: 'Campo Obrigatório!!!'
            },
            cnpj: {
                required: 'Campo Obrigatório!!!'
            },
            cod_loterico: {
                required: 'Campo Obrigatório!!!'
            },
            nome_fantasia: {
                required: 'Campo Obrigatório!!!'
            },
            cep: {
                required: 'Campo Obrigatório!!!'
            },
            logradouro: {
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
            },
            email: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_lotericas",
                dataType: "html",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#conteudo").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.log(e);
                    alerta('error',e,e);   
                },
                success: function (response) {
                    clearErrors();
                    var conteudo = response === '1' ? success_note('Loterica') + buttonBack('lotericas') : error_note('Loterica') + buttonBack('lotericas');
                    $('#sislo_lotericas')[0].reset();
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