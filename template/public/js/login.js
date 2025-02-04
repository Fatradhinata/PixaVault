let showPassword = false;

$('.input-password img').on('click', function() {
    $(this).hide();
    $(this).siblings('img').show();

    showPassword = !showPassword;
    $(this).siblings('input').prop('type', (showPassword) ? "text" : "password"); 
});