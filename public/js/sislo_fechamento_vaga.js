$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});
    
    $("#table_sislo_candidatos").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "order": [[1, 'desc']]
        "ordering": true        
    });

    $("#sislo_vagas").validate({
        messages: {
            cargo: {
                required: 'Campo Obrigatório!!!'
            },
            data_publicacao: {
                required: 'Campo Obrigatório!!!'
            },
            data_limite: {
                required: 'Campo Obrigatório!!!'
            },
            salario: {
                required: 'Campo Obrigatório!!!'
            },
            carga_horaria: {
                required: 'Campo Obrigatório!!!'
            },
            forma_contratacao: {
                required: 'Campo Obrigatório!!!'
            },
            requisitos: {
                required: 'Campo Obrigatório!!!'
            },
            responsabilidades: {
                required: 'Campo Obrigatório!!!'
            },
            diferenciais: {
                required: 'Campo Obrigatório!!!'
            },
            beneficios: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            let vaga_promovida_check = $("#vaga_promovida").is(":checked") === true ? 1 : 0;
            var vaga_promovida = "&vaga_promovida=" + vaga_promovida_check;
            $.ajax({
                type: "POST",
                url: BASE_URL + "salva_vaga_empresa",
                dataType: "html",
                data: $(form).serialize() + vaga_promovida,
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
                    var conteudo = response === '1' ? success_note('Vaga') + buttonBack('empresa_vagas') : error_note('Vaga') + buttonBack('empresa_vagas');
                    $('#sislo_vagas')[0].reset();
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