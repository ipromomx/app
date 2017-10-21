<?php 
	include('src/conexion.php');
	$sql = "SELECT DATE_FORMAT(publish_down,'%d/%m/%Y') AS publish_down, DATE_FORMAT(publish_up,'%d/%m/%Y') AS publish_up,";
	$sql .= "id,name,clicks,impmade ";
	$sql .= "FROM jo3_banners WHERE cid={$_SESSION['banner_client']['id']}";
	$result = $db->query($sql);
?>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Mis anuncios</h4> 
	</div>
</div>

<div class="list-group">
<?php while($row = $result->fetch_array(MYSQLI_ASSOC)){ ?>	
	<a href="index.php?tpl=anuncio_edit&id=<?=$row['id']?>" class="list-group-item">
		<h4 class="list-group-item-heading"><?=$row['name']?></h4>
		<p class="list-group-item-text">
			<span class="label label-primary">Impresiones <?=$row['impmade']?></span>
			<span class="label label-primary">Clicks <?=$row['clicks']?></span>
			<span class="hidden-xs"><strong>Inicio:</strong> <?=$row['publish_up']?>, </span>
			<span><strong class="hidden-xs">Fin:</strong> <?=$row['publish_down']?></span>
		</p>
    </a>
<?php } ?>
</div>
