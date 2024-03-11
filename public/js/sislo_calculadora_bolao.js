$(document).ready(function () {
    
    $('#comissao_desejada').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });
    
    $("#sislo_calculadora_bolao_list").validate({
        messages: {
            data_atual: {
                required: 'Campo Obrigatório!!!'
            },
            cotas: {
                required: 'Campo Obrigatório!!!'
            },
            comissao_desejada: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "ajax_list_calculadora_bolao",
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
                    $("#sominha").val(datas.sominha);
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    $("#table_sislo_calculadora_bolao_list").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data
                    });
                }
            });
            return false;
        }
    });
});