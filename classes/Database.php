<?php 

class Db{ 
	private  $host ;
	private  $user ;
	private  $pass ;
	private  $db ;

	protected function connect($host,$user,$pass,$db){
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;

		$con = new mysqli($this->host,$this->user,$this->pass,$this->db);
		return $con;
	}
}

?>