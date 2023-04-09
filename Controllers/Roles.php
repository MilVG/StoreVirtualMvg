
<?php 

	
	class Roles extends Controllers{



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



		public function roles()

		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location:'.base_url()."Dashboard");
			}
			$data['page_id']=4;

			$data['tag_page']="Roles - Admin";

			$data['page_title']="Roles - Admin";

			$data['page_name']="roles";

			$this->views->getView($this,"roles",$data);

		}

		public function getRoles(){

			if ($_SESSION['permisosMod']['r']){
				$btnView ='';
				$btnEdit='';
				$btnDel = '';
				$arrData = $this->model->selectRoles();

				for($i=0;$i<count($arrData);$i++){

					if ($arrData[$i]['status']==1) {

						$arrData[$i]['status']= '<span class="badge badge-success">activo</span>';

					}else {

						$arrData[$i]['status']='<span class="badge badge-danger">inactivo</span>';

					}

					
					if($_SESSION['permisosMod']['u']){

						$btnView = '<button type="button" class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['id_tipous'].')" title="Permisos"><i class="fas fa-key"></i></button>';

						$btnEdit = '<button type="button" class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['id_tipous'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDel = '<button type="button" class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['id_tipous'].')" title="Eliminar"><i class="fas fa-trash"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView." ".$btnEdit." ".$btnDel.'</div>';

					

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();

		}

		public function getSelectRoles()

		{

			$htmlOptions = "";

			$arrData = $this->model->selectRoles();

			if(count($arrData) > 0 ){

				for ($i=0; $i < count($arrData); $i++) { 

					if($arrData[$i]['status'] == 1 ){

					$htmlOptions .= '<option value="'.$arrData[$i]['id_tipous'].'">'.$arrData[$i]['rol'].'</option>';

					}

				}

			}

			echo $htmlOptions;

			die();		

		}

		public function getRol(int $idrol){


			if ($_SESSION['permisosMod']['r']){
				$intIdrol=intval(strClean($idrol));

				if ($intIdrol >0) {

					$arrData =$this->model->selectRol($intIdrol);

					if (empty($arrData)) {

						$arrResponse = array('status' => false,'msg' =>'Datos no encontrados');

					}else{

						$arrResponse = array('status' => true, 'data' =>$arrData);



					}

					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

				}
			}

			die();

		}



		public function setRol(){
			if ($_SESSION['permisosMod']['w']){
				$intIdrol= intval($_POST['idRol']);
				$strRol = strClean($_POST['txtnombre']);
				$strStatus = intval($_POST['liststatus']);

				if ($intIdrol ==0) {
					$request_rol = $this->model->insertRol($strRol,$strStatus);
					$option=1;

				} else {
					$request_rol = $this->model->updateRol($intIdrol,$strRol,$strStatus);
					$option=2;
				}

				if ($request_rol > 0) {
					if ($option == 1) {
						$arrResponse = array('status'=>true,'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status'=>true,'msg' => 'Datos Actualizados correctamente.');
					}

				}else if ($request_rol == false) {
					$arrResponse = array('status'=>false,'msg'=>'¡Atención El Rol ya existe!.');
				}else {
					$arrResponse = array('status'=>false,'msg'=>'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}

			die();

		}



		public function delRol(){

			if ($_POST) {
				if ($_SESSION['permisosMod']['d']){
					$intIdrol = intval($_POST['idrol']);

					$requestDelete = $this->model->deleteRol($intIdrol);

					if ($requestDelete == 'ok') {

						$arrResponse = array('status' => true, 'msg' =>'Se ha eliminado el Rol');
					}elseif ($requestDelete == false) {
						$arrResponse = array('status' => false,'msg' =>'No es posible eliminar un Rol asociado a usuarios.');
					}else {

						$arrResponse = array('status' => false,'msg' => 'Error al eliminar el Rol');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}

			die();

		}



	}



 ?>