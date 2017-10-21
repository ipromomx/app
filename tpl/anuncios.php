<?php include('src/conexion.php');
	$sql  = "SELECT id,name,description,params,clicks,impmade,publish_down FROM jo3_banners WHERE id={$_GET['id']}";
	$result = $db->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$row['params'] = json_decode($row['params'], true);
?>
<div class="row bg-title">
	<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title"><?=utf8_encode($row['name'])?></h4> 
	</div>
</div> 

<div class="row">
	<div class="col-md-4">
		<div class="thumbnail">
			<img src="https://ipromo.mx/<?=$row['params']['imageurl']?>" alt="<?=utf8_encode($row['name'])?>" style="width:100%;height:280px;">
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3><?=utf8_encode($row['name'])?></h3>
				<span class="mail-desc"><?=utf8_encode($row['description'])?></span>
				<br/>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<span class="pull-right">Vistos: <?=$row['impmade']?></span>
				<br/>
				<span class="pull-right">Clicks: <?=$row['clicks']?></span>
				<br/>
				<span class="time pull-right">Valido hasta: <?=$row['publish_down']?></span>
				<br/>
			</div>
		</div>
	</div>
</div>
