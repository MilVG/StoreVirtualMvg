<?php 
	
	class Mysql extends Conexion{
		private $conexion;
		private $srtquery;
		private $arrvalues;

		function __construct(){

			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->conectar();

		}

		public function insert(string $query, array $arrvalues){

			$this->srtquery=$query;
			$this->arrvalues = $arrvalues;

			$insert = $this->conexion->prepare($this->srtquery);

			$resInsert = $insert->execute($this->arrvalues);

			if ($resInsert) {
				$lastInsert = $this->conexion->lastInsertId();

			}else{
				$lastInsert =0;
			}
			return $lastInsert;
		}

		public function select (string $query){

			$this->srtquery = $query;
			$result = $this->conexion->prepare($this->srtquery);
			$result->execute();
			$data = $result->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		public function select_all(string $query){
			$this->srtquery = $query;
			$result = $this->conexion->prepare($this->srtquery);
			$result->execute();
			$data = $result->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function update(string $query , array $arrvalues){

			$this->srtquery = $query;
			$this->arrvalues = $arrvalues;

			$update= $this->conexion->prepare($this->srtquery);
			$resExecute=$update->execute($this->arrvalues);

			return $resExecute;

		}
		public function delete(string $query){

			$this->srtquery = $query;
			$result = $this->conexion->prepare($this->srtquery);
			$del=$result->execute();
			return $del;
		}

	}

 ?>