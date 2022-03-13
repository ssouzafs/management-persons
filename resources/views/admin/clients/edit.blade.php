@extends('admin.master.master')

@section('content')
    <div class="main_page_container">
        <div class="main_page_container_content">
            <section class="main_page_container_content_box">
                <header class="d-flex justify-content-between align-content-center">
                    <h1 class="icon-user">Perfil do Cliente</h1>
                    <p>
                        <a href="{{ route('admin.home') }}" class="btn icon-users btn-sm btn-outline-dark">Ver Listagem</a>
                    </p>
                </header>

                <div class="separator"></div>

                <article class="main_page_content_form">
                    <form name="form_update_user" action="{{ route('admin.update.client', ['id' => $client->id]) }}" autocomplete="off" method="post" id="page_single">
                        @method('PATCH')

                        <div class="trigger_message"></div>

                        <div class=" form-row">
                            <div class="form-group col-md-8 mt-2">
                                <label for="name" class="form-label" id="name">
                                    <span class="text-danger">* </span>
                                    Nome:
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="Informe seu nome"
                                       id="name" value="{{ $client->name }}">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="cpf" class="form-label"><span class="text-danger">* </span>CPF:</label>
                                <input type="text" class="form-control" name="cpf" id="cpf"
                                       placeholder="999.999.999-99" value="{{ $client->cpf }}">
                            </div>

                        </div>
                        <div class=" form-row">
                            <div class="form-group col-md-4 mt-2">
                                <label for="email" class="form-label"><span class="text-danger">* </span>Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $client->email }}"
                                       id="email" placeholder="Informe um email válido">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="password" class="form-label">
                                    <span class="text-danger">* </span>
                                    Senha: (min. 6 caractéres)
                                </label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="******">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="rg" class="form-label"><span class="text-danger">* </span>RG:</label>
                                <input type="text" class="form-control" name="rg" value=" {{ $client->rg }}"
                                       placeholder="Informe seu RG" id="rg">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 mt-2">
                                <label for="date_of_birth" class="form-label"> <span class="text-danger">* </span>
                                    Data de Nascimento:
                                </label>
                                <input type="text" class="form-control" name="date_of_birth"
                                       id="date_of_birth" placeholder="Informe sua data de nascimento"
                                       value="{{ $client->date_of_birth }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="cell_phone" class="form-label">
                                    <span class="text-danger">* </span>Celular:</label>
                                <input type="text" class="form-control" name="cell_phone" id="cell_phone"
                                       placeholder="(99) 9999-9999" value="{{ $client->cell_phone }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="phone" class="form-label">Telefone Fixo:</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                       placeholder="(99) 9999-9999" value="{{ $client->phone }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="genre" class="form-label">Gênero:</label>
                                <input type="text" class="form-control" name="genre" id="genre"
                                       value="{{ $client->getGenre() }}">
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-group col-md-3 mt-2">
                                <label for="zipcode" class="form-label"><span class="text-danger">* </span>CEP:</label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode"
                                       placeholder="Informe o CEP" value="{{ $client->zipcode }}">
                            </div>
                            <div class="form-group col-md-9 mt-2">
                                <label for="address" class="form-label">
                                    <span class="text-danger">* </span>
                                    Logradouro:
                                </label>
                                <input type="text" class="form-control" name="address"
                                       placeholder="Informe seu endereço" id="address" value="{{ $client->address }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 mt-2">
                                <label for="neighborhood" class="form-label">
                                    <span class="text-danger">* </span>
                                    Bairro:
                                </label>
                                <input type="text" class="form-control" name="neighborhood" id="neighborhood"
                                       placeholder="Informe seu bairro" value="{{ $client->neighborhood }}">
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="complement" class="form-label">
                                    Complemento:
                                </label>
                                <input type="text" class="form-control" name="complement" id="complement"
                                       placeholder="Informe um complemento" value="{{ $client->complement }}">
                            </div>

                            <div class="form-group col-md-2 mt-2">
                                <label for="number" class="form-label">Número:</label>
                                <input type="text" class="form-control" name="number" id="number"
                                       placeholder="Informe o número" value="{{ $client->number }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8 mt-2">
                                <label for="city" class="form-label">
                                    <span class="text-danger">* </span>Cidade:</label>
                                <input type="text" class="form-control" name="city" id="city"
                                       placeholder="Informe a cidade"
                                       value="{{ !empty($client->city()) ? $client->city()->name : '' }}">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="state" class="form-label">
                                    <span class="text-danger">* </span>Estado:</label>
                                <input type="text" class="form-control" name="state" id="state"
                                       placeholder="Informe o estado"
                                       value="{{ !empty($client->city()) ? $client->city()->state()->name : '' }}">
                            </div>
                        </div>
                        <div class="form-row justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input realce_item" type="checkbox" id="status" name="status" {{ $client->isActive() ? 'checked' : '' }}>
                                <label class="form-check-label realce_item" for="status"
                                       title="Cliente não conseguirá acessar seu perfil">
                                    Cliente Inativo
                                </label>
                            </div>
                            <button type="submit" class="btn btn-outline-dark icon-check-square-o mt-0"
                                    id="btn">
                                Atualizar Status
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
            $("#page_single :input").prop("disabled", true);
            $("#btn").prop("disabled", false);
            $("#status").prop("disabled", false);

            $('form[name="form_update_user"]').submit(function (event) {
                event.preventDefault();

                const form = $(this);
                const action = form.attr('action');
                const data = form.serialize();

                $.ajax({
                    url: action,
                    type: 'PATCH',
                    dataType: 'json',
                    data: data,
                    success: function (response) {

                        if (response.fail) {
                            ajax_message(response.fail);
                        }
                        if (response.success) {
                            ajax_message(response.success);
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
