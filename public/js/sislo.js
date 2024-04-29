$(document).ready(function () {
    $('.carousel').slick({
        autoplay: true,
        autoplaySpeed: 8000,
        dots: true,
        infinite: true,
        speed: 8000,
        slidesToShow: 1,
        adaptiveHeight: true
    });

    $.ajax({
        type: "POST",
        url: BASE_URL + "ajax_list_notificacao",
        dataType: 'HTML',
        success: function (notifique) {
            document.getElementById("notificacao").innerHTML = notifique;
        }
    });

    const myTimeout = setTimeout(myNotifica, 500000);

    function myNotifica() {
        $.ajax({
            type: "POST",
            url: BASE_URL + "ajax_list_notificacao",
            dataType: 'HTML',
            success: function (notifique) {
                document.getElementById("notificacao").innerHTML = notifique;
            }
        });
    }
});