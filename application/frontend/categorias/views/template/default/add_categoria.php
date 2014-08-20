<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<a class="lead" id="desplegar-form">Alta de Categoria</a>

	<!-- ERRORES -->
	<br />
	<?php foreach ($errores_validacion AS $err): ?>
		<span style="color: red;"><?php echo $err; ?></span><br />
	<?php endforeach; ?>


	<form method="post" action="<?php echo $url_action; ?>" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
		<div id="home">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control custom-input-lg" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $categoria['nombre']?>">
			</div>

			<?php if(isset($categoria['id_categoria'])):?>
				<input type="hidden"  name="id_categoria" value="<?php echo $categoria['id_categoria']?>">
			<?php endif;?>

			<button type="submit" class="btn btn-default">Guardar datos</button>
		</div>
	</form>
</div>



<script type="text/javascript">
	$( document ).ready(function() {
	      $( "#nombre" ).focus();
	});
</script>

