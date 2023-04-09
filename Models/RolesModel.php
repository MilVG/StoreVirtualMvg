<?php 

class RolesModel extends Mysql{

    public $intIdrol;
    public $strRol;
    public $intStatus;
		public function __construct(){
			
			parent:: __construct();
		}

        public function selectRoles(){
            $whereAdmin ="";
            if ($_SESSION['idUser'] !=1) {
                $whereAdmin = " and id_tipous != 1";
            }
            $sql="SELECT * FROM tipousuario WHERE status !=0 ".$whereAdmin;
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectRol(int $idrol){
            $this->intIdrol = $idrol;
            $sql ="SELECT * FROM tipousuario WHERE id_tipous = $this->intIdrol";
            $request=$this->select($sql);
            return $request;
        }
        public function insertRol(string $rol, int $status) {
            $return = "";
            $this->strRol= $rol;
            $this->intStatus = $status;
            
            $sql= "SELECT * FROM tipousuario WHERE rol ='{$this->strRol}'";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $query_insert ="INSERT INTO tipousuario(rol,status) VALUES (?,?)";
                $arrData = array($this->strRol,$this->intStatus);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }

        public function updateRol(int $idrol,string $rol, int $status){

            $this->intIdRol=$idrol;
            $this->strRol =$rol;
            $this->intStatus =$status;

            $sql ="SELECT * FROM tipousuario WHERE rol = '$this->strRol' AND id_tipous != $this->intIdRol ";
            $request = $this->select_all($sql);

            if (empty($request)) {
                $sql ="UPDATE tipousuario SET rol=?, status=? WHERE id_tipous = $this->intIdRol";
                $arrData= array($this->strRol, $this->intStatus);
                $request =$this->update($sql,$arrData);
            } else {
                $request = false;
            }
            return $request;

        }
        public function deleteRol(int $idrol){
            $this->intIdrol=$idrol;
            $sql= "SELECT * FROM usuario WHERE id_tipous =$this->intIdrol";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $sql = "UPDATE tipousuario SET status =? WHERE id_tipous = $this->intIdrol";
                $arrData = array(0);
                $request = $this->update($sql,$arrData);
                if ($request) {
                    $request ='ok';
                } else {
                    $request = 'error';
                }
                
            }else {
                $request = false;
            }
            return $request;
        }
        
}

?>