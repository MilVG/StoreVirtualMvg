<?php 



	require_once("Config/Config.php");

	require_once("Helpers/Helpers.php");

	/* -- el parametro url viene del archivo .htaccess

	   -- la funcion empty significa si no existe.

	   -- al negarlo lo convertimos en verdadero entonces seria si existe en la url la variable entonces devuleve la variale de lo contrario retorna el controlador home.



	 */



	$url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';



	//los datos que vienen de la url lo almacenamos en un array,con nombre "arrUrl" pero con la funcion explode que requiere dos parametros, el primero es un delimitador en este caso el / y el segundo la cadena de la url.



	$arrUrl = explode("/",$url);



	$controller =$arrUrl[0];

	$method =$arrUrl[0];

	$params = "";



	//al imprimir por pantalla la variable array tenemos  array([0]=>dato [1]=>"vacio" ; esto hace que el metodo que venga en la posicion 1 no tenga datos lo cual generaria error)



	//para ello necesitamos utilizar una condición si existe la posicion 1 entonces, hacemos otra condición: si la posicion es diferente de vacio, entonces almacenamos en la variable metodo la posicion 1.



	if (!empty($arrUrl[1])) {



		if ($arrUrl[1] != "") {



			$method =$arrUrl[1];

			

		}

		

	}





	// al tener las condicionales anteriores , nos permitira obtener los controladores y metodos, pero si pasamos un parametro obtendriamos los siguiente array([0]=>producto [1]=>registrarProducto), lo cual el tercer indice debe traer el parametro que pasamos pero generera un error; para ello haremos la siguiente comdicional.



	if (!empty($arrUrl[2])) {

		

		if ($arrUrl[2] != "") {

			

			for ($i=2; $i <count($arrUrl) ; $i++) { 

				

				$params .= $arrUrl[$i].',';

			}

			$params = trim($params,',');

		}

	}



	require_once("Libraries/Core/Autoload.php");

	require_once("Libraries/Core/Load.php");





	// echo "<br>";

	// echo "controlador:".$controller;

	// echo "<br>";

	// echo "método: ".$method;

	// echo "<br>";

	// echo "parametros: ".$params;

















 ?>