$(document).ready(function () {
    var alert = $('.alert');

    // Desaparecer el alert despu�s de 3 segundos (3000 milisegundos)
    setTimeout(function() {
        alert.each(function () {
            $(this).find('.close').click();
        });
    }, 5000);
});