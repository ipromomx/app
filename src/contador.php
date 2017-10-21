<?php
include('conexion.php');
include('sesion.php');

$page="index.php";
$sql  = "SELECT id FROM jo3_banners WHERE id={$_GET['id']} AND state=1";
$result = $db->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$count = $result->num_rows;
if($count == 1){
	$sql  = "UPDATE jo3_banners SET impmade = impmade+1,clicks = clicks+1 WHERE id={$_GET['id']}";
	if ($db->query($sql) === TRUE){
		$page.="?tpl=anuncios&id={$_GET['id']}";
	}
}
header("location: ../$page");
?>
