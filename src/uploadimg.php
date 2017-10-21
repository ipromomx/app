<?php include('sesion.php');

if($_FILES['img']['error']==0){
	if($_FILES['img']['size']<450000){
		$directorio = '/homepages/20/d700916237/htdocs/images/banners/id_'.$_SESSION['banner_client']['id'].'/';
		$max_ancho = 800;
		$max_alto = 450;
		$name = (isset($_POST['name']) && !empty($_POST['name']))? $_POST['name'] : basename($_FILES['img']['name']);
		$name = str_replace(" ", "_", $name);
		$name = explode(".",$name);
		
		if(@is_array(getimagesize($_FILES['img']['tmp_name']))){
			list($ancho,$alto)=getimagesize($_FILES['img']['tmp_name']); //Ancho y alto de la imagen original
			$img_nueva=imagecreatetruecolor($max_ancho,$max_alto); // El marco
			
			if($_FILES['img']['type']=="image/png" || $_FILES['img']['type']=="image/x-png"){
				$img_original = @imageCreateFromPng($_FILES['img']['tmp_name']);
			} elseif($_FILES['img']['type']=="image/jpeg" || $_FILES['img']['type']=="image/pjpeg" || $_FILES['img']['type']=="image/jpg"){
				$img_original = @imagecreatefromjpeg($_FILES['img']['tmp_name']);
			} 
			
			//Se calcula ancho y alto de la imagen final
			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;
			//Si el ancho y el alto de la imagen no superan los maximos,
			//ancho final y alto final son los que tiene actualmente
			if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
				$ancho_final = $ancho;
				$alto_final = $alto;
			} elseif (($x_ratio * $alto) < $max_alto){
				$alto_final = ceil($x_ratio * $alto)-15;
				$ancho_final = $max_ancho-15;
			} else{
				$ancho_final = ceil($y_ratio * $ancho)-15;
				$alto_final = $max_alto-15;
			}
			$x = ($max_ancho-$ancho_final)/2;
			$x = ($x<5)? 5:$x;
			$y = ($max_alto-$alto_final)/2;
			$y = ($y<5)? 5:$y;
		
			// Establecemos la imagen de fondo transparente
			imageAlphaBlending( $img_nueva, false );
			imageSaveAlpha( $img_nueva, true );
			// Establecemos el color transparente (negro)
			$ImTransparente = imageColorAllocateAlpha( $img_nueva, 0, 0, 0, 0xff/2 );
			// Ponemos el fondo transparente
			imageFilledRectangle( $img_nueva,0,0,$ancho,$alto,$ImTransparente );
			imagecopyresampled($img_nueva,$img_original,$x,$y,0,0,$ancho_final,$alto_final,$ancho,$alto);
			imagedestroy($img_original);
			
			//Mostrar imagen por pantalla
			imagePng($img_nueva,$directorio.$name[0].".png");
			
		} else {
			$_SESSION['messaje'][] = array(
				'type' => 'error',
				'msg'  => 'El archivo no corresponde a una imagen'
			);
		}
	} else {
		$_SESSION['messaje'][] = array(
			'type' => 'error',
			'msg'  => 'El tamaño del archivo supera los 450 KB.'
		);
	}
} elseif($_FILES['img']['error']==4){
	$_SESSION['messaje'][] = array(
		'type' => 'error',
		'msg'  => 'No se envio el archivo de imagen'
	);
} else {
	$_SESSION['messaje'][] = array(
		'type' => 'error',
		'msg'  => 'Error al cargar el archivo, intentelo mas tarde.'
	);
}
header("location: ../index.php?tpl=misimagenes");
?>
