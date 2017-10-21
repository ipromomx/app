<div class="row bg-title">
	<div class="col-xs-12">
		<h4 class="page-title">Perfil de usuario</h4>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<h3 class="box-title">Hola <?php echo $_SESSION['name']; ?>.</h3>
			<span>Para iniciar elige el tipo de usuario para esta aplicación. Si no estas seguro despues podras cambiarlo en 
			configuraciones.</span>
		</div>
	</div>
</div>

<div class="panel-group" id="accordion-example">
	<div class="panel">
		<div class="panel-heading">
			<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-example" href="#collapse1">
				<i class="fa fa-user"></i> &nbsp;&nbsp;
				Continuar como usuario
			</a>
		</div>
		<div id="collapse1" class="panel-collapse collapse">
			<div class="panel-body">
				<p>Elige esta opcion si lo que quieres es solo ver las ofertas</p>
				<button class="" id="btn-user">Continuar como usuario normal</button>
			</div>
		</div>
	</div>
	<div class="panel">
		<div class="panel-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-example" href="#collapse2">
				<i class="fa fa-bank"></i> &nbsp;&nbsp;
				Cambiar a empresario
			</a>
		</div>
		<div id="collapse2" class="panel-collapse collapse">
			<div class="panel-body">
				<p>Elige esta opcion si lo que quieres es <strong>publicar</strong> ofertas y recibir ayuda con marketing digital.</p>
				<form class="form-horizontal form-material" action="src/save_type.php" method="POST" id="form-save">
					<div class="form-group">
						<label class="col-md-12">Nombre de la empresa</label>
						<div class="col-md-12">
							<input type="text" placeholder="Empresa" class="form-control form-control-line" name="name" value="<?php echo (isset($_SESSION['banner_client']['name']))? $_SESSION['banner_client']['name']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Nombre completo de contacto</label>
						<div class="col-md-12">
							<input type="text" placeholder="Nombre completo" class="form-control form-control-line" name="contact" value="<?php echo (isset($_SESSION['banner_client']['contact']))? $_SESSION['banner_client']['contact']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-md-12">Correo electronico</label>
						<div class="col-md-12">
							<input type="email" placeholder="email" class="form-control form-control-line" name="email" value="<?php echo (isset($_SESSION['banner_client']['email']))? $_SESSION['banner_client']['email']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telefono" class="col-md-12">Telefono de contacto</label>
						<div class="col-md-12">
							<input type="tel" id="telefono" placeholder="LADA + numero" class="form-control form-control-line" name="extrainfo" value="<?php echo (isset($_SESSION['banner_client']['extrainfo']))? $_SESSION['banner_client']['extrainfo']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input class="btn btn-success" type="button" value="Cambiar empresario" id="btn-send"/>
						</div>
					</div>
					<input type="hidden" name="type" value="2">
				</form>
			</div>
		</div>
	</div>
</div>
