@extends('admin.master.master')
@section('title', 'Home Administrativo')
@section('content')
    <div class="main_page_container">
        <div class="main_page_container_content">
            <section class="main_home_page_content_box_cards">
                <article>
                    <h2 class="icon-users">Membros</h2>
                    <p class="icon-arrow-up">Ativos: <span>{{ \App\Models\Admin::qtdeActive() }}</span></p>
                    <p class="icon-arrow-down">Inativos: <span>{{ \App\Models\Admin::qtdeInactive() }}</span></p>
                </article>

                <article>
                    <h2 class="icon-calendar-check-o">Total de Clientes</h2>
                    <p class="icon-arrow-up">Ativos: <span>{{ \App\Models\User::qtdeActive() }}</span></p>
                    <p class="icon-arrow-down">Inativos: <span>{{ \App\Models\User::qtdeInactive() }}</span></p>
                </article>

                <article>
                    <h2>Notificações</h2>
                    <p>Acessos na Última Hora:<span>0</span></p>
                </article>
            </section>

            <section class="main_home_page_content_box_routines my-4">
                <header>
                    <h1 class="icon-search">Últimos Clientes Cadastrados</h1>
                </header>

                <div class="main_box_list_routines">

                    <table id="dataTable" class="table table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Gênero</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Cadastrodo Em</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->getGenre() }}</td>
                                <td>{{ !empty($client->city()) ? $client->city()->name : 'Ainda não foi Informado' }}</td>
                                <td>{{ !empty($client->city()) ? $client->city()->state()->name : 'Ainda não foi Informado' }}</td>
                                <td>{{ $client->created_at}}</td>
                                <td>{{ $client->status() }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.edit.client', ['id' => $client->id]) }}">Detalhes do Cliente</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
