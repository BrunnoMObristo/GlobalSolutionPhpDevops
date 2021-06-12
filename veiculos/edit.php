<?php
 require_once("../DAO/veiculoDAO.php");

$veiculo = false;
$error = false;

if (!$_GET || !isset($_GET["id"])) {
    header('Location: index.php?message=Id do veículo não informado!!');
    die();
}


$veiculoid = $_GET["id"];

try{
    $veiculo = (new VeiculoDAO())->FindById($veiculoid);
}catch(Exception $error){
    $error = $erro->getMessage();    
}
$updateError = false;
$updateResultado = false;

if($_POST){
    try{
        
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $ano = $_POST["ano"];
            
        $updateResultado = (new VeiculoDAO())->Atualizar($veiculoid, $marca, $modelo, $ano);

        if ($updateResultado) {
            header('Location: index.php?message=O veículo foi atualizado com sucesso!!');
            die();
        }
    }catch(Exception $erro){
        $error = $erro->getMessage();
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Editar Veículo</title>
</head>
<body>

    <?php
        readFile("../partials/navbar.html");
    ?>

<section class="container mt-5 mb-5">

<?php if ($_POST && (!$updateResultado || $updateError)) : ?>
    <p>
        Erro ao alterar o Veículo.
        <?= $error ? $error : "Erro desconhecido." ?>
    </p>
<?php endif; ?>

<div class="row mb-3">
    <div class="col">
        <h1>Editar Veículo</h1>
    </div>
</div>

<form action="" method="post">

<div class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="marca" value="<?=$veiculo["marca"]?>" name="marca" required>                  
    </div>

    <div class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type class="form-control" id="modelo" value="<?=$veiculo["modelo"]?>" name="modelo" required>
    </div>

    <div class="mb-3">
        <label for="modelo" class="form-label">Ano</label>
        <input type="text" class="form-control" id="ano" value="<?=$veiculo["ano"]?>" name="ano" required>          
    </div>

    <div style="float:right">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>
</section>