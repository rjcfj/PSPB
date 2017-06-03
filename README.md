# PSPB
Candidato de Emprego

1 - git clone
2 - composer update
3 - Criar .ENV
4 - Configuração de .ENV (BD e MAIL)
    BD - Usuario e Senha de banco de dados
    MAIL -  MAIL_DRIVER=smtp
            MAIL_HOST=smtp.gmail.com
            MAIL_PORT=587
            MAIL_USERNAME=###@gmail.com
            MAIL_PASSWORD=###
            MAIL_ENCRYPTION=tls
5 - php artisan migrate
6 - php artisan serve

#########################################################

API - Seviços (JSON)

GET
http://localhost:8000/api/candidato
http://localhost:8000/api/job

POST
http://localhost:8000/api/candidato
-> {"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}
http://localhost:8000/api/job
-> {"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}

PUT
http://localhost:8000/api/candidato/1
-> {"nome":"#","email":"#","cpf":"#","telefone":"#","tecnica":"#","sociais":"#","experiencia":"#","arquivo":"Local ou Web","job_id":"#"}
http://localhost:8000/api/job/1
-> {"nome":"#","descricao":"#","local":"#","remoto":"Sim ou Não"}

DELETE
http://localhost:8000/api/candidato/1
http://localhost:8000/api/job/1
