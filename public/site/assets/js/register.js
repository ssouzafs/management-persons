$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // CADASTRANDO USUÁRIO VIA AJAX
    $('form[name="form_create_user"]').submit(function (event) {
        event.preventDefault();

        const form = $(this);
        const action = form.attr('action');
        const name = form.find('input[name="name"]').val();
        const email = form.find('input[name="email"]').val();
        const password = form.find('input[name="password"]').val();
        const password_confirmation = form.find('input[name="password_confirmation"]').val();

        $.post(action, {
            name: name,
            email: email,
            password: password,
            password_confirmation: password_confirmation,

        }, function (response) {

            if (response.fail) {
                ajax_message(response.fail);
            }

            if (response.redirect) {
                window.location.href = response.redirect;
            }
        }, 'json');
    });

    // LIMPAR FORMULÁRIO APÓS CADASTRO
    // function reset_form(form) {
    //     form.resetForm();
    //     $("#name").val("").change();
    //     $('#name').focus();
    // }

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

})
