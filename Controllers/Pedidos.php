<?php 
    class Pedidos extends Controllers{

		public function __construct(){
			sessionStar();
			parent::__construct();
			// session_start();
			// session_regenerate_id(true);
			if (empty($_SESSION['login'])) {
				header('location:'.base_url()."Login");
			}
			getPermisos(5);
		}

		public function Pedidos($params)
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location:'.base_url()."Dashboard");
			}
			$data['tag_page']="pedidos";
			$data['page_title']="PEDIDOS";
			$data['page_name']="pedidos";
            $data['page_function_pedidos']="function_pedidos.js";
			$this->views->getView($this,"pedidos",$data);
		}
        public function getPedidos()
		{
			if ($_SESSION['permisosMod']['r']){
				$iduser ="";
				if ($_SESSION['userData']['id_tipous'] == 3) {
					$iduser = $_SESSION['userData']['id_usuario'];
				}
				$arrData = $this->model->selectPedidos($iduser);
				for ($i=0; $i < count($arrData); $i++) {
					$btnView ='';
					$btnEdit='';
					$btnDel = '';
					if($arrData[$i]['status'] == 'completo')
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Completo</span>';
					}else if($arrData[$i]['status'] == 'Pendiente'){
						$arrData[$i]['status'] = '<span class="badge badge-secondary">Pendiente</span>';
					}else{
                        $arrData[$i]['status'] = '<span class="badge badge-danger">Incompleto</span>';
                    }

                    $arrData[$i]['transaccion']=$arrData[$i]['refrenciacobro'];
                    if($arrData[$i]['transaccion'] != ""){
                        $arrData[$i]['transaccion']=$arrData[$i]['idtransaccionpaypal'];
                    }

					$arrData [$i]['monto'] = SMONEY.' '.formatMoney($arrData[$i]['monto']);

					if ($_SESSION['permisosMod']['r']) {

						$btnView .= '<a title="Ver Detalle" href="'.base_url().'pedidos/orden/'.$arrData[$i]['id_pedidos']. '" target="_blanck" class="btn btn-info btn-sm"><i class="far fa-eye"></i> </a> 
						
						<button class="btn btn-danger btn-sm " onClick="fntViewPDF('.$arrData[$i]['id_pedidos']. ')" title="Generar PDF"><i class="far fa-file-pdf"></i></button> ';

						if ($arrData[$i]['idtipopago']== 1) {
							$btnView.='<button class="btn btn-info btn-sm " onClick="fntViewInfo('.$arrData[$i]['id_pedidos']. ')" title="Ver Transacción"><i class="fab fa-paypal"></i></button>';
						} else {
							$btnView.= '<button class="btn btn-secondary btn-sm " disabled=""><i class="fab fa-paypal"></i></button>';
						}
						
					
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditPedido" onClick="fntEditPedido('.$arrData[$i]['id_pedidos'].')" title="Editar Pedido"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDel = '<button class="btn btn-danger btn-sm btnDelPedido" onClick="fntDelPedido('.$arrData[$i]['id_pedidos'].')" title="Eliminar Pedido"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView." ".$btnEdit." ".$btnDel.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function orden(){
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location:'.base_url()."Dashboard");
			}
			$data['tag_page']="pedido";
			$data['page_title']="PEDIDOS";
			$data['page_name']="pedido";
			$this->views->getView($this,"orden",$data);
		}
    }

?>