@extends('admin.master.master')
@section('title', 'Editar Membro')
@section('content')
    <div class="main_page_container">
        <div class="main_page_container_content">
            <section class="main_page_container_content_box">
                <header class="d-flex justify-content-between align-content-center">
                    <h1 class="icon-pencil-square-o">Atualizar Membro</h1>
                    <p>
                        <a href="{{ route('admin.index') }}" class="btn icon-users btn-sm btn-outline-dark">Ver Listagem</a>
                    </p>
                </header>

                <div class="separator"></div>

                <article class="main_page_content_form">
                    <form action="{{ route('admin.update', ['id' => $admin->id]) }}" name="form_update_user"
                          autocomplete="off" method="post">
                        @csrf
                        @method('PUT')

                        <div class="trigger_message"></div>

                        <div class=" form-row">
                            <div class="form-group col-md-12 mt-2">
                                <label for="description" class="form-label"><span class="text-danger">* </span>Nome
                                    Completo:</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Informe o nome do usuário" value="{{ $admin->name }}">
                            </div>

                            <div class="form-group col-md-4 mt-2">
                                <label for="email" class="form-label"><span class="text-danger">* </span>Email:</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       value="{{ $admin->email }}"
                                       placeholder="Informe um email válido">
                            </div>

                            <div class="form-group col-md-4 mt-2">
                                <label for="password" class="form-label"><span
                                        class="text-danger">* </span>Senha: (min. 6 caractéres)</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="******">
                            </div>

                            <div class="form-group col-md-4 mt-2">
                                <label for="password_confirmation" class="form-label"><span
                                        class="text-danger">* </span>Confirme Senha: (min. 6 caractéres)</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       id="password_confirmation"
                                       placeholder="******">
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status" {{ $admin->isActive() ? 'checked' : '' }}>
                                <label class="form-check-label" for="status" title="Se a opção for desmarcada o usuário não terá acesso ao sistema">
                                    Membro Ativo
                                </label>
                            </div>
                            <button type="submit" class="btn btn-outline-dark icon-check-square-o mt-0" >
                                Atualizar Membro
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

            // ATUALIZANDO USUÁRIO VIA AJAX
            $('form[name="form_update_user"]').submit(function (event) {
                event.preventDefault();

                const form = $(this);
                const action = form.attr('action');
                const data = form.serialize();

                $.ajax({
                    url: action,
                    type: 'PUT',
                    dataType: 'json',
                    data: data,
                    success: function (response) {

                        if (response.fail) {
                            ajax_message(response.fail)
                        }

                        if (response.success) {
                            ajax_message(response.success)
                        }
                    }
                });
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

        })
    </script>
@endsection
