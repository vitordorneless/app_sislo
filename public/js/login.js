$(function () {
    var navegador_chrome = navigator.appVersion.includes("Chrome");
    var navegador_IE11 = navigator.appVersion.includes("IE11");
    var navegador_Opera = navigator.appVersion.includes("Opera");
    var navegador_Safari = navigator.appVersion.includes("Safari");
    var navegador_Edg = navigator.appVersion.includes("Edg");

    if (navegador_chrome === true && navegador_Safari === true && navegador_Edg === true) {
        var baseurl = '';
    } else {
        var baseurl = BASE_URL;
    }

    $("#login_form").submit(function () {
        $.ajax({
            type: "POST",
            url: baseurl + "ajax_login",
            dataType: 'JSON',
            data: $(this).serialize(),
            beforeSend: function (a) {
                clearErrors();
                $(".help-block").html(loadingImg("Processando..."));
                console.log('passei no before');
                console.log('variavel tratada ficou assim ' + baseurl);
            },
            success: function (json) {
                if (json["status"]) {
                    $(".help-block").html(loadingImg("Logando..."));
                    window.location = baseurl + "sislo";
                } else {
                    console.log('passei no else');
                    $(".help-block").html(json['error_list']);
                }
            },
            error: function (response) {
                clearErrors();
                console.log(response);
                console.log('passei no error');
            }
        });
        return false;
    });
});