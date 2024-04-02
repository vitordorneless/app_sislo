$(function () {
    $("#login_form").submit(function () {
        $.ajax({
            type: "POST",
            url: BASE_URL + "ajax_login",
            dataType: 'JSON',
            data: $(this).serialize(),
            beforeSend: function (a) {
                clearErrors();
                $(".help-block").html(loadingImg("Processando..."));
            },
            success: function (json) {
                if (json["status"]) {
                    $(".help-block").html(loadingImg("Logando..."));
                    window.location = BASE_URL + "sislo";
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