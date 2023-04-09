<?php 
require_once("Libraries/Core/Mysql.php");
    trait TCategoria{
        private $con;

        public function getCategoriasT(string $categorias){
            $this->con = new Mysql();

            $sql = "SELECT id_Categoria, nombre, descripcion, portadaimg,ruta
                    FROM categoria WHERE status != 0 AND id_Categoria IN ($categorias)";
            $request = $this->con->select_all($sql);
            if (count($request)>0) {
                for ($c=0; $c <count($request); $c++) { 
                    $request[$c]['portadaimg'] = BASE_URL.'Assets/img/uploads/'.$request[$c]['portadaimg'];
                }
            }
            return $request;
        }
    }
?>