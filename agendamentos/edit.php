<?php
require("../DAO/veiculoDAO.php");
require("../DAO/agendamentoDAO.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Editar Revisão</title>
</head>


<?php
$agendamento = false;
$error = false;


if (!$_GET || !isset($_GET["registro"])) {
    header('Location: index.php?message=Nº de registro do agendamento não informado!!');
    die();
}


$agendamentoRegistro = $_GET["registro"];


try {    
    $agendamento = (new AgendamentoDAO())->find(($agendamentoRegistro));
   
} catch (Exception $e) {
    $error = $e->getMessage();
}


if (!$agendamento || $error) {
    header('Location: index.php?message=Erro ao recuperar dados do agendamento!');
    die();
}

try {
    $agendamentoResult = (new AgendamentoDAO())->index();
} catch (Exception $e) {
    header('Location: index.php?message=Erro ao recuperar o agendamento!');
    die();
}

$upadeError = false;
$updateResult = false;
if ($_POST) {
    try {

        $horario = $_POST["horario"];
        $local = $_POST["local"];
        $veiculo_id = $_POST["veiculo_id"];       

        $updateResult = (new AgendamentoDAO())->update($agendamentoRegistro, $horario, $local, $veiculo_id);

        if ($updateResult) {
            header('Location: index.php?message=Dados do agendamento alterado com sucesso!!');
            die();
        }
    } catch (Exception $e) {
        $upadeError = $e->getMessage();
    }
}

try {
    $veiculoResult = (new VeiculoDAO())->index();
} catch (Exception $e) {
    header('Location: index.php?message=Erro ao recuperar o departamento!');
    die();
}
?>

<body>

    <?php
    readFile("../partials/navbar.html");
    ?>

    <section class="container mt-5 mb-5">

        <?php if ($_POST && (!$updateResult || $upadeError)) : ?>
            <p>
                Erro ao alterar os dados do agendamento.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Editar revisão</h1>
            </div>
        </div>

        
        <form action="" method="post">

            <div class="mb-3">
                <label for="veiculo_id" class="form-label">Veículo</label>
                <select 
                    class="form-control" 
                    id="veiculo_id" 
                    name="veiculo_id"
                    required>
                        <option value></option>

                        <?php foreach($veiculoResult as $veiculo): ?>
                            <option 
                                value="<?=$veiculo["id"]?>"
                                <?= $veiculo["id"] == $agendamento["veiculo_id"] ? 'selected' : '';?>
                                >
                                <?=$veiculo["modelo"]?>
                            </option>
                        <?php endforeach; ?>                        
                </select>
            </div>

            
            <div class="mb-3">
                <label for="horario" class="form-label">Horário</label>
                <input type="text" class="form-control" value="<?= $agendamento["horario"]?>" id="horario" name="horario">
            </div>

            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" class="form-control" value="<?= $agendamento["local"]?>" id="local" name="local">
            </div>

            <div style="float:right">
                <a href="index.php" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Agendar</button>
            </div>
            </form>
    </section>

</body>

</html>