$(document).ready(function() {

    $('form').submit(function (event) {
        event.preventDefault();

        $(this).find('.form-control').each(function () {
            if ($(this).val().length < 1){
                $(this).closest('.form-group').addClass('has-error');
            }
        });

        let form = $('form').serialize();
        $.ajax({
            type: 'GET',
            url: '../components/SendMail.php',
            data: form,
            success: function (data) {
                $('#results').html(data);
            },
            error: function (xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });

    });

});
