<?php  
 require_once("../DAO/veiculoDAO.php");
 
	$message = false;
	$id = false;

	if($_GET)
	{
		if(isset($_GET["message"])) $message = $_GET["message"];
		if(isset($_GET["id"])) $id = $_GET["id"];
	}

	
	$linhas = (new VeiculoDAO())->Index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<title>Veículos</title>
</head>
<body>

<?php  
        readFile("../partials/navbar.html");
    ?>

<section class="container mt-5 mb-5">

<?php if($message):?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?=$message?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif;?>

        <div class="row mb-3">
			<div class="col">
				<h1>Veículos</h1>
			</div>
			<div class="col d-flex justify-content-end align-items-center">
				<a class="btn btn-success" href="add.php">Adicionar Veículos</a>
			</div>
		</div>

        <table class="table table-hover table-dark">
			<thead class="table-dark">
				<tr>
					<th>Identificador</th>
					<th>Marca</th>
					<th>Modelo</th>
                    <th>Ano</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($linhas as $veiculo): ?>
					<tr>
						<td>
							<?=$veiculo["id"]?>
						</td>
						<td>
							<?=$veiculo["marca"]?>
						</td>
						<td>
							<?=$veiculo["modelo"]?>
						</td>
                        <td>
                            <?=$veiculo["ano"]?>
                        </td>
						<td>
							<div class="btn-group" role="group">
								<button 
									type="button" 
									class="btn btn-outline-danger"
									onclick="confirmDelete(<?=$veiculo['id']?>)">
									Excluir
								</button>
								<a 
									href="edit.php?id=<?=$veiculo['id']?>" 
									class="btn btn-outline-warning">
									Editar
								</a>
								<a 
									href="view.php?id=<?=$veiculo['id']?>" 
									class="btn btn-outline-info">
									Ver
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script>
	const confirmDelete = (veiculoId) => {
		const response = confirm("Deseja realmente excluir este veículo?")
		if(response){
			window.location.href = "delete.php?id=" + veiculoId
		}
	}
</script>
</html>