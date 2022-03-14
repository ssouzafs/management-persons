<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registrar-se</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400&family=Poppins:wght@100;200;300;400;600;700&family=Roboto:wght@100;400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('site/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/boot.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/area-access.css') }}">
</head>
<body>
<div class="main_area_access_user_auth">
    <article class="main_area_access_user_auth_content">
        <header>
            <div class="main_login_logo">Area de Cadastro</div>
            <h1>Olá, cadastre-se abaixo!</h1>
        </header>
        <form action="{{ route('user.store') }}" autocomplete="off" method="post" name="form_create_user">
            @csrf
            <div class="trigger_message"></div>
            <label>
                <span class="field icon-user"> Nome:</span>
                <input type="text" name="name" placeholder="Informe seu nome"/>
            </label>
            <label>
                <span class="field icon-envelope"> E-mail:</span>
                <input type="text" name="email" placeholder="Informe seu e-mail"/>
            </label>
            <label>
                <span class="field icon-unlock-alt">Senha:</span>
                <input type="password" name="password" placeholder="Informe sua senha"/>
            </label>
            <label>
                <span class="field icon-unlock-alt">Confirme Senha:</span>
                <input type="password" name="password_confirmation" placeholder="Informe sua senha"/>
            </label>
            <button type="submit" class="icon-check-square-o" id="btn_create_user">Cadastrar-se</button>
        </form>
        <div class="main_login_register">
            <small>Já possui login?</small>
            <a href="{{ route('user.login') }}">Logar-se</a>
        </div>
        <footer>
            <p>&copy; <?= date("Y"); ?> - Todos os Direitos Reservados</p>
            <p class="content_help">
                <a target="_blank"
                   class="icon-whatsapp transition text-green"
                   href="https://api.whatsapp.com/send?phone=55+44+997703798&text=Olá, preciso de ajuda com o cadastro."
                >Precisa de de Ajuda?</a>
            </p>
        </footer>
    </article>
</div>

<script src="{{ asset('site/assets/js/jquery.js') }}"></script>
<script src="{{ asset('site/assets/js/register.js') }}"></script>
</body>
</html>
