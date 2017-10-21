<?php
include('conexion.php');
include('sesion.php');
$type = mysqli_real_escape_string($db,$_POST['type']);
$type = (empty($type))? $_GET['type'] : $type;
$type = (is_null($type) || empty($type))? $type = 0 : $type;
$banner_client = (!is_array($_SESSION['banner_client']) || !isset($_SESSION['banner_client']['id']))? 0 : $_SESSION['banner_client']['id'];
$id = ($_SESSION['id'])?$_SESSION['id']:0;

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$name = mysqli_real_escape_string($db,$_POST['name']);
	$contact = mysqli_real_escape_string($db,$_POST['contact']); 
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$extrainfo = mysqli_real_escape_string($db,$_POST['extrainfo']);
	
	$sql = "SELECT * FROM jo3_banner_clients WHERE id=$banner_client";
	$result = $db->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$count = $result->num_rows;
	if($count == 0){
		$sql  = "INSERT INTO jo3_banner_clients (name,contact,email,extrainfo,purchase_type,track_clicks,track_impressions,state) ";
		$sql .= "VALUES ('$name','$contact','$email','$extrainfo',-1,1,1,1)";

		if ($db->query($sql) === TRUE){
			$banner_client = $db->insert_id;
			$_SESSION['banner_client'] = Array(
				'id'=>$banner_client,
				'name'=>$name,
				'contact'=>$contact,
				'email'=>$email,
				'extrainfo'=>$extrainfo
			);
			$_SESSION['messaje'][] = array(
				'type' => 'success',
				'msg'  => 'Contacto guardado con exito'
			);
		} else {
			$_SESSION['messaje'][] = array(
				'type' => 'error',
				'msg'  => "Error: " . $sql . "<br>" . $db->error
			);
		}
		
	} else {
		$sql  = "UPDATE jo3_banner_clients SET name='$name',contact='$contact',email='$email',extrainfo='$extrainfo' WHERE id=$banner_client";
		if ($db->query($sql) === TRUE){
			$_SESSION['banner_client'] = Array(
				'id'=>$banner_client,
				'name'=>$name,
				'contact'=>$contact,
				'email'=>$email,
				'extrainfo'=>$extrainfo
			);
			$_SESSION['messaje'][] = array(
				'type' => 'success',
				'msg'  => 'Datos actualizados'
			);
		} else {
			$_SESSION['messaje'][] = array(
				'type' => 'error',
				'msg'  => 'No se almacenaron los datos'
			);
		}
	}
} 

$sql = "SELECT * FROM ipm_user_type WHERE id=$id";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$count = $result->num_rows;
if($count == 0){
	$sql  = "INSERT INTO ipm_user_type (id,type,banner_client) VALUES ($id,$type,$banner_client)";
	if ($db->query($sql) === TRUE){
		$_SESSION['type'] = $type;
		$_SESSION['messaje'][] = array(
			'type' => 'success',
			'msg'  => 'Tipo de usuario establecido'
		);
	} else {
		$_SESSION['messaje'][] = array(
			'type' => 'error',
			'msg'  => "Error: " . $sql . "<br>" . $db->error
		);
	}
} else {
	$sql  = "UPDATE ipm_user_type SET type=$type,banner_client=$banner_client WHERE id=$id";
	if ($db->query($sql) === TRUE){
		$_SESSION['type'] = $type;
		$_SESSION['messaje'][] = array(
			'type' => 'success',
			'msg'  => 'Se modifico el tipo de usuario'
		);
	} else {
		$_SESSION['messaje'][] = array(
			'type' => 'error',
			'msg'  => "Error: " . $sql . "<br>" . $db->error
		);
	}
}
header("location: ../index.php"); ?>
