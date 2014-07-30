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
	    				<option value="0" >En todas.</option>
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





<script type="text/javascript">
	$(function(){
		$('.delete').bind('click',function(e){
			var id = $(this).data('id');
			console.log(id);
		});
	});
</script>



<script src="<?php echo PUBLIC_FOLDER;?>assets/chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo PUBLIC_FOLDER;?>assets/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var config = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"80%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
</script>

</div>