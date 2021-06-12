<?php

class Conexao {
	
	private $servername = "localhost";
	private $database = "bilen";
	private $username = "root";
	private $password = "labfiap#2019$";
	
	private $connect = null;

    /**
     * get mysql connection
     *
     * @return mysqli
     * @throws Exception
     */
	function getConnection(){

		$this->connect = new mysqli(
		    $this->servername,
            $this->username,
            $this->password,
            $this->database
        );
		
		if (empty($this->connect) || ($this->connect->connect_errno)){
		    throw new Exception( 'Connection Failed, '. $this->connect->connect_errno.' --Msg:'.mysqli_connect_error() );
		}

		return $this->connect;
	}

    /**
     * close connection
     *
     * @return bool
     */
	function closeConnection(){
		return isset($this->connect) && mysqli_close($this->connect);
	}
}
?>