# Teste prático de PHP
Este teste foi desenvolvido com o framework Codeigniter 4.1.4

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

## Como executar

O Codeigniter 4 necessita da extensão php-intl e php-mbstring. Verificar se está instalado.

Passos

- baixe o repositório para um local válido (Linux Ubuntu /var/www/html/)
- Copie env para .env e adapte para o seu aplicativo, especificamente as configurações de banco de dados.

Para MySQL:
 - para uso do MySQL
 - database.default.hostname = localhost
 - database.default.database = database_test
 - database.default.username = root
 - database.default.password = root
 - database.default.DBDriver = MySQLi
 - -#database.default.DBPrefix =

Para sqLite
- # para uso do sqLite
- database.default.database = ../writable/database.db
- database.default.DBDriver = SQLite3
- -#database.default.DBPrefix =

- Dê permissão de escrita no diretório writable
- Após configurar o banco de dados (<ySQL ou SqLite), execute as migrations  com o comando $ php spark migrate
- No diretório da aplicação, execute o servidor interno do codeigniter, digitando
$ php spark serve
- ou configure o DocumentRoot Apache / Nginx para o diretório public do projeto (o mod-rewrite precisa estar ativo)



## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
