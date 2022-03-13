@extends('admin.master.master')
@section('title', 'Novo Membro')

@section('content')
    <div class="main_page_container">
        <div class="main_page_container_content">
            <section class="main_page_container_content_box">
                <header class="d-flex justify-content-between align-content-center">
                    <h1 class="icon-user-plus">Cadastrar Membro</h1>
                    <p>
                        <a href="{{ route('admin.index') }}" class="btn icon-users btn-sm btn-outline-dark">VerListagem</a>
                    </p>
                </header>

                <div class="separator"></div>

                <article class="main_page_content_form">
                    <form action="{{ route('admin.store') }}" name="form_create_user" autocomplete="off"
                          method="post">
                        @csrf

                        <div class="trigger_message"></div>

                        <div class=" form-row">
                            <div class="form-group col-md-12 mt-2">
                                <label for="description" class="form-label"><span class="text-danger">* </span>Nome
                                    Completo:</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Informe o nome do usuário">
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label for="email" class="form-label"><span class="text-danger">* </span>Email:</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Informe um email válido">
                            </div>

                            <div class="form-group col-md-3 mt-2">
                                <label for="password" class="form-label"><span
                                        class="text-danger">* </span>Senha:</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Min. 6 Caractéres">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="password_confirmation" class="form-label"><span
                                        class="text-danger">* </span>Confirme Senha:</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                       placeholder="Min. 6 Caractéres">
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-outline-dark icon-check-square-o mt-0">
                                Cadastrar Membro
                            </button>
                        </div>
                    </form>
                </article>
            </section>
        </div>
    </div>
@endsection

@section('js')

    <script>
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
                const status = form.find('input[name="status"]:checked').val();

                $.post(action, {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    status: status,
                }, function (response) {

                    if (response.fail) {
                        ajax_message(response.fail);
                    }

                    if (response.success) {
                        ajax_message(response.success);
                        reset_form(form);
                    }
                }, 'json');
            });

            // LIMPAR FORMULÁRIO APÓS CADASTRO
            function reset_form(form) {
                form.resetForm();
                $('#name').focus();
            }

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
    </script>
@endsection
