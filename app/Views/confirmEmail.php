<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Email</title>
</head>

<body>
    <h3>Confirmação de email</h3>

    <p><?= "Olá " . $nome . ", clique no link abaixo para confirmar o seu email !"; ?> <p>

    <a href="<?= base_url("/confirmar/") ."/". $codigo; ?>">confimar email</a>
</body>

</html>