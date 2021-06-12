<?php
 require("../DAO/veiculoDAO.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Visualizar Veículo</title>
</head>

<?php
$veiculo = false;
$error = false;

if (!$_GET || !$_GET["id"]) {
    header('Location: index.php?message=Id do veiculo não informado!!');
    die();
}

$veiculoId = $_GET["id"];

try{
    $veiculo = (new VeiculoDAO())->FindById($veiculoId);
}catch(Exception $error){
    $error = $erro->getMessage();    
}

if (!$veiculo || $error) {
    header('Location: index.php?message=Erro ao recuperar dados desse departamento!!');
    die();
}


?>

<body>

    <?php
        readFile("../partials/navbar.html");
    ?>

    <section class="container mt-5 mb-5">
        <div class="row mb-3">
            <div class="col">
                <h1>Visualizar Veículo</h1>
            </div>
        </div>

        <div class="mb-3">
            <h3>Marca</h3>
            <p><?= $veiculo["marca"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Modelo</h3>
            <p><?= $veiculo["modelo"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Ano</h3>
            <p><?= $veiculo["ano"] ?></p>
        </div>

    </section>
</body>

</html>
