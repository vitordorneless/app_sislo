$(function () {

    $("#table_horass").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,
        "searching": true,
        "ordering": true,
        "ajax": {
            "url": BASE_URL + "ajax_list_horas",
            "type": "POST"
        }
    });

});

function ponto(evento) {

    $.ajax({
        type: "POST",
        url: BASE_URL + "salva_sislo_horas",
        dataType: "html",
        data: "evento=" + evento,
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
            var conteudo = response === '1' ? success_note('Ponto Registrado') + buttonBack('sislo_horas') : error_note('Ponto Registrado') + buttonBack('sislo_horas');
            $("#conteudo").empty();
            if (response === '1') {
                alerta('success', 'Sucesso', 'Dados Salvos!!');
            } else {
                alerta('error', 'Aconteceu um erro!', 'Tente Novamente!!');
            }
            $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
            $('#table_horass').DataTable().ajax.reload();
            $("#conteudo").html(conteudo);
        }
    });
}

$("#entrada").click(function (event) {
    event.preventDefault();
    var evento = 1;
    ponto(evento);
});
$("#intervalo").click(function (event) {
    event.preventDefault();
    var evento = 2;
    ponto(evento);
});
$("#retorno").click(function (event) {
    event.preventDefault();
    var evento = 3;
    ponto(evento);
});
$("#saida").click(function (event) {
    event.preventDefault();
    var evento = 4;
    ponto(evento);
});