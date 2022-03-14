<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Instruções de Instalação
## Após clonar o projeto para sua máquina local, execute os seguintes passos:


- Para que o projeto funcione é preciso ter instalado na máquina o docker e docker-compose.
Antes de iniciar, renomeie arquivo ```.env.exemplo``` para ```.env```

- Em seguida  rodar o comando, na raiz do projeto :
~~~php
 docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
~~~
- Depois de instalado as dependências execute o comando:
~~~php
./vendor/bin/sail up
~~~
- Para facilitar, você pode rodar o comando ``` alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'```. 

- Isso criará um álias para o caminho na pasta .vendor. Agora você pode usar somente o comando ```sail [nome-do-comando] ``` ao invés de ```./vendor/bin/sail [nome-do-comando]``` enquanto a aba atual do terminal estiver aberta. Nos passos adiante será utilizado o caminho completo, mas você pode utilizar somente a forma abreviada como foi explicado.

- Continuando os passos, execute os comandos de instalação das dependências do composer e também as dos arquivos JS (sempre dentro da pasta raiz do projeto):
~~~php
./vendor/bin/sail composer update
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
~~~
- Agora basta rodar as migrações para que sejam criadas as tabelas no banco de dados, execute o comando:
~~~php
./vendor/bin/sail migrate
~~~
- Note que a última **migration** a ser executada é uma inserção de um usuário administrador com as credenciais, email: ```admin.email@test.com``` e senha: ```123456```. use-as para acessar o sistema em modo administrador.

- Vale lembrar que o usuário administrador é acessado com o prefixo **/admin**. EX.: ```http://0.0.0.0/admin```

- Já para o acesso de usuário comum basta retirar o prefixo **/admin**, EX.: ```http://0.0.0.0/```

- Pronto! Agora é so utilizar o sistema.
