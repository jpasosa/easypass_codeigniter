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

			<?php if(isset($email['id_email'])):?>
				<input type="hidden"  name="id_email" value="<?php echo $email['id_email']?>">
			<?php endif;?>

			<button type="submit" class="btn btn-default">Guardar datos</button>
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
		'.chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
</script>

</div>