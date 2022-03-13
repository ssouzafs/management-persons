@extends('user.master.master')
@section('title', 'Edição de Perfil')
@section('content')
    <div class="main_page_container">
        <div class="main_page_container_content">
            <section class="main_page_container_content_box">
                <header class="d-flex justify-content-between align-content-center">
                    <h1 class="icon-pencil-square-o">Editar Perfil</h1>
                </header>

                <div class="separator"></div>

                <article class="main_page_content_form">
                    <form action="{{ route('user.update', ['id' => $user->id]) }}" name="form_update_user" autocomplete="off" method="post">
                         @csrf
                        @method('PUT')

                        <div class="message_alert"></div>

                        <div class=" form-row">
                            <div class="form-group col-md-6 mt-2">
                                <label for="name" class="form-label" id="name">
                                    <span class="text-danger">* </span>
                                    Nome:
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="Informe seu nome" id="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="cpf" class="form-label"><span class="text-danger">* </span>CPF:</label>
                                <input type="text" class="form-control mask-doc" name="cpf" id="cpf" placeholder="999.999.999-99" value="{{ $user->cpf }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="rg" class="form-label"><span class="text-danger">* </span>RG:</label>
                                <input type="text" class="form-control" name="rg"  value=" {{ $user->rg }}"  placeholder="Informe seu RG" id="rg">
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-group col-md-4 mt-2">
                                <label for="email" class="form-label"><span class="text-danger">* </span>Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" placeholder="Informe um email válido">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="password" class="form-label">
                                    <span class="text-danger">* </span>
                                    Senha: (min. 6 caractéres)
                                </label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="******">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="password_confirmation" class="form-label"><span class="text-danger">* </span>
                                    Confirme Senha: (min. 6 caractéres)
                                </label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="******" id="password_confirmation">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 mt-2">
                                <label for="date_of_birth" class="form-label"> <span class="text-danger">* </span>
                                    Data de Nascimento:
                                </label>
                                <input type="text" class="form-control mask-date" name="date_of_birth" id="date_of_birth" placeholder="Informe sua data de nascimento" value="{{ $user->date_of_birth }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="cell_phone" class="form-label">
                                    <span class="text-danger">* </span>Celular:</label>
                                <input type="text" class="form-control mask-cell" name="cell_phone" id="cell_phone"  placeholder="(99) 9999-9999" value="{{ $user->cell_phone }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="phone" class="form-label">Telefone Fixo:</label>
                                <input type="text" class="form-control mask-phone" name="phone" id="phone" placeholder="(99) 9999-9999" value="{{ $user->phone }}">
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="genre" class="form-label">Gênero:</label>
                                <select id="genre" class="form-control" name="genre">
                                    <option value="" disabled selected>Informe seu gênero</option>
                                    <option value="female" {{$user->genre === 'female' ? 'selected' : ''}}>Feminino</option>
                                    <option value="male" {{$user->genre === 'male' ? 'selected' : ''}}>Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class=" form-row">
                            <div class="form-group col-md-3 mt-2">
                                <label for="zipcode" class="form-label"><span class="text-danger">* </span>CEP:</label>
                                <input type="text" class="form-control mask-zipcode" name="zipcode" id="zipcode"  placeholder="Informe o CEP" value="{{ $user->zipcode }}">
                            </div>
                            <div class="form-group col-md-9 mt-2">
                                <label for="address" class="form-label">
                                    <span class="text-danger">* </span>
                                    Logradouro:
                                </label>
                                <input type="text" class="form-control" name="address" placeholder="Informe seu endereço" id="address" value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 mt-2">
                                <label for="neighborhood" class="form-label">
                                    <span class="text-danger">* </span>
                                    Bairro:
                                </label>
                                <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="Informe seu bairro" value="{{ $user->neighborhood }}">
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="complement" class="form-label">
                                    Complemento:
                                </label>
                                <input type="text" class="form-control" name="complement" id="complement"  placeholder="Informe um complemento" value="{{ $user->complement }}">
                            </div>

                            <div class="form-group col-md-2 mt-2">
                                <label for="number" class="form-label">Número:</label>
                                <input type="text" class="form-control" name="number" id="number" placeholder="Informe o número" value="{{ $user->number }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8 mt-2">
                                <label for="city" class="form-label">
                                    <span class="text-danger">* </span>Cidade:</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Informe a cidade" value="{{ !empty($user->city()) ? $user->city()->name : '' }}">
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="state" class="form-label">
                                    <span class="text-danger">* </span>Estado:</label>
                                <input type="text" class="form-control" name="state" id="state" placeholder="Informe o estado" value="{{ !empty($user->city()) ? $user->city()->state()->name : '' }}">
                            </div>
                        </div>
                        <div class="form-row justify-content-end">
                            <button type="submit" class="btn btn-outline-dark icon-check-square-o mt-0">
                                Atualizar Perfil
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

                $(".message_alert").html(ajax_message);
                $(".trigger").effect("bounce");
            }

            // SUMIR COM A DIV DE NOTIFICAÇÃO APÓS O CLICK
            $(".message_alert").on("click", ".trigger", function (e) {
                $(this).effect("bounce").fadeOut(1);
            });
        })
    </script>
@endsection
