<?php
require_once("../DAO/veiculoDAO.php");
require_once("../DAO/agendamentoDAO.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <title>Agendar nova revisão</title>
</head>


<?php
$result = false;
$error = false;

if ($_POST) {
    try {

        $horario = $_POST["horario"];
        $local = $_POST["local"];
        $veiculo_id = $_POST["veiculo_id"];

       $result = (new agendamentoDAO())->Adicionaragendamento($horario, $local, $veiculo_id);

        if ($result) {
            header('Location: index.php?message=Funcionário inserido com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

try {
    $veiculoResult = (new veiculoDAO())->index();
} catch (Exception $e) {
    header('Location: index.php?message=Erro ao recuperar o veículo!');
    die();
}

?>

<body>

    <?php
        readFile("../partials/navbar.html");
    ?>

<section class="container mt-5 mb-5">

<?php if ($_POST && (!$result || $error)) : ?>
            <p>
                Erro salvar a nova revisão.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Agendar Revisão</h1>
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
                            <option value="<?=$veiculo["id"]?>">
                                <?=$veiculo["modelo"]?>
                            </option>
                        <?php endforeach;?>                                              
                </select>                
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Local</label>
                <select class="form-control" id="local" name="local">
                    <option>Local 1</option>
                    <option>Local 2</option>
                    <option>Local 3</option>
                    <option>Local 4</option>
                    <option>Local 5</option>
                    <option>Local 6</option>
                    <option>Local 7</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="horario" class="form-label">Horário</label>
                <input type="text" class="form-control" id="horario" name="horario">
            </div>

            <div style="float:right">
                <a href="index.php" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Agendar</button>
            </div>
        </form>
    </section>

</body>

</html>

        