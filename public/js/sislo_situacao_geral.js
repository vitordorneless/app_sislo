$(document).ready(function () {
    $("#sislo_situacao_geral").validate({
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
                url: BASE_URL + "ajax_sislo_situacao_geral",
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
                    $("#comissao_bilhete_federal").html(datas.comissao_bilhete_federal);
                    $("#total_jogos").html(datas.total_jogos);
                    $("#total_silce").html(datas.total_silce);
                    $("#premios_pagos").html(datas.premios_pagos);
                    $("#bobinas").html(datas.bobinas);
                    $("#nao_jogos").html(datas.nao_jogos);
                    $("#contas_pagar").html(datas.contas_pagar);
                    $("#salarios").html(datas.salarios);
                    $("#caixas").html(datas.caixas);
                    $("#total_todos_jogos").html(datas.total_todos_jogos);
                    $("#total_todos_nao_jogos").html(datas.total_todos_nao_jogos);
                    $("#total_todos_deveres").html(datas.total_todos_deveres);
                    $("#total_todos_situacao").html(datas.total_todos_situacao);

                    $("#total_meta_nao_jogos").html(datas.total_meta_nao_jogos);
                    $("#total_meta_jogos").html(datas.total_meta_jogos);
                    $("#total_todas_metas").html(datas.total_todas_metas);
                    $("#total_metas_atingido").html(datas.total_metas_atingido);

                    //$('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");

                    $("#table_sislo_situacao_jogos_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[4, 'desc']],
                        data: datas.data_jogos
                    });

                    $("#table_sislo_contas_pagar").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data_contas_pagar
                    });

                    $("#table_sislo_salarios").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[3, 'desc']],
                        data: datas.data_salarios
                    });

                    $("#table_sislo_caixas").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[2, 'desc']],
                        data: datas.data_caixas
                    });

                    $("#table_sislo_nao_jogos").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[3, 'desc']],
                        data: datas.data_nao_jogos
                    });

                    $("#table_sislo_situacao_bolao_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        order: [[4, 'desc']],
                        data: datas.data_bolao
                    });

                    $("#table_sislo_situacao_jogos_silce_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[3, 'desc']],
                        data: datas.data_silce
                    });

                    $("#table_sislo_situacao_jogos_ibc_geral").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[3, 'desc']],
                        data: datas.data_ibc
                    });

                    $("#table_sislo_bilhete_federal").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[3, 'desc']],
                        data: datas.data_bilhete_federal
                    });

                    $("#table_sislo_premios_pagos").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        order: [[3, 'desc']],
                        data: datas.data_premios_pagos
                    });
                }
            });
            return false;
        }
    });
});