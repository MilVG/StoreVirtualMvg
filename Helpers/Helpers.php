<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

	function base_url(){
		return BASE_URL;
	}

	function  media() {
		
		return BASE_URL."Assets/";
	}
	function dep($data){

		$format = print_r('<pre>');
		$format = print_r($data);
		$format = print_r('</pre>');
		return $format;
	}
	function headerAdmin($data="")
	{
		$viewheader ="Views/Template/header_admin.php";
		require_once($viewheader);
	}
	function navadmin($data=""){

		$viewnav ="Views/Template/nav_admin.php";
		require_once($viewnav);
	}
	function footerAdmin ($data="")
	{
		$viewfooter ="Views/Template/footer_admin.php";
		require_once ($viewfooter);
	}
	function headerTienda($data="")
	{
		$viewheader ="Views/Template/header_tienda.php";
		require_once($viewheader);
	}
	function footerTienda ($data="")
	{
		$viewfooter ="Views/Template/footer_tienda.php";
		require_once ($viewfooter);
	}
	function getModal(string $modalname,$data){
		$view_modal="Views/Template/Modal/{$modalname}.php";

		require_once $view_modal;
	}
	function getFile(string $url,$data){
		ob_start();
		require_once("Views/{$url}.php");
		$file = ob_get_clean();
		return $file;
	}
	//Envio de correos
    function sendEmail($data,$template)
    {
		
		$mail = new PHPMailer(true);
		try{
		    //Server settings
		    $mail->SMTPDebug = 0;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'el7motigre@hotmail.com';                     //SMTP username
		    $mail->Password   = '';                               //SMTP password
		    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		    $mail->Port       = 587;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		    //Recipients
			
		    $empresa = NOMBRE_REMITENTE;
        	$remitente = EMAIL_REMITENTE;
		    $mail->setFrom($remitente, $empresa);
		    $emailDestino = $data['email'];
		    $usuario = !empty($data['nombreUsuario']) ? $data['nombreUsuario'] :"mjl";
		    $mail->addAddress($emailDestino, $usuario);     //Add a recipient
		// $mail->addAddress('ellen@example.com');               //Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
			$emailcopia = !empty($data['emailCopia']) ? $data['emailCopia'] : "";
			$mail->addBCC($emailcopia);

		    //Attachments
		    //$mail->addAttachment('document/PruebaTest.pdf','CordsDevops');         //Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		    //Content
		    $mail->isHTML(true);
		    $asunto = $data['asunto'];                                //Set email format to HTML
		    $mail->Subject = $asunto;
		    ob_start();

        	require_once("Views/Template/Email/".$template.".php");

        	$mensaje = ob_get_contents();
        	ob_end_clean();
	        $mail->Body = $mensaje;

		    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	       $mail->send();
	       return true;

        	
        }catch (Exception $e){
        	return false;
        }
		   
		
    }
    function getPermisos(int $idmodulo){
    	require_once("Models/PermisosModel.php");
    	$objPermisos = new PermisosModel();
    	$idrol =$_SESSION['userData']['id_tipous'];
    	$arrPermisos =$objPermisos->permisosModulo($idrol);
    	$permisos = '';
        $permisosMod = '';
        if(count($arrPermisos) > 0 ){
            $permisos = $arrPermisos;
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }
        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;

    }
	 function sessionUser(int $idusuario){
        require_once ("Models/LoginModel.php");
        $objLogin = new LoginModel();
        $request = $objLogin->sessionLogin($idusuario);
        return $request;
    }
	function sessionStar(){
		session_start();
		$inactive = 600;
		if (isset($_SESSION['timeout'])) {
			$session_in =time() -$_SESSION['inicio'];
			if($session_in > $inactive){
				header("location: ".BASE_URL."/Logout");
			}
		} else {
			header("location: ".BASE_URL."/Logout");
		}
	}

	function uploadImage(array $data,string $name){
		$url_temp = $data['tmp_name'];
		$destino = 'Assets/img/uploads/'.$name;
		$move = move_uploaded_file($url_temp,$destino);
		return $move;
	}

	function deleteFile(string $name){
        unlink('Assets/img/uploads/'.$name);
    }

	function strClean($strCadena){
		$string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''],$strCadena);
		$string =trim($string);
		$string = str_replace("<script>","",$string);
		$string = str_replace("</script>","",$string);
		$string = str_replace("<script src>","",$string);
		$string = str_replace("<script type=>","",$string);
		$string = str_replace("SELECT * FROM ","",$string);
		$string = str_replace("DELETE * FROM ","",$string);
		$string = str_replace("INSERT INTO","",$string);
		$string = str_replace("SELECT COUNT(*) FROM","",$string);
		$string = str_replace("DROP TABLE","",$string);
		$string = str_replace("OR '1'='1","",$string);
		$string = str_replace('OR "1"="1"',"",$string);
		$string = str_replace('OR ´1´=´1´',"",$string);
		$string = str_replace("is NULL; --","",$string);
		$string = str_replace("is NULL; --","",$string);
		$string = str_replace("LIKE '","",$string);
		$string = str_replace('LIKE "',"",$string);
		$string = str_replace("LIKE ´","",$string);
		$string = str_replace("OR 'a'='a","",$string);
		$string = str_replace('OR "a"="a',"",$string);
		$string = str_replace("OR ´a´=´a","",$string);
		$string = str_replace("OR ´a´=´a","",$string);
		$string = str_replace("--","",$string);
		$string = str_replace("^","",$string);
		$string = str_replace("[","",$string);
		$string = str_replace("]","",$string);
		$string = str_replace("==","",$string);
		return $string;
	}

	function clear_cadena(string $cadena)
	{
		//Reemplazamos la A y a
		$cadena = str_replace(
			array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
			array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
			$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
			array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
			array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
			$cadena
		);

		//Reemplazamos la I y i
		$cadena = str_replace(
			array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
			array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
			$cadena
		);

		//Reemplazamos la O y o
		$cadena = str_replace(
			array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
			array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
			$cadena
		);

		//Reemplazamos la U y u
		$cadena = str_replace(
			array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
			array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
			$cadena
		);

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
			array('Ñ', 'ñ', 'Ç', 'ç', ',', '.', ';', ':'),
			array('N', 'n', 'C', 'c', '', '', '', ''),
			$cadena
		);
		return $cadena;
	}

	function passGenerator($length=10){

		$pass ="";
		$longitudPass=$length;
		$cadena ="ABCDFGHIJKLMNOPQRSTUVWXYZabcdfghijklmnopqrstuvwxyz1234567890";
		$longitudCadena =strlen($cadena);
		for ($i=1; $i <=$longitudPass ; $i++) { 
			
			$pos = rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;
	}

	function token(){

		$r1 = bin2hex(random_bytes(10));
		$r2 = bin2hex(random_bytes(10));
		$r3 = bin2hex(random_bytes(10));
		$r4 = bin2hex(random_bytes(10));
		$token =$r1.'-'.$r2.'-'.$r3.'-'.$r4;
		return $token;
	}
	function formatMoney($cantidad){
		$cantidad = number_format($cantidad,2,SPD,SPM);
		return $cantidad;
	}

	function getTokenPaypal(){
		$arrFields = array('grant_type' => 'client_credentials') ;
		$fieldString = http_build_query($arrFields);

		$paylogin =curl_init(PAYPALAPI."/v1/oauth2/token");
		curl_setopt($paylogin,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($paylogin,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($paylogin,CURLOPT_USERPWD,IDCLIENTE.":".CLIENTESECRET);
		curl_setopt($paylogin,CURLOPT_POSTFIELDS,$fieldString);
		$result = curl_exec($paylogin);
		$error = curl_error($paylogin);
		curl_close($paylogin);
		if ($error) {
			$request = "CURL Error #:".$error;
		}else {
			$objData = json_decode($result);
			$request = $objData->access_token;
		}
		return $request;
	}

	function CurlConectionGet(string $ruta,string $contentType = null,string $token)
	{
		$contentType = $contentType !=null ? $contentType: "application/x-www-form-urlenconded";

		if ($token != null) {
			$arrHeader = array('Content-Type:'.$contentType,
								'Authorization: Bearer '.$token);
		}else {
		$arrHeader = array(
			'Content-Type:'. $contentType);
		}
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$ruta);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$arrHeader);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if ($error) {
			$request = "CURL Error #:" . $error;
		} else {
			$request = json_decode($result);
		}
		return $request;
	}
	function CurlConectionPost(string $ruta,string $contentType = null,string $token)
	{
		$contentType = $contentType !=null ? $contentType: "application/x-www-form-urlenconded";

		if ($token != null) {
			$arrHeader = array('Content-Type:'.$contentType,
								'Authorization: Bearer '.$token);
		}else {
		$arrHeader = array(
			'Content-Type:'. $contentType);
		}
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$ruta);
		curl_setopt($ch,CURLOPT_POST,TRUE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$arrHeader);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if ($error) {
			$request = "CURL Error #:" . $error;
		} else {
			$request = json_decode($result);
		}
		return $request;
	}
 ?>