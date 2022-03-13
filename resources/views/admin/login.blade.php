<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Administrativo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400&family=Poppins:wght@100;200;300;400;600;700&family=Roboto:wght@100;400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('adm/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('adm/assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('adm/assets/css/login.css') }}">
</head>
<body>

<div class="ajax_response"></div>

<div class="main_login_page">
    <article class="main_login_page_content_box">
        <header>
            <div class="main_login_logo">ÁREA<span>ADMIN</span></div>
            <h1>Olá, faça seu login abaixo!</h1>
        </header>
        <form action="{{ route('admin.login.do') }}" autocomplete="off" method="post" name="login">
            @csrf
            <div class="trigger_message"></div>
            <label>
                <span class="field icon-envelope"> E-mail:</span>
                <input type="text"  name="email" placeholder="Informe seu e-mail"/>
            </label>

            <label>
                <span class="field icon-unlock-alt">Senha:</span>
                <input type="password" name="password" placeholder="Informe sua senha"/>
            </label>

            <button type="submit" class="icon-sign-in" id="btn_login">Entrar</button>
        </form>
        <footer>
            <p>Desenvolvido por <a href="https://github.com/ssouzafs" target="_blank">Sérgio Souza</a></p>
            <p>&copy; <?= date("Y"); ?> - Teste e/code</p>
            <p class="dash_login_left_box_support">
                <a target="_blank"
                   class="icon-whatsapp transition text-green"
                   href="https://api.whatsapp.com/send?phone=55+44+997703798&text=Olá, preciso de ajuda com o login."
                >Precisa de Suporte?</a>
            </p>
        </footer>
    </article>
</div>

<script src="{{ asset('adm/assets/js/jquery.js') }}"></script>
<script src="{{ asset('adm/assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('adm/assets/js/login.js') }}"></script>
</body>
</html>
