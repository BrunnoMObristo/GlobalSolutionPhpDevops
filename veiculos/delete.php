<?php  
	
    require("../DAO/veiculoDAO.php");
    

    $veiculoId = $_GET["id"];

    try{
        $resultado = (new VeiculoDAO)->Deletar($veiculoId);
    } catch(Exception $erro){
        $error = $erro->getMessage();
    }
    header("Location: index.php?message=$message");
?>

