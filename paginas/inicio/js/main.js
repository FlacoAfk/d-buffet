$("#boton").click(function () {
    $('html,body').animate({
        scrollTop: $("#one").offset().top
    }, 1000);
});

$("#boton2").click(function () {
    $('html,body').animate({
        scrollTop: $("#volver").offset().top
    }, 1200);
});