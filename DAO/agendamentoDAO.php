<?php

require_once("../Conexao.php");

class AgendamentoDAO{

    private $connection;

     /**
     * carDAO constructor.
     * @throws Exception
     */
	public function __construct()
    {
		$this->connection = (new Conexao())->getConnection();
	}

     /**
     * close db connection
     */
	public function __destruct()
    {
        $this->closeConnection();
    }

    /**
     * @return bool
     */
    public function closeConnection()
    {
        return $this->connection->close();
    }

    public function Adicionaragendamento($horario, $local, $veiculo_id){

        $query = "INSERT INTO agendamentos (horario, local, veiculo_id) values ('$horario', '$local', '$veiculo_id')";

        $result = $this->connection->query($query);
        
        return $result;
    }

    function index(){

        $result = $this->connection->query("select * from agendamentos");

        $list = [];
        while($record = mysqli_fetch_array($result))
            $list[] = $record;

        return $list;
	}

    public function find($id){
        //query anterior: $query = "SELECT * FROM funcionarios WHERE registro=$id";    
        $query = "SELECT a.*, v.marca, v.modelo as veiculos FROM agendamentos a INNER JOIN veiculos v on v.id = a.veiculo_id WHERE a.registro=$id" ;
        $result = $this->connection->query($query);



        $list = [];
        while($record = mysqli_fetch_array($result))
            $list[] = $record;

        return isset($list[0]) ? $list[0]:null;

    }

    function update($registro, $horario, $local, $veiculo_id){

        $query = "UPDATE agendamentos SET horario='$horario', local='$local', veiculo_id=$veiculo_id WHERE registro=$registro";

        //UPDATE funcionarios SET nome='Pinho', departamento_id=4, cargo='Ger' WHERE registro=5;

        return $this->connection->query($query);
	}

    function remove($id){
		$r = $this->connection->query("delete from agendamentos where registro=$id");

        return $r;
	}

    public function veiculos( $id = null )
    {
        $query = "SELECT a.*, v.marca, v.modelo as veiculos FROM agendamentos a INNER JOIN veiculos v on v.id = a.veiculo_id";

        if($id){
            $query .= " WHERE v.id = $id";
        }

        $result = $this->connection->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

}
?>