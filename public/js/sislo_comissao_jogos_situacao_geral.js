$(document).ready(function () {
    $("#sislo_situacao_jogos_geral").validate({
        messages: {
            mes: {
                required: 'Campo Obrigatório!!!'
            },
            ano: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "ajax_table_sislo_situacao_jogos_geral",
                dataType: "json",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#antes").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.table(e);
                    alerta('error', e, e);
                },
                success: function (datas) {
                    clearErrors();
                    $("#antes").empty();
                    
                    $("#comissao_jogos").html(datas.comissao_jogos);
                    $("#comissao_bolao").html(datas.comissao_bolao);
                    $("#comissao_jogos_silce").html(datas.comissao_jogos_silce);
                    $("#comissao_jogos_ibc").html(datas.comissao_jogos_ibc);
                    $("#total_jogos").html(datas.total_jogos);
                    $("#total_silce").html(datas.total_silce);
                    $("#premios_pagos").html(datas.premios_pagos);
                    
                    //$('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    
                    $("#table_sislo_situacao_jogos_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data_jogos
                    });
                    
                    $("#table_sislo_situacao_bolao_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data_bolao
                    });
                    
                    $("#table_sislo_situacao_jogos_silce_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data_silce
                    });

                    $("#table_sislo_situacao_jogos_ibc_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data_ibc
                    });
                    
                    $("#table_sislo_premios_pagos").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data_premios_pagos
                    });
                }
            });
            return false;
        }
    });
});