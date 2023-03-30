$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});    

    $("#numerario_02").focusout(function () {
        fechamento();
    });        
    $("#numerario_05").focusout(function () {
        fechamento();
    });        
    $("#numerario_10").focusout(function () {
        fechamento();
    });        
    $("#numerario_20").focusout(function () {
        fechamento();
    });        
    $("#numerario_50").focusout(function () {
        fechamento();
    });        
    $("#numerario_100").focusout(function () {
        fechamento();
    });        
    $("#numerario_200").focusout(function () {
        fechamento();
    });        

    function fechamento() {
        var numerario_02 = $("#numerario_02").val() !== '' ? ($("#numerario_02").val() * 2) : 0;
        var numerario_05 = $("#numerario_05").val() !== '' ? ($("#numerario_05").val() * 5) : 0;
        var numerario_10 = $("#numerario_10").val() !== '' ? ($("#numerario_10").val() * 10) : 0;
        var numerario_20 = $("#numerario_20").val() !== '' ? ($("#numerario_20").val() * 20) : 0;
        var numerario_50 = $("#numerario_50").val() !== '' ? ($("#numerario_50").val() * 50) : 0;
        var numerario_100 = $("#numerario_100").val() !== '' ? ($("#numerario_100").val() * 100) : 0;
        var numerario_200 = $("#numerario_200").val() !== '' ? ($("#numerario_200").val() * 200) : 0;                
        var soma_geral = numerario_02 + numerario_05 + numerario_10 + numerario_20 + numerario_50 + numerario_100 + numerario_200;
        $("#valor").val(parseFloat(soma_geral));        
    }    

    $("#sislo_sangria_crud").validate({
        messages: {
            data_registro: {
                required: 'Campo Obrigatório!!!'
            },
            data_coleta: {
                required: 'Campo Obrigatório!!!'
            },
            valor: {
                required: 'Campo Obrigatório!!!'
            },
            num_controle: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_sangria",
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
                    var conteudo = response === '1' ? success_note('Sangria') + buttonBack('sislo_sangrias') : error_note('Sangria') + buttonBack('sislo_sangrias');
                    $('#sislo_sangria_crud')[0].reset();
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