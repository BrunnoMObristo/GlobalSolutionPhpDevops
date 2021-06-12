<?php
require_once("../DAO/agendamentoDAO.php");

$agendamento = false;
$error = false;

if (!$_GET || !isset($_GET["registro"])) {
    header('Location: index.php?message=Nº do registro do agendamento não informado!!');
    die();
}

$agendamentoRegistro = $_GET["registro"];

try {
    
    $agendamento = (new AgendamentoDAO())->find($agendamentoRegistro);
   
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (!$agendamento || $error) {
    header('Location: index.php?message=Erro ao recuperar dados do agendamento!');
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Visualizar Agendamento</title>
</head>

<body>

    <?php
    readFile("../partials/navbar.html");
    ?>

<section class="container mt-5 mb-5">
        <div class="row mb-3">
            <div class="col">
                <h1>Visualizar Agendamento</h1>
            </div>
        </div>

        <div class="mb-3">
            <h3>Horário</h3>
            <p><?= $agendamento["horario"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Local</h3>
            <p><?= $agendamento["local"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Veículos</h3>
            <p><?= $agendamento["veiculos"] ?></p>
        </div>

    </section>
</body>

</html>