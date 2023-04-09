<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
        private $strUsuario;
		private $strDireccion;
		private $intDni;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, string $usuario, int $status){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
            $this->strUsuario = $usuario;
			$return = 0;

			$sql = "SELECT * FROM usuario WHERE 
					correo = '{$this->strEmail}' or dni = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO usuario(dni,nombre,apellidos,telefono,correo,user,clave,id_tipous,status) 
								  VALUES(?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
                                 $this->strUsuario,
        						$this->strPassword,
        						$this->intTipoId,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = false;
			}
	        return $return;
		}

		public function selectUsuarios()
		{
			$whereAdmin="";
			if ($_SESSION['idUser'] != 1) {
				$whereAdmin ="and u.id_usuario != 1";
			}
			$sql = "SELECT u.id_usuario,u.dni,u.nombre,u.apellidos,u.telefono,u.correo,u.status,r.id_tipous,r.rol 
					FROM usuario u
					INNER JOIN tipousuario r
					ON u.id_tipous = r.id_tipous
					WHERE u.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectUsuario(int $idusuario){
			$this->intIdUsuario = $idusuario;
			$sql = "SELECT u.id_usuario,u.dni,u.nombre,u.apellidos,u.telefono,u.correo,u.ruc,u.direccion,r.id_tipous,r.rol,u.status,u.user, DATE_FORMAT(u.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM usuario u
					INNER JOIN tipousuario r
					ON u.id_tipous = r.id_tipous
					WHERE u.id_usuario = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid,string $usuario, int $status){

			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$this->strUsuario =$usuario;

			$sql = "SELECT * FROM usuario WHERE (correo = '{$this->strEmail}' AND id_usuario != $this->intIdUsuario)
										  OR (dni = '{$this->strIdentificacion}' AND id_usuario != $this->intIdUsuario) 
										  OR (user ='{$this->strUsuario}' AND id_usuario != $this->intIdUsuario)";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE usuario SET dni=?, nombre=?, apellidos=?, telefono=?, correo=?, clave=?, id_tipous=?, status=?,user=? 
							WHERE id_usuario = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
	        						$this->intTipoId,
	        						$this->intStatus,
									$this->strUsuario);
				}else{
					$sql = "UPDATE usuario SET dni=?, nombre=?, apellidos=?, telefono=?, correo=?, id_tipous=?, status=?,user=? 
							WHERE id_usuario = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intTipoId,
	        						$this->intStatus,
									$this->strUsuario,
								);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = false;
			}
			return $request;
		
		}
		public function deleteUsuario(int $intIdUsuario)
		{
			$this->intIdUser = $intIdUsuario;
			$sql = "UPDATE usuario SET status = ? WHERE id_usuario = $this->intIdUser ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $nombre,string $apellidos, int $dni, int $telefono,string $direccion){

			$this->intIdUsuario = $idUsuario;
			$this->strNombre = $nombre;
			$this->strApellido = $apellidos;
			$this->intDni =$dni;
			$this->intTelefono = $telefono;
			$this->strDireccion =$direccion;

			$sql = "UPDATE usuario SET nombre=?, apellidos=?,dni=?, telefono=?,direccion=?
						WHERE id_usuario = $this->intIdUsuario ";
				$arrData = array($this->strNombre,
								$this->strApellido,
								$this->intDni,
								$this->intTelefono,
								$this->strDireccion);
			$request = $this->update($sql,$arrData);
		    return $request;
		}

	}
 ?>