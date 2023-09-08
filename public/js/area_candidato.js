$(function () {
    $("#login_candidato_form").submit(function () {
        $.ajax({
            type: "POST",
            url: BASE_URL + "ajax_login_candidato",
            dataType: 'JSON',
            data: $(this).serialize(),
            beforeSend: function () {
                clearErrors();                
                $(".help-block").html(loadingImg("Processando..."));
            },
            success: function (json) {
                if (json["status"]) {
                    $(".help-block").html(loadingImg("Logando..."));
                    window.location = BASE_URL + "area_candidato_logado";
                } else {                    
                    $(".help-block").html(json['error_list']);
                }
            },
            error: function (response) {
                clearErrors();
                console.log(response);
            }
        });
        return false;
    });
});