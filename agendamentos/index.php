<?php  
	require_once("../DAO/agendamentoDAO.php");
	require_once("../DAO/veiculoDAO.php");
	$message = false;
	$veiculo_id = false;

	if($_GET){
		if(isset($_GET["message"])){
			$message = $_GET["message"];
		}
		if(isset($_GET["departamento_id"])){
			$veiculo_id = $_GET["veiculo_id"];
		}
	}

	$rows = (new AgendamentoDAO())->veiculos($veiculo_id);

	$veiculoResult = (new VeiculoDAO())->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<title>Recursos Humanos</title>
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
				<h1>Agendamentos</h1>
			</div>
			<div class="col d-flex justify-content-end align-items-center">
				<a class="btn btn-success" href="add.php">Agendar nova revisão</a>
			</div>
		</div>

        <form action="" method="get">
			<div class="input-group mb-3">
				<select 
					class="form-control" 
					id="veiculo_id" 
					name="veiculo_id">
					<option value></option>

						<?php foreach($veiculoResult as $veiculo): ?>
							
							<option 
								value="<?=$veiculo["id"]?>"
								<?= $veiculo["id"] == $veiculo_id ? 'selected' : '';?>
							>
								<?=$veiculo["marca"]?>
							</option>
						<?php endforeach; ?>						
				</select>
				<button class="btn btn-outline-info" type="submit">
					Pesquisar
				</button>
			</div>
		</form>

        <table class="table table-hover table-dark">
			<thead class="table-dark">
				<tr>
					<th>Identificador</th>
					<th>Horário</th>
					<th>Local</th>
					<th>Veículo</th>
					<th></th>
				</tr>
			</thead>
            <tbody>
				<?php foreach($rows as $agendamento): ?>
					<tr>
						<td>
							<?=$agendamento["registro"]?>
						</td>
						<td>
							<?=$agendamento["horario"]?>
						</td>
						<td>
							<?=$agendamento["local"]?>
						</td>
						<td>
							<?=$agendamento["veiculos"]?>
						</td>
						<td>
							<div class="btn-group" role="group">
								<button 
									type="button" 
									class="btn btn-outline-danger"
									onclick="confirmDelete(<?=$agendamento['registro']?>)">
									Excluir
								</button>
								<a 
									href="edit.php?registro=<?=$agendamento["registro"]?>" 
									class="btn btn-outline-warning">
									Editar
								</a>
								<a 
									href="view.php?registro=<?=$agendamento["registro"]?>" 
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
	const confirmDelete = (agendamentoRegistro) => {
		const response = confirm("Deseja realmente excluir este agendamento?")
		if(response){
			window.location.href = "delete.php?registro=" + agendamentoRegistro
		}
	}
</script>
</html>