<?php 

	class Clientes extends Controllers{

		public function __construct(){
			sessionStar();
			parent::__construct();
			// session_start();
			// session_regenerate_id(true);
			if (empty($_SESSION['login'])) {
				header('location:'.base_url()."Login");
			}
			getPermisos(3);
		}

		public function Clientes($params)
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location:'.base_url()."Dashboard");
			}
			$data['tag_page']="Clientes";
			$data['page_title']="CLIENTES";
			$data['page_name']="clientes";
            $data['page_function_clientes']="function_clientes.js";
			$this->views->getView($this,"clientes",$data);
		}
		public function setCliente(){
			if($_POST){
				
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['txtRuc']) || empty($_POST['txtRSocial']) || empty($_POST['txtDireccionFiscal']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idCliente = intval($_POST['idCliente']);
					$strIdentificacion = intval(strClean($_POST['txtIdentificacion']));
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intRuc = intval(strClean($_POST['txtRuc']));
					$strRSocial = strClean($_POST['txtRSocial']);
					$strDirFiscal = strClean($_POST['txtDireccionFiscal']);
					$intTipoId = 3;

					$request_user ="";
					if($idCliente == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
						$strPasswordEncript = hash("SHA256",$strPassword);

						if ($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertCliente($strIdentificacion,
																			$strNombre, 
																			$strApellido, 
																			$intTelefono, 
																			$strEmail,
																			$strPasswordEncript,
																			$intTipoId, 
																			$intRuc, 
																			$strRSocial,
																			$strDirFiscal );
						}
						
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);

						if ($_SESSION['permisosMod']['u']){
							$request_user = $this->model->updateCliente($idCliente,
																	$strIdentificacion, 
																	$strNombre,
																	$strApellido, 
																	$intTelefono, 
																	$strEmail,
																	$strPassword,
																	$intTipoId, 
																	$intRuc, 
																	$strRSocial,
																	$strDirFiscal);
						}
						

					}

					if($request_user > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							$nombreCliente = $strNombre.''.$strApellido;
							$dataUsuario = array('nombreUsuario' => $nombreCliente,
											 'email' => $strEmail,
											 'password'=>$strPassword,
											 'asunto' => 'Bienvenido a tu tienda en línea');
							sendEmail($dataUsuario,'email_Bienvenida');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == false){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el correo ó Dni ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function getClientes()
		{
			if ($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectClientes();
		
				for ($i=0; $i < count($arrData); $i++) {
					$btnView ='';
					$btnEdit='';
					$btnDel = '';

					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewCliente" onClick="fntViewCliente('.$arrData[$i]['id_usuario'].')" title="Ver cliente"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditCliente" onClick="fntEditCliente('.$arrData[$i]['id_usuario'].')" title="Editar cliente"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDel = '<button class="btn btn-danger btn-sm btnDelCliente" onClick="fntDelCliente('.$arrData[$i]['id_usuario'].')" title="Eliminar cliente"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView." ".$btnEdit." ".$btnDel.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function getCliente($iduser){
			if ($_SESSION['permisosMod']['r']){
				$idusuario = intval($iduser);
				if($idusuario > 0)
				{
					$arrData = $this->model->selectCliente($idusuario);
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
		public function delCliente()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']){
					$intIdUsuario = intval($_POST['idUsuario']);
					$requestDelete = $this->model->deleteCliente($intIdUsuario);
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
		
    }
?>