<?php

$host_name = 'db701126754.db.1and1.com';
$database = 'db701126754';
$user_name = 'dbo701126754';
$password = '@Internet2.0';
//$db = mysqli_connect($host_name, $user_name, $password, $database);
$db = new mysqli($host_name,$user_name,$password,$database);

function recortar_texto($texto, $limite=120){	
	$texto = trim($texto);
	$texto = strip_tags($texto);
	$tamano = strlen($texto);
	$resultado = '';
	if($tamano <= $limite){
		return $texto;
	}else{
		$texto = substr($texto, 0, $limite);
		$palabras = explode(' ', $texto);
		$resultado = implode(' ', $palabras);
		$resultado .= '...';
	}	
	return $resultado;
}
?>
