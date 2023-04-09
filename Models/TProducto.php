<?php 

    include_once("Libraries/Core/Mysql.php");

    trait TProducto
    {
        private $strCategoria;
        private $con;
        private $intIdCategoria;
        private $intIdProducto;
        private $strProducto;
        private $cant;
        private $option;
        private $strRuta;
        public function getProductosT()
        {
            $this->con = new Mysql();

            $sql = "SELECT p.id_Producto,
                            p.codigo,
                            p.nombre,
                            p.descripcion,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.precio,
                            p.ruta,
                            p.stock
                        FROM productos p
                        INNER JOIN categoria c
                        ON p.categoriaid = c.id_Categoria
                        WHERE p.status !=0
                        ORDER BY p.id_Producto desc";
            $request = $this->con->select_all($sql);
            if (count($request) >0) {
                for ($c=0; $c <count($request) ; $c++) { 
                    $intIdProducto = $request[$c]['id_Producto'];
                    $sqlImg ="SELECT productoid,img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($i=0; $i <count($arrImg); $i++) { 
                            $arrImg[$i]['url_image'] = media().'img/uploads/'.$arrImg[$i]['img'];
                        }
                    }
                    $request [$c]['images'] =$arrImg;

                }
            }

            return $request;
            
        }

        public function getProductosCategoriaT(int $idcaegoria,string $ruta)
        {
            $this->intIdCategoria = $idcaegoria;
            $this->strRuta = $ruta;
            $this->con = new Mysql();
            
            $sql_cat = "SELECT id_Categoria,nombre FROM categoria WHERE id_Categoria ='{$this->intIdCategoria}'";
            $request = $this->con->select($sql_cat);

            if (!empty($request)) {
                $this->strCategoria = $request['nombre'];
                $sql = "SELECT p.id_Producto,
                                p.codigo,
                                p.nombre,
                                p.descripcion,
                                p.categoriaid,
                                c.nombre as categoria,
                                p.precio,
                                p.ruta,
                                p.stock
                            FROM productos p
                            INNER JOIN categoria c
                            ON p.categoriaid = c.id_Categoria
                            WHERE p.status !=0 AND p.categoriaid = $this->intIdCategoria AND c.ruta ='{$this->strRuta}'
                            ORDER BY p.id_Producto desc";
                $request = $this->con->select_all($sql);
                if (count($request) > 0) {
                    for ($c = 0; $c < count($request); $c++) {
                        $intIdProducto = $request[$c]['id_Producto'];
                        $sqlImg = "SELECT productoid,img
                                FROM imagen
                                WHERE productoid = $intIdProducto";
                        $arrImg = $this->con->select_all($sqlImg);
                        if (count($arrImg) > 0) {
                            for ($i = 0; $i < count($arrImg); $i++) {
                                $arrImg[$i]['url_image'] = media() . 'img/uploads/' . $arrImg[$i]['img'];
                            }
                        }
                        $request[$c]['images'] = $arrImg;
                    }
                }

                $request = array('idcategoria'=>$this->intIdCategoria,
                                    'categoria'=>$this->strCategoria,
                                    'productos'=>$request);
            }

            return $request;
        }

        public function getProductoT(int $idproducto,string $ruta)
        {
            $this->con = new Mysql();
            $this->intIdProducto = $idproducto;
            $this->strRuta = $ruta;
            $sql = "SELECT p.id_Producto,
                                p.codigo,
                                p.nombre,
                                p.descripcion,
                                p.categoriaid,
                                c.nombre as categoria,
                                c.ruta as rutaCategoria,
                                p.precio,
                                p.ruta,
                                p.stock
                            FROM productos p
                            INNER JOIN categoria c
                            ON p.categoriaid = c.id_Categoria
                            WHERE p.status !=0 AND p.id_Producto = '{$this->intIdProducto}' AND p.ruta = '{$this->strRuta}'";
            $request = $this->con->select($sql);
            if (!empty($request)) {
                
                $intIdProducto = $request['id_Producto'];
                $sqlImg = "SELECT productoid,img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($i = 0; $i < count($arrImg); $i++) {
                        $arrImg[$i]['url_image'] = media().'img/uploads/'.$arrImg[$i]['img'];
                    }
                }else{
                     $arrImg[0]['url_image'] = media().'img/uploads/product.jpg';
                }
                $request['images'] = $arrImg;
            
            }

            return $request;
        }

        public function getProductosRandom(int $idcategoria, int $cant, string $option){
            $this->intIdCategoria = $idcategoria;
            $this->cant = $cant;
            $this->option = $option;

            if($option  == "r"){
                $this->option = "RAND()";

            }else if($option == "a"){
                $this->option = "id_Producto ASC";
            }else{
                $this->option = "id_Producto DESC";
            }
            $this->con = new Mysql();
            $sql = "SELECT p.id_Producto,
                                p.codigo,
                                p.nombre,
                                p.descripcion,
                                p.categoriaid,
                                c.nombre as categoria,
                                p.precio,
                                p.ruta,
                                p.stock
                            FROM productos p
                            INNER JOIN categoria c
                            ON p.categoriaid = c.id_Categoria
                            WHERE p.status !=0 AND p.categoriaid = $this->intIdCategoria
                            ORDER BY $this->option LIMIT $this->cant";
                            
            $request = $this->con->select_all($sql);
            if (count($request) > 0) {
                for ($c = 0; $c < count($request); $c++) {
                    $intIdProducto = $request[$c]['id_Producto'];
                    $sqlImg = "SELECT productoid,img
                                FROM imagen
                                WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_image'] = media() . 'img/uploads/' . $arrImg[$i]['img'];
                        }
                    }
                    $request[$c]['images'] = $arrImg;
                }
            }

            return $request;

        }
        public function getProductoIDT(int $idproducto)
        {
            $this->con = new Mysql();
            $this->intIdProducto = $idproducto;
            $sql = "SELECT p.id_Producto,
                                p.codigo,
                                p.nombre,
                                p.descripcion,
                                p.categoriaid,
                                c.nombre as categoria,
                                p.precio,
                                p.stock
                            FROM productos p
                            INNER JOIN categoria c
                            ON p.categoriaid = c.id_Categoria
                            WHERE p.status !=0 AND p.id_Producto = '{$this->intIdProducto}'";
            $request = $this->con->select($sql);
            if (!empty($request)) {
                
                $intIdProducto = $request['id_Producto'];
                $sqlImg = "SELECT productoid,img
                            FROM imagen
                            WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($i = 0; $i < count($arrImg); $i++) {
                        $arrImg[$i]['url_image'] = media().'img/uploads/'.$arrImg[$i]['img'];
                    }
                }else{
                     $arrImg[0]['url_image'] = media().'img/uploads/product.jpg';
                }
                $request['images'] = $arrImg;
            
            }

            return $request;
        }
    }
    

?>