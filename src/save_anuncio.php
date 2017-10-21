<?php include('sesion.php');
	include('src/conexion.php');
	$sql = "SELECT id,cid,catid,clickurl,name,description,params,metakey,state,publish_down,publish_up ";
	$sql .= "FROM jo3_banners WHERE cid={$_SESSION['banner_client']['id']} AND id={$_POST['id']}";
	$result = $db->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);

?>

<pre>
	<?php print_r($row) ?>
</pre>
