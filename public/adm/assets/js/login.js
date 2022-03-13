$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('form[name="login"]').submit(function (event) {
        event.preventDefault();

        const form = $(this);
        const action = form.attr('action');
        const email = form.find('input[name="email"]').val();
        const passwd = form.find('input[name="password"]').val();

        $.post(action, {
            email: email,
            password: passwd,

        }, function (response) {
            if (response.fail) {
                ajax_message(response.fail);
            }

            if (response.redirect) {
                window.location.href = response.redirect;
            }

        }, 'json');
    });

    // MOSTRAR NOTIFICAÇÃO
    function ajax_message(message) {
        const ajax_message = $(message);
        $(".trigger_message").html(ajax_message);
        $(".trigger").effect("bounce");
    }

    // SUMIR COM A DIV DE NOTIFICAÇÃO APÓS O CLICK
    $(".trigger_message").on("click", ".trigger", function (e) {
        $(this).effect("bounce").fadeOut(1);
    });
});
