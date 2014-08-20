<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<a class="lead" id="desplegar-form">Búsqueda Rápida</a>

	<!-- ERRORES -->
	<br />



	<form method="post" action="<?php echo $form_action; ?>" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
		<div id="home">
			<div class="form-group">
				<label for="dni">Categoria</label>
				<select name="id_categoria" class="form-control custom-input-lg">
	    				<option value="0" >Es indistinto.</option>
	    				<?php foreach ($categorias AS $cat): ?>
	    						<option value="<?php echo $cat['id_categoria']; ?>" >
	    							<?php echo $cat['nombre'];?>
	    						</option>
	    				<?php endforeach; ?>
	    			</select>
			</div>
			<div class="form-group">
				<label for="nombre">busqueda</label>
				<input type="text" class="form-control custom-input-lg" name="palabras" id="palabras" placeholder="Ingrese palabras separadas por espacio" value="">
			</div>

			<button type="submit" class="btn btn-default">Buscar</button>
		</div>
	</form>
</div>





<script type="text/javascript">
	$( document ).ready(function() {
	      $( "#palabras" ).focus();
	});
</script>


