<?php

require_once("../Conexao.php");

class VeiculoDAO{

    private $conexao;
    
    public function __construct()
    {
        $this->connection = (new Conexao())->getConnection();
    }

    function Adicionar($marca, $modelo, $ano){

        $query = "INSERT INTO veiculos (marca,modelo,ano) 
        VALUES ('$marca', '$modelo', '$ano')";

        $result = $this->connection->query($query);

		return $result;
	}

    function Index(){

        $result = $this->connection->query("select * from veiculos");

        $list = [];
        while($record = mysqli_fetch_array($result))
            $list[] = $record;

        return $list;
	}

    public function FindById($veiculoId){
        $result = $this->connection->query("SELECT * FROM veiculos WHERE id=$veiculoId");

        $lista = [];
        while($registro = mysqli_fetch_array($result))
            $lista[] = $registro;

        return isset($lista[0]) ? $lista[0]:null;
    }

    function Atualizar($veiculoid, $marca, $modelo, $ano){

        $query = "UPDATE veiculos SET marca='$marca', modelo='$modelo', ano='$ano' WHERE id=$veiculoid";

        return $this->connection->query($query);
	}

    function Deletar($veiculoid){
		$resultado = $this->connection->query("delete from veiculos where id=$veiculoid");

        return $resultado;
	}
}