<?php
$directorio = '/homepages/20/d700916237/htdocs/images/banners/id_'.$_SESSION['banner_client']['id'].'/';
if(!file_exists($directorio)){
	if(!mkdir($directorio, 0777, true)) {
		echo "<div class='alert alert-danger'>Fallo al crear las carpetas para subir imagenes. Intentelo mas tarde.</div>";
	}
}
$files  = scandir($directorio);
?>
<div class="row bg-title">
	<div class="col-xs-8">
		<h4 class="page-title">Mis imagenes</h4> 
	</div>
	<div class="col-xs-4">
		<?php if(count($files)<4 || $_SESSION['type']==3){ ?>
		<div class="pull-right">
			<p><a href="index.php?tpl=uploadimg">
				<i class="fa fa-plus" aria-hidden="true"></i>
				Agregar
			</a></p>
		</div>
		<?php } ?>
	</div>
</div>
<?php if(count($files)<3){ ?>
<div class='alert alert-info'><i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; Carpeta vacia</div>
<?php } ?>
<div class="row">
	<?php 
	foreach ($files as $key => $img){
		if(@is_array(getimagesize($directorio.$img))){ ?>
	<div class="col-md-4 col-xs-12">
		<div class="thumbnail">
			<div class="caption pull-right">
				<p><a href="https://ipromo.mx/images/banners/id_<?=$_SESSION['banner_client']['id']?>/<?=$img?>">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
					Eliminar
				</a></p>
			</div>
			<img src="https://ipromo.mx/images/banners/id_<?=$_SESSION['banner_client']['id']?>/<?=$img?>" alt="<?=$img?>" style="width:100%">
		</div>
	</div>
	<?php } } ?>
</div>
