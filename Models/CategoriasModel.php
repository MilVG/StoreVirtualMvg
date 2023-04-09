<?php 

     class CategoriasModel extends Mysql
	{
        private $intIdcategoria;
        private $strCategoria;
        private $strDescripcion;
        private $intStatus;
        private $strPortada;
		private $strRuta;
	
		public function __construct()
		{
			parent::__construct();
		}

        public function insertCategoria(string $nombre, string $descripcion, string $portada,string $ruta,int $status) {
            $return = 0;
            $this->strCategoria= $nombre;
            $this->strDescripcion= $descripcion;
            $this->strPortada = $portada;
			$this->strRuta = $ruta;
            $this->intStatus= $status;

            
            $sql= "SELECT * FROM categoria WHERE nombre ='{$this->strCategoria}'";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $query_insert ="INSERT INTO categoria(nombre,descripcion,portadaimg,ruta,status) VALUES (?,?,?,?,?)";
                $arrData = array($this->strCategoria,
                                $this->strDescripcion,
                                $this->strPortada,
								$this->strRuta,
                                $this->intStatus);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }
        public function selectCategorias()
		{
			$sql = "SELECT * FROM categoria 
                    WHERE status !=0";
			$request = $this->select_all($sql);
			return $request;
		}
        public function selectCategoria(int $idCategoria){
			$this->intIdcategoria = $idCategoria;
			$sql = "SELECT c.id_Categoria,c.nombre,c.descripcion,c.status,c.portadaimg, DATE_FORMAT(c.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM categoria c
					WHERE c.id_Categoria = $this->intIdcategoria";
			$request = $this->select($sql);
			return $request;
		}
		public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada,string $ruta, int $status){
			$this->intIdcategoria = $idcategoria;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->strRuta =$ruta;
			$this->intStatus = $status;

			$sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}' AND id_Categoria != $this->intIdcategoria";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE categoria SET nombre = ?, descripcion = ?, portadaimg = ?,ruta=?, status = ? WHERE id_Categoria = $this->intIdcategoria ";
				$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->strPortada,
								 $this->strRuta, 
								 $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = false;
			}
		    return $request;			
		}
		public function deleteCategoria(int $idcategoria)
		{
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT  * FROM producto WHERE id_Categoria = $this->intIdcategoria";
			$request =$this->select_all($sql);
			if (empty($request)) {
				$sql = "UPDATE categoria SET status = ? WHERE id_Categoria = $this->intIdcategoria ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);

				if ($request) {
					$request = 'ok';
				} else {
					$request ='error';
				}
			} else {
				$request = 'exist';
			}
			
			return $request;
		}
    }

?>