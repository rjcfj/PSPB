<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Verifique seu endereço de e-mail</h2>
    <div>
        Obrigado por criar uma conta com o aplicativo de demonstração de verificação. <br>
        favor, siga o link abaixo para verificar seu endereço de e-mail <br>
        {{ URL::to('jobcandidatos/verify/' . $confirmacao) }}.<br/>
    </div>

</body>
</html>