<?php
include('conexion.php');
include('sesion.php');

if($email != ""){   
	 
	$sql  = "SELECT jo3_users.id as id,activation,type,name,banner_client ";
	$sql .= "FROM jo3_users ";
	$sql .= "LEFT JOIN ipm_user_type ON jo3_users.id = ipm_user_type.id ";
	$sql .= "WHERE email = '$email'";
	$result = $db->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$count = $result->num_rows;
      
	if($count == 1){
		
		$_SESSION['login_user'] = $myusername;
		$_SESSION['mail'] = $email;
		$_SESSION['id'] = $row['id'];
		$_SESSION['activation'] = $row['activation'];
		$_SESSION['type'] = $row['type'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['banner_client'] = $row['banner_client'];
		
		if(empty($row['type'])){
			$_SESSION['messaje'][] = array(
				'type' => 'warning',
				'msg'  => 'Establesca algunas opciones de configuracion inicial'
			);
			header("location: ../index.php?tpl=select_type");
		} elseif($row['type']==2){
			$sql = "SELECT id,name,contact,email,extrainfo FROM jo3_banner_clients WHERE id={$row['banner_client']}";
			$result = $db->query($sql);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$count = $result->num_rows;
			if($count > 0){
				$_SESSION['banner_client'] = $row;
			}
		}
		$_SESSION['messaje'][] = array(
			'type' => 'success',
			'msg'  => 'Bienvenido '. $_SESSION['name']
		);
	} else {
		$_SESSION['messaje'][] = array(
			'type' => 'error',
			'msg'  => 'Usuario o email erroneos'
		);
	}
} else {
	$_SESSION['messaje'][] = array(
		'type' => 'error',
		'msg'  => 'Metodo de envio incorrecto, intentelo mas tarde.'
	);
} 
header("location: ../login.php");?>
