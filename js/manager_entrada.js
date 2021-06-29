$(document).on('click', '.s-btn', function() {
    $('.contenedor').addClass('active-sign-in').siblings('.contenedor')
});
$(document).ready(function() {
    $('.cancelar a').click(function() {
        $('.contenedor').removeClass('active-sign-in')
    })
});