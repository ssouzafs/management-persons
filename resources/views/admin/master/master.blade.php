<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,300&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/assets/css/libs.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/assets/css/boot.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/assets/css/style.css') }}">

</head>
<body>
<header class="main_header pt-2">
    <div class="main_header_content">
        <nav class="navbar navbar-expand-lg  pt-4  navbar-dark px-lg-0 d-flex flex-lg-wrap align-items-center">
            <a class="navbar-brand main_logo" href="#">MANAGER<b>PERSONS</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto my-auto main_menu">
                    <li class="nav-item mr-4">
                        <a class="nav-link icon-tachometer" href="{{ route('admin.home') }}">
                            Clientes
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown mr-4">
                        <a class="nav-link dropdown-toggle icon-users" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-expanded="false">
                            Administradores
                        </a>
                        <div class="dropdown-menu mt-lg-2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item icon-users" href="{{ route('admin.index') }}">Listar
                                Membros</a>
                            <a class="dropdown-item icon-user-plus" href="{{ route('admin.create') }}">Novo
                                Membro</a>
                        </div>
                    </li>
                </ul>
                <li class="nav-item dropdown d-flex ">
                    <a class="nav-link dropdown-toggle pl-0 text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span class="font-weight-light"></span> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu exit mt-lg-2 w-25" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item icon-sign-out" href="{{ route('admin.logout') }}">Sair</a>
                    </div>
                </li>
            </div>
        </nav>
    </div>
</header>

@yield('content')

<script src="{{ asset('site/assets/js/jquery.js') }}"></script>
<script src="{{ asset('site/assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('site/assets/js/libs.js') }}"></script>
<script src="{{ asset('adm/assets/js/scripts.js') }}"></script>

@hasSection('js')
    @yield('js')
@endif

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remover Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Tem certeza de que deseja remover o registro <span class="show_content_option" style="font-weight: 500;"></span>?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn  btn-sm btn-outline-danger btn_confirmed">Sim, Remover</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
