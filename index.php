<?php 
/*Facebook*/
if(!session_id()) {
    session_start();
}
require_once 'src/Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '140873573200308', // Replace {app-id} with your app id
  'app_secret' => 'e5571110801b40e86d160c984f76022a',
  'default_graph_version' => 'v2.1',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://app.ipromo.mx/src/fb-callback.php', $permissions);
/*Facebook*/


include('src/sesion.php');
if(isset($_GET['tpl']) && !empty($_GET['tpl'])) $tpl=$_GET['tpl'];
else $tpl = "dashboard";
if(!file_exists("tpl/$tpl.php")) header("location: 404.php");
if(isset($_SESSION['id']) && $_SESSION['id']<1){
	if(empty($_SESSION['type'])) $tpl="select_type";
}
if($tpl=='misanuncios' && $_SESSION['type']<2) header("location: index.php?tab=destacados");
// Comienzo del almacenamiento temporal de la salida del script
$cache_state = false;
$cache_dir = "cache/";
$cache_filename = $cache_dir . md5(urlencode($_SERVER['REQUEST_URI'])) . ".html";
if(file_exists($cache_filename) && $cache_state){
	$datetime1 = new DateTime(date("F d Y H:i:s", fileatime($cache_filename)));
	$datetime2 = new DateTime(date('F d Y H:i:s'));
	$interval = $datetime1->diff($datetime2);
	if($interval->h<1){
		include ($cache_filename);
	} else {
		unlink($cache_filename);
	}
	exit();
}
$tab=(isset($_GET['tab'])&&$_GET['tab']!='')?$_GET['tab']:'destacados';
$catid=(isset($_GET['catid'])&&$_GET['catid']!='')?$_GET['catid']:0;
ob_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Prueba ipromo.mx</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.mobile.squareui.css" />
	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="js/index.js"></script>
</head>
<body>
	 <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	<div data-role="page" class="jqm-demos">
		
		<div data-role="header" data-position="fixed" data-theme="e">
			<h1>Prueba ipromo.mx</h1>
			<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
       		<a href="<?php echo htmlspecialchars($loginUrl); ?>" data-icon="gear" data-iconpos="notext">Entrar</a>
		</div><!-- /header -->
	
		<div role="main" class="ui-content" data-theme="e">
			<!-- Page Content -->
			<div id="page-wrapper">
				<div class="container-fluid">
					<?php 
					if ($_session["session"] != "1")  {
					echo '<a href="<?php '.htmlspecialchars($loginUrl).' " data-icon="gear" data-iconpos="notext">Entrar</a>';
		
					}ELSE{include("tpl/$tpl.php"); } ?>
				</div>
			</div>
			<!-- /#page-content -->
		</div><!-- /content -->
	
		<!-- /panel -->
			
		<div data-role="panel" data-position-fixed="true" data-display="push" data-theme="e" id="nav-panel">
        	<ul data-role="listview" data-divider-theme="d">
				<li data-role="list-divider">Vista</li>
   				<li><a href="index.php?tab=destacados&catid=<?=$catid?>">Destacados</a></li>
    			<li><a href="index.php?tab=masvistos&catid=<?=$catid?>">Mas vistos</a></li>
    			<li><a href="index.php?tab=nuevos&catid=<?=$catid?>">Nuevos</a></li>
    			<li><a href="index.php?tab=favoritos&catid=<?=$catid?>">Favoritos</a></li>
			</ul>
    	</div><!-- /panel -->	
		
	</div><!-- /page -->
</body>
</html>
<?php
// Recuperación en una variable del código HTML generado
$html = ob_get_contents();
// Envío al cliente del código HTML
ob_end_flush();
// Escribir la página en el fichero cache
file_put_contents($cache_filename, $html);
?>
