<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<a class="lead" id="desplegar-form">Edición de un Acceso</a>

	<!-- ERRORES -->
	<br />

	<?php if (count($errores_validacion) > 0): ?>
		<div class="alert alert-danger">
			<?php foreach ($errores_validacion AS $err): ?>
				<?php echo $err; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

<?php if($this->session->flashdata('success') != ''):?>
	<?php endif;?>

	<form method="post" action="<?php echo $url_action; ?>" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
		<div id="home">
			<div class="form-group">
				<label for="dni">Categoria</label>
				<select name="id_categoria" class="form-control custom-input-lg">
	    				<option value="0" <?php if ($clave['id_categoria'] == 0) 	echo 'selected="selected"'; ?>>En todas.</option>
	    				<?php foreach ($categorias AS $cat): ?>
	    					<?php if ($cat['id_categoria'] == $clave['id_categoria']): ?>
	    						<option value="<?php echo $cat['id_categoria']; ?>" selected="selected">
	    							<?php echo $cat['nombre'];?>
	    						</option>
	    					<?php else: ?>
	    						<option value="<?php echo $cat['id_categoria']; ?>">
	    							<?php echo $cat['nombre'];?>
	    						</option>
	    					<?php endif; ?>
	    				<?php endforeach; ?>
	    			</select>
			</div>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="titulo" id="titulo" placeholder="Ingrese el titulo" value="<?php echo $clave['titulo']?>">
			</div>
			<div class="form-group">
				<div id="listado_de_numeros" class="table-responsive bs-docs-container">
					<div class="side-by-side clearfix">
						<div>
							<label for="nombre">Tags</label>
							<br />
							<select data-placeholder="Seleccione los tags. . ." name="tags[]" style="width:350px;" multiple="multiple" class="chosen-select">
								<option value=""></option>
								<?php foreach ($tags AS $ad): ?>
									<option value="<?php echo $ad['id_tag'] ?>"
										<?php if (in_array($ad['id_tag'], $clave['tags'])): echo 'selected="selected"';endif; ?> >
										<?php echo $ad['nombre_tag']; ?>
									</option>
								<?php endforeach; ?>

							</select>
						</div>
						<br />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="nombre">Url</label>
				<input type="text" class="form-control custom-input-lg" name="url" id="url" placeholder="Ingrese el url" value="<?php echo $clave['url']?>">
			</div>
			<div class="form-group">
				<label for="nombre">Puerto</label>
				<input type="text" class="form-control custom-input-lg" name="puerto" id="puerto" placeholder="Ingrese el puerto" value="<?php echo $clave['puerto']?>">
			</div>
			<div class="form-group">
				<label for="dni">Email</label>
				<select name="id_email" class="form-control custom-input-lg">
	    				<option value="0" <?php if ($clave['id_email'] == 0) 	echo 'selected="selected"'; ?>>No se relaciona con ningún email.</option>
	    				<?php foreach ($emails AS $email): ?>
	    					<?php if ($email['id_email'] == $clave['id_email']): ?>
	    						<option value="<?php echo $email['id_email']; ?>" selected="selected">
	    							<?php echo $email['nombre_email'];?>
	    						</option>
	    					<?php else: ?>
	    						<option value="<?php echo $email['id_email']; ?>">
	    							<?php echo $email['nombre_email'];?>
	    						</option>
	    					<?php endif; ?>
	    				<?php endforeach; ?>
	    			</select>
			</div>
			<div class="form-group">
				<label for="dni">Email Alternativo</label>
				<select name="id_email_alt" class="form-control custom-input-lg">
	    				<option value="0" <?php if ($clave['id_email_alt'] == 0) 	echo 'selected="selected"'; ?>>No se relaciona con ningún email.</option>
	    				<?php foreach ($emails AS $email): ?>
	    					<?php if ($email['id_email'] == $clave['id_email_alt']): ?>
	    						<option value="<?php echo $email['id_email']; ?>" selected="selected">
	    							<?php echo $email['nombre_email'];?>
	    						</option>
	    					<?php else: ?>
	    						<option value="<?php echo $email['id_email']; ?>">
	    							<?php echo $email['nombre_email'];?>
	    						</option>
	    					<?php endif; ?>
	    				<?php endforeach; ?>
	    			</select>
			</div>
			<div class="form-group">
				<label for="nombre">Usuario</label>
				<input type="text" class="form-control custom-input-lg" name="usuario" id="usuario" placeholder="Ingrese el usuario" value="<?php echo $clave['usuario']?>">
			</div>
			<div class="form-group">
				<label for="nombre">Clave</label>
				<input type="password" class="form-control custom-input-lg" name="clave" id="clave" placeholder="Ingrese el clave" value="<?php echo $clave['clave']?>">
			</div>
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<textarea class="form-control custom-input-lg" name="descripcion" id="descripcion" placeholder="Ingrese el descripcion"><?php echo $clave['descripcion']?></textarea>
			</div>

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
	// var config = {
	// 	'.chosen-select'           : {},
	// 	'.chosen-select-deselect'  : {allow_single_deselect:true},
	// 	'.chosen-select-no-single' : {disable_search_threshold:10},
	// 	'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	// 	'.chosen-select-width'     : {width:"95%"}
	// }
	// for (var selector in config) {
	// 	$(selector).chosen(config[selector]);
	// }
	$(".chosen-select").chosen(
	{
		allow_single_deselect:true,
		disable_search_threshold: 10,
		no_results_text: "No pudimos encontrar nada!",
		search_contains: true,
		width: "55%"
	});
</script>

</div>