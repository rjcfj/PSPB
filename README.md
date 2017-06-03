# PSPB
Candidato de Emprego

1 - git clone <br>
2 - composer update <br>
3 - Criar .ENV <br>
4 - Configuração de .ENV (BD e MAIL) <br>
    BD - Usuario e Senha de banco de dados <br>
    MAIL -  MAIL_DRIVER=smtp <br>
            MAIL_HOST=smtp.gmail.com <br>
            MAIL_PORT=587 <br>
            MAIL_USERNAME=###@gmail.com <br>
            MAIL_PASSWORD=### <br>
            MAIL_ENCRYPTION=tls <br>
5 - php artisan migrate <br>
6 - php artisan serve <br>
<br>
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
-> {"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}
http://localhost:8000/api/job <br>
-> {"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}
<br>
PUT<br>
http://localhost:8000/api/candidato/1<br>
-> {"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}
http://localhost:8000/api/job/1<br>
-> {"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}
<br>
DELETE<br>
http://localhost:8000/api/candidato/1<br>
http://localhost:8000/api/job/1<br>
