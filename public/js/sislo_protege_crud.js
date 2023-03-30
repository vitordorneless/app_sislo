$(document).ready(function () {

    $("#sislo_protege_crud").validate({
        messages: {
            fixo: {
                required: 'Campo Obrigatório!!!'
            },
            dependencia: {
                required: 'Campo Obrigatório!!!'
            },
            validade: {
                required: 'Campo Obrigatório!!!'
            },
            jan: {
                required: 'Campo Obrigatório!!!'
            },
            fev: {
                required: 'Campo Obrigatório!!!'
            },
            mar: {
                required: 'Campo Obrigatório!!!'
            },
            abr: {
                required: 'Campo Obrigatório!!!'
            },
            mai: {
                required: 'Campo Obrigatório!!!'
            },
            jun: {
                required: 'Campo Obrigatório!!!'
            },
            jul: {
                required: 'Campo Obrigatório!!!'
            },
            ago: {
                required: 'Campo Obrigatório!!!'
            },
            set: {
                required: 'Campo Obrigatório!!!'
            },
            out: {
                required: 'Campo Obrigatório!!!'
            },
            nov: {
                required: 'Campo Obrigatório!!!'
            },
            dez: {
                required: 'Campo Obrigatório!!!'
            },
            seg: {
                required: 'Campo Obrigatório!!!'
            },
            ter: {
                required: 'Campo Obrigatório!!!'
            },
            qua: {
                required: 'Campo Obrigatório!!!'
            },
            qui: {
                required: 'Campo Obrigatório!!!'
            },
            sex: {
                required: 'Campo Obrigatório!!!'
            },
            sab: {
                required: 'Campo Obrigatório!!!'
            },
            dom: {
                required: 'Campo Obrigatório!!!'
            },
            d01: {
                required: 'Campo Obrigatório!!!'
            },
            d02: {
                required: 'Campo Obrigatório!!!'
            },
            d03: {
                required: 'Campo Obrigatório!!!'
            },
            d04: {
                required: 'Campo Obrigatório!!!'
            },
            d05: {
                required: 'Campo Obrigatório!!!'
            },
            d06: {
                required: 'Campo Obrigatório!!!'
            },
            d07: {
                required: 'Campo Obrigatório!!!'
            },
            d08: {
                required: 'Campo Obrigatório!!!'
            },
            d09: {
                required: 'Campo Obrigatório!!!'
            },
            d10: {
                required: 'Campo Obrigatório!!!'
            },
            d11: {
                required: 'Campo Obrigatório!!!'
            },
            d12: {
                required: 'Campo Obrigatório!!!'
            },
            d13: {
                required: 'Campo Obrigatório!!!'
            },
            d14: {
                required: 'Campo Obrigatório!!!'
            },
            d15: {
                required: 'Campo Obrigatório!!!'
            },
            d16: {
                required: 'Campo Obrigatório!!!'
            },
            d17: {
                required: 'Campo Obrigatório!!!'
            },
            d18: {
                required: 'Campo Obrigatório!!!'
            },
            d19: {
                required: 'Campo Obrigatório!!!'
            },
            d20: {
                required: 'Campo Obrigatório!!!'
            },
            d21: {
                required: 'Campo Obrigatório!!!'
            },
            d22: {
                required: 'Campo Obrigatório!!!'
            },
            d23: {
                required: 'Campo Obrigatório!!!'
            },
            d24: {
                required: 'Campo Obrigatório!!!'
            },
            d25: {
                required: 'Campo Obrigatório!!!'
            },
            d26: {
                required: 'Campo Obrigatório!!!'
            },
            d27: {
                required: 'Campo Obrigatório!!!'
            },
            d28: {
                required: 'Campo Obrigatório!!!'
            },
            d29: {
                required: 'Campo Obrigatório!!!'
            },
            d30: {
                required: 'Campo Obrigatório!!!'
            },
            d31: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_protege",
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
                    var conteudo = response === '1' ? success_note('Arquivo') + buttonBack('protege') : error_note('Arquivo') + buttonBack('protege');
                    $('#sislo_protege_crud')[0].reset();
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