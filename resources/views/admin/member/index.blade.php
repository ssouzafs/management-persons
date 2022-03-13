@extends('admin.master.master')
@section('title', 'Lista de Membros')
@section('content')
    <div class="main_page_container">
        <div class="main_page_container_content">
            <section class="main_page_container_content_box">
                <header class="d-flex justify-content-between align-content-center">
                    <h1 class="icon-users">Lista de Membros</h1>
                    <p>
                        <a href="{{ route('admin.create') }}" class="btn btn-sm btn-outline-dark icon-user-plus">Criar Novo</a>
                    </p>
                </header>
                <div class="separator"></div>
                <div class="main_box_list_data mt-4">
                    <div class="trigger_message"></div>
                    <table id="datatable" class="table table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Cadastro</th>
                            <th>Açoes</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('adm/assets/js/datatables/js/customDataTables.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Setup de parametrização do datatable
        $(document).ready(function () {
            ManagerTable.setName("#datatable");
            ManagerTable.setColumns([
                'id',
                'name',
                'email',
                'created_at'
            ]);
            ManagerTable.setButton();
            ManagerTable.setRoute("{{ route('admin.load.data') }}");
            ManagerTable.render();
        });
    </script>
@endsection
