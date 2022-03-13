<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Instruções de Instalação

## Após clonar o projeto para sua máquina local, execute os seguintes passos:
Para que o projeto funcione é preciso ter instalado na máquina o docker e docker-compose.
Em seguida  rodar o comando, na raiz do projeto :
~~~php
 docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
~~~
- Depois de instalado as dependências execute o comando **.vendor/bin/sail up**
**Ex.: .vendor/bin/sail npm install, .vendor/bin/sail composer update** e por último rode as migrations com o comando **.vendor/bin/sail artisan migrate.**
Para não precisar ficar digitando o caminho da pasta a todo momento basta colar no terminal o comando **alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'.**
- Depois disso, śo usar o comando **sail** sucedido dos comandos do composer ou do npm, etc.
Note que a última migration a ser executada é uma inserção de um usuário admin com o email: **admin.email@test.com** e senha: **123456** para acessar o sistema. Lembrando que o usuário admim é acessado com o prefixo admin. Ex:. **/admim** retornará a tela de login de usuário admim e a  / (barra) retornará a tela de login do usuário comum.
* Observação: Não precisa ter instaldo previamente nada (PHP, PERL ou MSQL, XAMP) nada disso. O Laravel gerencia tudo isso via docker. Instala tudo como se fossem dependências.
