<?php 

    class Categorias extends Controllers{

		public function __construct(){
			sessionStar();
			parent::__construct();
			// session_start();
			// session_regenerate_id(true);
			if (empty($_SESSION['login'])) {
				header('location:'.base_url()."Login");
			}
			getPermisos(6);
		}

		public function Categorias($params)
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location:'.base_url()."Dashboard");
			}
			$data['tag_page']="Categorias";
			$data['page_title']="CATEGORIAS";
			$data['page_name']="categorias";
            $data['page_function_categorias']="function_categorias.js";
			$this->views->getView($this,"categorias",$data);
		}
		public function setCategorias(){
		

			if ($_POST) {
				if(empty($_POST['txtnombre']) || empty($_POST['txtDescripcion']) || empty($_POST['liststatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCategoria= intval($_POST['idCategorias']);
					$strCategoria= strClean($_POST['txtnombre']);
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strStatus = intval($_POST['liststatus']);

					$ruta = strtolower(clear_cadena($strCategoria));
					$ruta = str_replace(" ", "-", $ruta);

					$foto = $_FILES['foto'];
					$nombre_foto = $foto['name'];
					$type = $foto['type'];
					$url_temp = $foto['tmp_name'];
					$fecha = date('ymd');
					$hora = date('hms');
					$imgPortada ='portada_categoria.png';

					if ($nombre_foto != '') {
						$imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
					}
					if ($intIdCategoria ==0) {
						if ($_SESSION['permisosMod']['w']){
							$request_categoria = $this->model->insertCategoria($strCategoria,$strDescripcion,$imgPortada,$ruta, $strStatus);
							$option=1;
						}
					} else {
						if ($_SESSION['permisosMod']['u']){
							if($nombre_foto == ''){
								if($_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0 ){
									$imgPortada = $_POST['foto_actual'];
								}
							}
							$request_categoria = $this->model->updateCategoria($intIdCategoria,$strCategoria,$strDescripcion,$imgPortada,$ruta, $strStatus);
							$option=2;
						}
					}

					if ($request_categoria > 0) {
						if ($option == 1) {
							$arrResponse = array('status'=>true,'msg' => 'Datos guardados correctamente.');
							if($nombre_foto !=''){uploadImage($foto,$imgPortada);}
						} else {
							$arrResponse = array('status'=>true,'msg' => 'Datos Actualizados correctamente.');

							if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }

							if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png')
								|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){
								deleteFile($_POST['foto_actual']);
							}
						}

					}else if ($request_categoria == false) {
						$arrResponse = array('status'=>false,'msg'=>'¡Atención La Categoria ya existe!.');
					}else {
						$arrResponse = array('status'=>false,'msg'=>'No es posible almacenar los datos.');
					}

				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function getCategorias()
		{
			if ($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectCategorias();
		
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
						$btnView = '<button class="btn btn-info btn-sm btnViewCategoria" onClick="fntViewCategoria('.$arrData[$i]['id_Categoria'].')" title="Ver categoria"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditCategoria" onClick="fntEditCategoria('.$arrData[$i]['id_Categoria'].')" title="Editar categoria"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDel = '<button class="btn btn-danger btn-sm btnDelCategoria" onClick="fntDelCategoria('.$arrData[$i]['id_Categoria'].')" title="Eliminar categoria"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView." ".$btnEdit." ".$btnDel.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function getCategoria($idcategoria){
			if ($_SESSION['permisosMod']['r']){
				$intIdCategoria = intval($idcategoria);
				if($intIdCategoria > 0)
				{
					$arrData = $this->model->selectCategoria($intIdCategoria);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrData['url_portada'] = media().'img/uploads/'.$arrData['portadaimg'];
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function delCategoria()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']){
					$intIdCategoria = intval($_POST['idCategoria']);
					$requestDelete = $this->model->deleteCategoria($intIdCategoria);
					if($requestDelete =='ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoria');
					}else if($requestDelete =='exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoria con productos asociados.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Error al eliminar la categoria');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getSelectCategorias(){
			$htmlOptions ="";
			$arrData = $this->model->selectCategorias();
			if (count($arrData) >0) {
				for ($i=0; $i < count($arrData) ; $i++) { 
					if ($arrData[$i]['status'] == 1) {
						$htmlOptions .= '<option value="'.$arrData[$i]['id_Categoria'].'">'.$arrData[$i]['nombre'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}
    }

?>