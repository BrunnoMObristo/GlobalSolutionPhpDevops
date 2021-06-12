<?php  
	require_once("../DAO/agendamentoDAO.php");

    $error = false;

    if(!$_GET || !$_GET["registro"]){
        header('Location: index.php?message=Nº Registro do agendamento não informado!!');
        die();
    }

    $agendamentoRegistro = $_GET["registro"];

    try {        
		$result = (new agendamentoDAO())->remove($agendamentoRegistro);
       
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $message = ($result && !$error) ? "Agendamento excluido com sucesso." : "Erro ao excluir o agendamento.";
    header("Location: index.php?message=$message");
    die();

