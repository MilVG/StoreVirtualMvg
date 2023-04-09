<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function loginUser(string $usuario, string $password){
			$this->strUsuario =$usuario;
			$this->strPassword =$password;
			$sql = "SELECT id_usuario,status FROM usuario WHERE correo ='$this->strUsuario' and clave ='$this->strPassword' and status !=0";
			
			$request = $this->select($sql);
			return $request;
		}
		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			$sql= "SELECT u.id_usuario,
						  u.dni,
						  u.nombre,
						  u.apellidos,
						  u.telefono,
						  u.user,
						  u.correo,
						  u.ruc,
						  u.direccion,
						  r.id_tipous,r.rol,
						  u.status
					FROM usuario u
					INNER JOIN tipousuario r
					ON u.id_tipous = r.id_tipous
					WHERE u.id_usuario = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}
		public function getUserEmail(string $strEmail){
			$this->strUsuario = $strEmail;
			$sql = "SELECT id_usuario,nombre,apellidos,status FROM usuario WHERE 
					correo = '$this->strUsuario' and  
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}
		public function setTokenUser(int $idusuario, string $token){
			$this->intIdUsuario = $idusuario;
			$this->strToken = $token;
			$sql = "UPDATE usuario SET token = ? WHERE id_usuario = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT id_usuario FROM usuario WHERE 
					correo = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idUsuario, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strPassword = $password;
			$sql = "UPDATE usuario SET clave = ?, token = ? WHERE id_usuario = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
 ?>