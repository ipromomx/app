<?php
include('src/conexion.php');
//Variables de paginacion
$pagina = (isset($_GET['pagina'])&&$_GET['pagina']!='')?$_GET['pagina']:1;
$registros = 6; 
$contador = 1;
$inicio = ($pagina - 1) * $registros; 

if($tab=='destacados'){
	$sql0 = "SELECT * FROM jo3_banners ";
	$sql0 .= "WHERE ";
	if($catid!=0) $sql0 .= "catid=$catid && ";
	$sql0 .= "state=1 ";
	
	$sql1 = "SELECT ban.id,ban.name,description,params,cid.name as inc FROM jo3_banners as ban ";
	$sql1 .= "LEFT JOIN jo3_banner_clients AS cid ON cid.id = ban.cid ";
	$sql1 .= "WHERE ";
	if($catid!=0) $sql1 .= "ban.catid=$catid && ";
	$sql1 .= "ban.state=1 ORDER BY clicks DESC LIMIT $inicio,$registros";
} elseif($tab=='masvistos'){
	$sql0 = "SELECT * FROM jo3_banners ";
	$sql0 .= "WHERE ";
	if($catid!=0) $sql0 .= "catid=$catid && ";
	$sql0 .= "state=1 ";
	
	$sql1 = "SELECT ban.id,ban.name,description,params,cid.name as inc FROM jo3_banners as ban ";
	$sql1 .= "LEFT JOIN jo3_banner_clients AS cid ON cid.id = ban.cid ";
	$sql1 .= "WHERE ";
	if($catid!=0) $sql1 .= "ban.catid=$catid && ";
	$sql1 .= "ban.state=1 ORDER BY impmade DESC LIMIT $inicio,$registros";
} elseif($tab=='nuevos'){
	$sql0 = "SELECT * FROM jo3_banners ";
	$sql0 .= "WHERE ";
	if($catid!=0) $sql0 .= "catid=$catid && ";
	$sql0 .= "state=1 AND LEFT(created, 10)  >= date_add(LEFT(now(),10), interval -7 day) ";
		
	$sql1 = "SELECT ban.id,ban.name,description,params,cid.name as inc FROM jo3_banners as ban ";
	$sql1 .= "LEFT JOIN jo3_banner_clients AS cid ON cid.id = ban.cid ";
	$sql1 .= "WHERE ";
	if($catid!=0) $sql1 .= "ban.catid=$catid && ";
	$sql1 .= "ban.state=1 AND LEFT(created, 10)  >= date_add(LEFT(now(),10), interval -4 day) LIMIT $inicio,$registros";
} elseif($tab=='favoritos'){
	$sql0 = "SELECT id,name,description,params FROM jo3_banners ";
	$sql0 .= "WHERE ";
	if($catid!=0) $sql0 .= "catid=$catid &&";
	$sql0 .= "state=1";
	
	$sql1 = "SELECT ban.id,ban.name,description,params,cid.name as inc FROM jo3_banners as ban ";
	$sql1 .= "LEFT JOIN jo3_banner_clients AS cid ON cid.id = ban.cid ";
	$sql1 .= "WHERE ";
	if($catid!=0) $sql1 .= "ban.catid=$catid && ";
	$sql1 .= "ban.state=1 LIMIT $inicio,$registros";
}
	
$result = $db->query($sql0);
$total_registros = mysqli_num_rows($result);
$total_paginas = ceil($total_registros / $registros); 	
$result_promo = $db->query($sql1);
?>	
<div class="ui-field-contain">
	<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" data-theme="e">
        <label for="select-h-5b">Categorias</label>
		<select id="select-h-5b" name="categories" onchange="location=this.value">
			<option value="index.php?tab=<?=$tab?>&catid=0">Categorias</option>
			<?php $sql  = "SELECT id,title FROM jo3_categories WHERE extension='com_banners' AND published=1";
			$result = $db->query($sql);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){ 
				if($row['title']!="Uncategorised"){ ?>
			<option value="index.php?tab=<?=$tab?>&catid=<?=$row['id']?>" <?=($row['id']==$catid)?'SELECTED':''?>><?=$row['title']?></option>
			<?php }} ?>
		</select>
		<label for="select-h-5c">P</label>
		<select id="select-h-5c" name="pagina" onchange="location=this.value">
			<?php 
			for ($i = 1; $i <= $total_paginas; $i++){ ?>
			<option value="index.php?tab=<?=$tab?>&catid=<?=$catid?>&pagina=<?=$i?>" <?=($pagina==$i)?'SELECTED':''?>><?=$i?></option>
			<?php } ?>
		</select>
    </fieldset>
</div>

<p>&nbsp;</p>

<ul data-role="listview" data-theme="c">
<?php while($row = $result_promo->fetch_array(MYSQLI_ASSOC)){
		$row['params'] = json_decode($row['params'], true); ?>
	<li>
		<a href="src/contador.php?id=<?=$row['id']?>">
			<div class="thumbnail">
				<img src="https://ipromo.mx/<?=$row['params']['imageurl']?>" alt="<?=$row['name']?>" style="width:100%;max-height:160px;">
				<p><?=$row['name']?></p>
			</div>
		</a>
	</li>
<?php } ?>
</ul>
