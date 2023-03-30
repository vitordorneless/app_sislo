$(document).ready(function () {

    $('#valor_linha1').mask('#.##0,00', {reverse: true});
    $('#valor_linha2').mask('#.##0,00', {reverse: true});
    $('#valor_linha3').mask('#.##0,00', {reverse: true});
    $('#valor_linha1').mask('#.##0,00', {reverse: true});
    $('#valor_linha2').mask('#.##0,00', {reverse: true});
    $('#valor_linha3').mask('#.##0,00', {reverse: true});
    $('#salario').mask('#.##0,00', {reverse: true});
    $('#adicional').mask('#.##0,00', {reverse: true});
    $('#insalubridade').mask('#.##0,00', {reverse: true});
    $('#tel1').mask('00 0000-0000');
    $('#tel2').mask('00 0 0000-0000');
    $('#tel3').mask('00 0 0000-0000');
    $('#insalubridade_percent').mask('0,00%');
    $('#entrada').mask('00:00');
    $('#almoco').mask('00:00');
    $('#volta_almoco').mask('00:00');
    $('#saida').mask('00:00');

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
    
    $("#sislo_colaboradores").validate({
        messages: {
            cod_loterico: {
                required: 'Campo Obrigatório!!!'
            },
            nome: {
                required: 'Campo Obrigatório!!!'
            },
            cpf: {
                required: 'Campo Obrigatório!!!'
            },
            nascimento: {
                required: 'Campo Obrigatório!!!'
            },
            local_nascimento: {
                required: 'Campo Obrigatório!!!'
            },
            pis: {
                required: 'Campo Obrigatório!!!'
            },
            identidade: {
                required: 'Campo Obrigatório!!!'
            },
            orgao_emissor: {
                required: 'Campo Obrigatório!!!'
            },
            identidade_emissao: {
                required: 'Campo Obrigatório!!!'
            },
            nome_mae: {
                required: 'Campo Obrigatório!!!'
            },
            ctps: {
                required: 'Campo Obrigatório!!!'
            },
            serie: {
                required: 'Campo Obrigatório!!!'
            },
            ctps_emissao: {
                required: 'Campo Obrigatório!!!'
            },
            titulo_eleitor: {
                required: 'Campo Obrigatório!!!'
            },
            zona: {
                required: 'Campo Obrigatório!!!'
            },
            secao: {
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
            bairro: {
                required: 'Campo Obrigatório!!!'
            },
            cidade: {
                required: 'Campo Obrigatório!!!'
            },
            uf: {
                required: 'Campo Obrigatório!!!'
            },
            tel2: {
                required: 'Campo Obrigatório!!!'
            },
            linha1: {
                required: 'Campo Obrigatório!!!'
            },
            valor_linha1: {
                required: 'Campo Obrigatório!!!'
            },
            admissao: {
                required: 'Campo Obrigatório!!!'
            },
            salario: {
                required: 'Campo Obrigatório!!!'
            },
            entrada: {
                required: 'Campo Obrigatório!!!'
            },
            almoco: {
                required: 'Campo Obrigatório!!!'
            },
            volta_almoco: {
                required: 'Campo Obrigatório!!!'
            },
            saida: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_funcionarios",
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
                    var conteudo = response === '1' ? success_note('Colaborador') + buttonBack('sislo_funcionarios') : error_note('Colaborador') + buttonBack('sislo_funcionarios');
                    $('#sislo_colaboradores')[0].reset();
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