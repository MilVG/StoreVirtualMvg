<?php 

	class Usuarios extends Controllers{

		public function __construct(){
			sessionStar();
			parent::__construct();
			// session_start();
			// session_regenerate_id(true);
			if (empty($_SESSION['login'])) {
				header('location:'.base_url()."Login");
			}
			getPermisos(2);
		}

		public function Usuarios($params)
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location:'.base_url()."Dashboard");
			}
			$data['tag_page']="Usuarios";
			$data['page_title']="USUARIOS";
			$data['page_name']="usuarios";
			$this->views->getView($this,"usuarios",$data);
		}
		public function setUsuario(){
			if($_POST){
				
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) || empty($_POST['txtUsuario']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idUsuario = intval($_POST['idUsuario']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$strUsuario = strClean($_POST['txtUsuario']);
					$intStatus = intval(strClean($_POST['listStatus']));
					$request_user ="";
					if($idUsuario == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);

						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertUsuario($strIdentificacion,
																			$strNombre, 
																			$strApellido, 
																			$intTelefono, 
																			$strEmail,
																			$strPassword, 
																			$intTipoId, 
																			$strUsuario,
																			$intStatus );
						}
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if($_SESSION['permisosMod']['u']){
							$request_user = $this->model->updateUsuario($idUsuario,
																	$strIdentificacion, 
																	$strNombre,
																	$strApellido, 
																	$intTelefono, 
																	$strEmail,
																	$strPassword, 
																	$intTipoId,
																	$strUsuario,
																	$intStatus);
						}

					}

					if($request_user > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == false){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email,Dni ó usuario ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getUsuarios()
		{
			if ($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectUsuarios();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView ='';
					$btnEdit='';
					$btnDel = '';
					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['id_usuario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['id_tipous'] == 1) ||
								($_SESSION['userData']['id_tipous'] == 1 and $arrData[$i]['id_tipous'] != 1) ){
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['id_usuario'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
						}else {
							$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
						}
					}
					if($_SESSION['permisosMod']['d']){
						if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['id_tipous'] == 1) ||
							($_SESSION['userData']['id_tipous'] == 1 and $arrData[$i]['id_tipous'] != 1) and
							($_SESSION['userData']['id_usuario'] != $arrData[$i]['id_usuario'] )){
						$btnDel = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['id_usuario'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
						}else {
							$btnDel = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
						}
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView." ".$btnEdit." ".$btnDel.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function getUsuario($iduser){
			if ($_SESSION['permisosMod']['r']){
				$idusuario = intval($iduser);
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuario($idusuario);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function delUsuario()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdUsuario = intval($_POST['idUsuario']);
					$requestDelete = $this->model->deleteUsuario($intIdUsuario);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function Perfil(){
			$data['tag_page']="View-Perfil";
			$data['page_title']="PERFIL";
			$data['page_name']="perfil";
			$data['page_function_general']="configPerfil.js";
			$this->views->getView($this,"perfil",$data);
		}
		public function Config()
		{
			$data['tag_page']="config-perfil";
			$data['page_title']="CONFIG";
			$data['page_name']="config";
			$data['page_function_general']="configPerfil.js";
			$this->views->getView($this,"config",$data);
			
		}
		public function upInfoPrivate(){
			if($_POST){

				if(empty($_POST['txtnombre']) || empty($_POST['txtapellidos']) || empty($_POST['txtdni']) || empty($_POST['txtdireccion']) || empty($_POST['txttelefono']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$idUsuario = $_SESSION['idUser'];
					$strNombre = ucwords(strClean($_POST['txtnombre']));
					$strApellidos = ucwords(strClean($_POST['txtapellidos']));
					$intdni = intval(strClean($_POST['txtdni']));
					$inttelefono = intval(strClean($_POST['txttelefono']));
					$strdireccion = strClean($_POST['txtdireccion']);

					$request_user = $this->model->updatePerfil($idUsuario,
																$strNombre, 
																$strApellidos, 
																$intdni,
																$inttelefono,
																$strdireccion);
					
					if ($request_user) {
						sessionUser($_SESSION['idUser']);
						$arrResponse = array("status" => true, "msg" => 'Datos Actualizados Correctamente.');
					} else {
						$arrResponse = array("status" => false, "msg" => 'No es Posible Almacenar los Datos.');
					}
					
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
				die();
			}

			

		}
	}

 ?>