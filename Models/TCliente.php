<?php 
require_once("Libraries/Core/Mysql.php");
    trait TCliente{
        private $con;
        private $intIdCliente;
        private $strNombre;
        private $strApellido;
        private $intTelefono;
        private $strEmail;
        private $strToken;
        private $strPassword;
        private $intTipoId;
        private $intIdTransaccion;

        public function insertCliente( string $nombre, string $apellido, int $telefono, string $email, string $password, int $rol)
        {

            $this->con = new Mysql();
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->intTelefono = $telefono;
            $this->strEmail = $email;
            $this->strPassword = $password;
            $this->intTipoId = $rol;
            $return = 0;

            $sql = "SELECT * FROM usuario WHERE 
                        correo = '{$this->strEmail}' ";
            $request = $this->con->select_all($sql);

            if (empty($request)) {
                $query_insert  = "INSERT INTO usuario(nombre,apellidos,telefono,correo,clave,id_tipous) 
                                    VALUES(?,?,?,?,?,?)";
                $arrData = array(
                    $this->strNombre,
                    $this->strApellido,
                    $this->intTelefono,
                    $this->strEmail,
                    $this->strPassword,
                    $this->intTipoId
                );
                $request_insert = $this->con->insert($query_insert, $arrData);
                $return = $request_insert;
            } else {
                $return = false;
            }
            return $return;
        }

        public function insertDetalleTemp(array $pedido){
            $this->intIdCliente = $pedido['idcliente'];
            $this->intIdTransaccion = $pedido['idtransaccion'];

            $productos = $pedido['productos'];
            $this->con = new Mysql();

            $sql = "SELECT * FROM detalletemp  WHERE
                    transaccionid = '{$this->intIdTransaccion}' AND 
                    usuarioid = $this->intIdCliente";
            $request = $this->con->select_all($sql);

            if (empty($request)) {
                foreach ($productos as $producto) {
                    $query_insert = "INSERT INTO detalletemp(usuarioid,productoid,precio,cantidad,transaccionid)
                    VALUES(?,?,?,?,?)";
                    $arrData = array($this->intIdCliente,
                                    $producto['idproducto'],
                                    $producto['precio'],
                                    $producto['cantidad'],
                                    $this->intIdTransaccion);
                    $request_insert = $this->con->insert($query_insert,$arrData);
                    
                }
            }else{
                $sqlDel = "DELETE  FROM detalletemp  WHERE
                        transaccionid = '{$this->intIdTransaccion}' AND 
                        usuarioid = $this->intIdCliente";
                $request = $this->con->delete($sqlDel);
                foreach ($productos as $producto) {
                    $query_insert = "INSERT INTO detalletemp(usuarioid,productoid,precio,cantidad,transaccionid)
                        VALUES(?,?,?,?,?)";
                    $arrData = array(
                        $this->intIdCliente,
                        $producto['idproducto'],
                        $producto['precio'],
                        $producto['cantidad'],
                        $this->intIdTransaccion
                    );
                    $request_insert = $this->con->insert($query_insert, $arrData);
                    
                }
                
            }
        }

        public function insertPedido(string $idtransaccionpaypal=NULL, string $datospaypal= NULL,int $usuarioid,float $costo_envio,float $monto, int     $tipopagoid, string $direccionenvio,string $status){
            $this->con = new Mysql();
        $query_insert  = "INSERT INTO pedidos(idtransaccionpaypal, datospaypal,id_usuario,costo_envio,monto,tipopagoid,direccion_envio,status) VALUES(?,?,?,?,?,?,?,?)";
        $arrData = array($idtransaccionpaypal,
                        $datospaypal,
                        $usuarioid,
                        $costo_envio,
                        $monto,
                        $tipopagoid,
                        $direccionenvio,
                        $status);
        $request_insert = $this->con->insert($query_insert,$arrData);
        $return = $request_insert;
        return $return;
        
        }
        public function insertDetalle(int $pedidoid,int $productoid,float $precio,int $cantidad ){
            $this->con = new Mysql();
            $query_insert  = "INSERT INTO detallepedido(pedidoid, productoid,precio,cantidad) VALUES(?,?,?,?)";
            $arrData = array($pedidoid,
                        $productoid,
                        $precio,
                        $cantidad);
        $request_insert = $this->con->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;

        }

        public function getPedido(int $idpedido)
        {
            $this->con = new Mysql();
            $request = array();
            $sql ="SELECT p.id_pedidos,
                            p.referenciacobro,
                            p.idtransaccionpaypal,
                            p.id_usuario,
                            p.fecha,
                            p.costo_envio,
                            p.monto,
                            p.tipopagoid,
                            t.tipopago,
                            p.direccion_envio,
                            p.status
                        FROM pedidos as p
                        INNER JOIN tipopago t
                        ON p.tipopagoid = t.idtipopago
                        WHERE p.id_pedidos= $idpedido";
            $requestPedido = $this->con->select($sql);
            if(count($requestPedido)>0){
                $sql_detalle = "SELECT p.id_Producto,
                                            p.nombre as producto,
                                            d.precio,
                                            d.cantidad
                                    FROM detallepedido d
                                    INNER JOIN productos p
                                    ON d.productoid = p.id_Producto
                                    WHERE d.pedidoid = $idpedido";
                $requestProductos = $this->con->select_all($sql_detalle);
                $request = array('orden' => $requestPedido,
                                 'detalle' => $requestProductos);
            }
            return $request;
        }
    }
