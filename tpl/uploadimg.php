<?php
$directorio = '/homepages/20/d700916237/htdocs/images/banners/id_'.$_SESSION['banner_client']['id'].'/';
$files  = scandir($directorio);
?>
<div class="row bg-title">
	<div class="col-xs-12">
		<h4 class="page-title">Subir imagen</h4> 
	</div>
</div>
<?php if(count($files)<4 || $_SESSION['type']==3){ ?>
<div class="panel">
	<div class="panel-heading">Formulario de imagen</div>
	<div class="panel-body">
		<div class='alert alert-info'>
			Selecione una imagen JPG o PNG no mayor a 1MB de las medidas de 800 x 450 px.
		</div>
		<form class="form-horizontal form-material" enctype="multipart/form-data" action="src/uploadimg.php" method="POST">
			<div class="form-group">
				<label class="col-md-12" for="file">Imagen</label>
				<div class="col-md-12">
					<input name="img" class="form-control form-control-line" id="file" type="file" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-12">Nombre de la imagen</label>
				<div class="col-md-12">
					<input type="text" placeholder="Imagen" class="form-control form-control-line" name="name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<input class="btn btn-success" type="submit" value="Subir" id="btn-send"/>
				</div>
			</div>
		</form>
	</div>
</div>
<?php } else { ?>
<div class="panel">
	<div class="panel-body">
		<h3>Acceso restringido</h3>
		<p class="text-muted m-t-30 m-b-30">Intente con otra pagina desde el panel de control</p>
		<a href="index.php?tab=destacados" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Panel de control</a>
	</div>
</div>
<?php } ?>
