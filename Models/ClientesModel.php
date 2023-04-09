<?php 

    class ClientesModel extends Mysql
	{
		private $intIdCliente;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $intTipoId;
		private $intRuc;
		private $strRSocial;
		private $strDirFiscal;
		private $intIdUser;
		

		public function __construct()
		{
			parent::__construct();
		}

        public function insertCliente(int $identificacion,string $nombre, string $apellido,int $telefono,string $email,string $password,int $rol, int $ruc,string $RazonSocial,string $DirFiscal){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $rol;
			$this->intRuc = $ruc;
			$this->strRSocial = $RazonSocial;
			$this->strDirFiscal=$DirFiscal;
			$return = 0;

			$sql = "SELECT * FROM usuario WHERE 
					correo = '{$this->strEmail}' or dni = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO usuario(dni,nombre,apellidos,telefono,correo,clave,id_tipous,ruc,razonSocial,direccion) 
								  VALUES(?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
								$this->intTipoId,
        						$this->intRuc,
        						$this->strRSocial,
								$this->strDirFiscal);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = false;
			}
	        return $return;
            
        }
		public function selectClientes()
		{
			$sql = "SELECT u.id_usuario,u.dni,u.nombre,u.apellidos,u.telefono,u.correo,u.status
					FROM usuario u
					WHERE id_tipous = 3 and status !=0";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectCliente(int $idCliente){
			$this->intIdCliente = $idCliente;
			$sql = "SELECT u.id_usuario,u.dni,u.nombre,u.apellidos,u.telefono,u.correo,u.ruc,u.razonSocial,u.direccion, DATE_FORMAT(u.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM usuario u
					WHERE u.id_usuario = $this->intIdCliente";
			$request = $this->select($sql);
			return $request;
		}
		public function updateCliente(int $idCliente,int $identificacion,string $nombre, string $apellido,int $telefono,string $email,string $password, int $ruc,string $RazonSocial,string $DirFiscal){

			$this->intIdCliente = $idCliente;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intRuc = $ruc;
			$this->strRSocial = $RazonSocial;
			$this->strDirFiscal=$DirFiscal;

			$sql = "SELECT * FROM usuario WHERE (correo = '{$this->strEmail}' AND id_usuario != $this->intIdCliente)
										  OR (dni = '{$this->strIdentificacion}' AND id_usuario != $this->intIdCliente)";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE usuario SET dni=?, nombre=?, apellidos=?, telefono=?, correo=?, clave=?, ruc=?, razonSocial=?,direccion=? 
							WHERE id_usuario = $this->intIdCliente ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
									$this->intRuc,
        							$this->strRSocial,
									$this->strDirFiscal);
				}else{
					$sql = "UPDATE usuario SET dni=?, nombre=?, apellidos=?, telefono=?, correo=?, ruc=?, razonSocial=?,direccion=?  
							WHERE id_usuario = $this->intIdCliente ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intRuc,
        							$this->strRSocial,
									$this->strDirFiscal);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = false;
			}
			return $request;
		
		}

		public function deleteCliente(int $intIdUsuario)
		{
			$this->intIdUser = $intIdUsuario;
			$sql = "UPDATE usuario SET status = ? WHERE id_usuario = $this->intIdUser ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
    }

?>