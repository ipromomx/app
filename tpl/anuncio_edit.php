<?php
	include('src/conexion.php');
	$sql = "SELECT id,cid,catid,clickurl,name,description,params,metakey,state,publish_down,publish_up ";
	$sql .= "FROM jo3_banners WHERE cid={$_SESSION['banner_client']['id']} AND id={$_GET['id']}";
	$result = $db->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$row['params'] = json_decode($row['params'], true);
	$directorio = '/homepages/20/d700916237/htdocs/images/banners/id_'.$_SESSION['banner_client']['id'].'/';
	$files  = scandir($directorio);
?>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Editor de anuncio</h4> 
	</div>
</div>

<form class="form-horizontal" action="src/save_anuncio.php">
	<div class="form-group">
		<label class="control-label col-sm-2" for="titulo">Titulo</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="titulo" placeholder="Escriba el titulo del anuncio" name="name" value="<?=$row['name']?>">
		</div>
    </div>
    <div class="form-group">
		<label class="control-label col-sm-2" for="catid">Categoria</label>
		<div class="col-sm-10">          
			<select class="form-control" name="catid" id="catid">
				<?php $sql  = "SELECT id,title FROM jo3_categories WHERE extension='com_banners' AND published=1";
				$result = $db->query($sql);
				while($cat = $result->fetch_array(MYSQLI_ASSOC)){ 
					if($cat['title']!="Uncategorised"){ ?>
				<option value="<?=$cat['id']?>" <?=($cat['id']==$row['catid'])?'SELECTED':''?>><?=$cat['title']?></option>
				<?php }} ?>
			</select>
		</div>
    </div>
    <div class="form-group">
		<label class="control-label col-sm-2" for="imageurl">Imagen</label>
		<div class="col-sm-10">
			<select class="form-control" id="imageurl" name="params[imageurl]">
				<?php foreach ($files as $key => $img){
				if(@is_array(getimagesize($directorio.$img))){ ?>
				<option value="images/banner/id_<?=$_SESSION['banner_client']['id']?>/<?=$img?>" <?=("images/banner/id_{$_SESSION['banner_client']['id']}/$img"==$row['params']['imageurl'])?'selected':''?>><?=$img?></option>
				<?php } } ?>
			</select>
		</div>
    </div>
    <div class="form-group">
		<label class="control-label col-sm-2" for="alt">Texto de imagen</label>
		<div class="col-sm-10">          
			<input type="text" class="form-control" id="alt" placeholder="Texto de la imagen" name="params[alt]" value="<?=$row['params']['alt']?>">
		</div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="clickurl">URL</label>
		<div class="col-sm-10">          
			<input type="url" class="form-control" id="clickurl" placeholder="Pagina Web" name="clickurl" value="<?=$row['clickurl']?>">
		</div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="description">Descripcion</label>
		<div class="col-sm-10">
			<textarea name="description" id="description" class="form-control" rows="10"><?=$row['description']?></textarea>
		</div>
    </div>
    
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="metakey">Palabras claves</label>
		<div class="col-sm-10">          
			<input type="text" class="form-control" id="metakey" placeholder="Palabras para busqueda" name="metakey" value="<?=$row['metakey']?>">
		</div>
    </div>
    <div class="form-group">
		<label class="control-label col-sm-2" for="publish_down">Fecha de termino</label>
		<div class="col-sm-10">          
			<input type="datetime-local" class="form-control" id="publish_down" placeholder="Palabras para busqueda" name="publish_down" value="<?=$row['publish_down']?>">
		</div>
    </div>
    <div class="form-group">        
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Guardar</button>
		</div>
    </div>
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <input type="hidden" name="cid" value="<?=$row['cid']?>">
</form>

<pre>
	<?php print_r($row) ?>
</pre>

 <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
