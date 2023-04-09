<?php 
     class PedidosModel extends Mysql{

		public function __construct(){
			
			parent:: __construct();
		}

        public function selectPedidos($iduser = NULL){
            $where ="";
            if ($iduser != null) {
                $where = "AND p.id_usuario = ".$iduser;
            }
            $sql = "SELECT p.id_pedidos,
                           t.idtipopago,
                           p.idtransaccionpaypal,
                           p.referenciacobro,
                           p.fecha,
                           p.monto,
                           t.tipopago,
                           p.status
                    FROM pedidos p
                    INNER JOIN tipopago t
                    ON p.tipopagoid = t.idtipopago
                    WHERE p.status != 'incompleto' $where";
                    $request = $this->select_all(($sql));
            return $request;
        }
     }

?>