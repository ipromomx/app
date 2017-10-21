<?php
//include('sesion.php');
include('conexion.php');
header("Content-type: application/json; charset=utf-8");

$sql  = "SELECT id,name,description,params,clicks,impmade,publish_down FROM jo3_banners WHERE state=1";
$result = $db->query($sql);
$json = Array();
mysqli_set_charset($db, "utf8");
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$json[] = Array(
		'id'=>$row['id'],
		'name'=> utf8_encode($row['name']),
		'description'=>utf8_encode($row['description']),
		'params'=>json_decode($row['params'], true),
		'clicks'=>$row['clicks'],
		'impmade'=>$row['impmade'],
		'publish_down'=>$row['publish_down']
	);
}


echo json_encode($json);
?>
