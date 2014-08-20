<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<a class="lead" id="desplegar-form">Alta de Emails</a>

	<!-- ERRORES -->
	<br />
	<?php foreach ($errores_validacion AS $err): ?>
		<span style="color: red;"><?php echo $err; ?></span><br />
	<?php endforeach; ?>


	<form method="post" action="<?php echo $url_action; ?>" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
		<div id="home">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="email" class="form-control custom-input-lg" name="nombre_email" id="nombre_email" placeholder="Ingrese el nombre del mail" value="<?php echo $email['nombre_email']?>">
			</div>
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<textarea class="form-control custom-input-lg" name="descripcion_email" placeholder="Ingrese el descripcion"><?php echo $email['descripcion_email']?></textarea>
			</div>


			<?php if(isset($email['id_email'])):?>
				<input type="hidden"  name="id_email" value="<?php echo $email['id_email']?>">
			<?php endif;?>

			<button type="submit" class="btn btn-default">Guardar datos</button>
		</div>
	</form>
</div>



<script type="text/javascript">
	$( document ).ready(function() {
	      $( "#nombre_email" ).focus();
	});
</script>

