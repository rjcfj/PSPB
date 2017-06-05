# PSPB para Laravel 5.4
Candidato de Emprego, implemente um pequeno sistema para gerenciamento de currículos utilizando o conceito de micro serviços

## Servidor:
Apache 2.4.23 / PHP 7.1.2 / MYSQL 5.7.17

## Instalação

~~~~
git clone
composer update
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate

~~~~

Você também deve adicionar suas informações de banco de dados e email em seu arquivo .env:
~~~~ 
BD: 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=###
DB_USERNAME=###
DB_PASSWORD=###

MAIL:
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=###@gmail.com
MAIL_PASSWORD=###
MAIL_ENCRYPTION=tls
        
~~~~ 
Depois de criar seu banco de dados e fornecer as credenciais, você precisará executar a partir da linha de comando:
~~~~
php artisan migrate
php artisan db:seed
~~~~
Inicie um servidor de desenvolvimento local com `php artisan serve` E, visite http://localhost:8000

## Login:

Se você prosseguisse com os dados falsos, um usuário deveria ter sido criado para você com as seguintes credenciais de login:

>**email:** `admin@admin.com`   
>**senha:** `admin`

## API (JSON)
Micro Serviços (POSTMAN)

## GET (Lista)

#### Candidato
http://localhost:8000/api/candidato
#### Job
http://localhost:8000/api/job

## GET (Buscar)

#### Candidato
http://localhost:8000/api/candidato/1
#### Job
http://localhost:8000/api/job/1

## POST
#### Candidato
http://localhost:8000/api/candidato/1
~~~~
{"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}
~~~~
#### Job
http://localhost:8000/api/job/1
~~~~
{"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"} 
~~~~

## PUT

#### Candidato
http://localhost:8000/api/candidato/1
~~~~
{"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}
~~~~
#### Job
http://localhost:8000/api/job/1
~~~~
{"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}
~~~~

## DELETE

#### Candidato
http://localhost:8000/api/candidato/1
#### Job
http://localhost:8000/api/job/1
