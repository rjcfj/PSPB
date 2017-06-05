# PSPB para Laravel 5.4
Candidato de Emprego, implemente um pequeno sistema para gerenciamento de currículos utilizando o conceito de micro serviços

## Servidor:
Apache 2.4.23 / PHP 7.1.2 / MYSQL 5.7.17

## Instalação

~~~~
git clone
composer update
Criar .ENV
~~~~

Você também deve adicionar suas informações de banco de dados e email em seu arquivo .env:
~~~~ 
BD - Usuario e Senha de banco de dados
MAIL -  MAIL_DRIVER=smtp
        MAIL_HOST=smtp.gmail.com
        MAIL_PORT=587 <br>
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
    
#########################################################
<br>
API - Seviços (JSON)
<br>
GET<br>
http://localhost:8000/api/candidato <br>
http://localhost:8000/api/job <br>
<br>
POST<br>
http://localhost:8000/api/candidato <br>
-> {"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}<br>
http://localhost:8000/api/job <br>
-> {"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}
<br>
PUT<br>
http://localhost:8000/api/candidato/1<br>
-> {"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}<br>
http://localhost:8000/api/job/1<br>
-> {"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}
<br>
DELETE<br>
http://localhost:8000/api/candidato/1<br>
http://localhost:8000/api/job/1<br>
