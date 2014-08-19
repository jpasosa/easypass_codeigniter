<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<a class="lead" id="desplegar-form">Vista Detalle de un Acceso</a>


	<form method="post" action="" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
		<div id="home">
			<div class="form-group">
				<label for="dni">Categoria</label>
				<select name="id_categoria" class="form-control custom-input-lg" disabled="disabled">
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
				<input type="text" class="form-control custom-input-lg" name="titulo" id="titulo" readonly="readonly" value="<?php echo $clave['titulo']?>">
			</div>
			<div class="form-group">
				<div id="listado_de_numeros" class="table-responsive bs-docs-container">
					<div class="side-by-side clearfix">
						<div>
							<label for="nombre">Tags</label>
							<br />
							<select data-placeholder="Seleccione los tags. . ." name="tags[]" style="width:350px;" multiple="multiple" class="chosen-select" disabled="disabled">
								<!-- <option value=""></option> -->
								<?php foreach ($tags AS $ad): ?>
									<option value="<?php echo $ad['id_tag'] ?>"
										<?php if (in_array($ad['id_tag'], $tags_claves)): echo 'selected="selected"';endif; ?> >
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
				<input type="text" class="form-control custom-input-lg" name="url" id="url" readonly="readonly" value="<?php echo $clave['url']?>">
			</div>
			<div class="form-group">
				<label for="nombre">Puerto</label>
				<input type="text" class="form-control custom-input-lg" name="puerto" id="puerto" readonly="readonly" value="<?php echo $clave['puerto']?>">
			</div>
			<div class="form-group">
				<label for="dni">Email</label>
				<select name="id_email" class="form-control custom-input-lg" disabled="disabled">
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
				<label for="nombre">Usuario</label>
							<button class="copy-button" title="<?php echo $clave['usuario']; ?>" data-clipboard-text="<?php echo $this->encrypt->decode($clave['clave']); ?>" title="Click to copy me.">
										<?php echo $clave['usuario']; ?>
									</button>
			</div>
			<div class="form-group">
				<label for="nombre">Clave</label>
									<button class="copy-button" title="<?php echo $this->encrypt->decode($clave['clave']); ?>" data-clipboard-text="<?php echo $this->encrypt->decode($clave['clave']); ?>" title="Click to copy me.">
										<?php echo $this->encrypt->decode($clave['clave']); ?>
									</button>
			</div>
			<div class="form-group">
				<label for="nombre">Descripcion</label>
				<textarea class="form-control custom-input-lg" name="descripcion" id="descripcion" readonly="readonly"><?php echo $clave['descripcion']?></textarea>
			</div>
			<a href="#">
				<button type="button" class="btn btn-default">Editar Acceso</button>
			</a>
			<a href="#">
				<button type="button" id="<?php echo $clave['id_clave']; ?>" class="btn btn-default eliminar_acceso">Eliminar Acceso</button>
			</a>
		</div>
	</form>

</div>




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

	$(".chosen-select").chosen(
	{
		allow_single_deselect:true,
		disable_search_threshold: 10,
		no_results_text: "No pudimos encontrar nada!",
		search_contains: true,
		width: "55%"
	});

	$('.copy-button').click(function() {
		var clave = $(this).data("clipboard-text");
		console.log("la clave es " , clave);
	});
      var client = new ZeroClipboard( $('.copy-button') );
      client.on( 'ready', function(event) {
       console.log( 'movie is loaded' );

        client.on( 'copy', function(event) {
          event.clipboardData.setData('text/plain', event.target.innerHTML);
        } );

        client.on( 'aftercopy', function(event) {
          console.log('Copied text to clipboard: ' + event.data['text/plain']);

        } );
      } );

      client.on( 'error', function(event) {
        console.log( 'ZeroClipboard error of type "' + event.name + '": ' + event.message );
        ZeroClipboard.destroy();
      } );


      //##### ELIMINAR acceso #########
	$("body").on("click", ".eliminar_acceso", function(e)
	{
		e.preventDefault();
		var id_clave 	= this.id;
		if (confirm('Seguro de eliminarlo?'))
		{
			jQuery.ajax(
			{
				type: "POST",
				url: _base_url + 'claves/erase_ajax',
				dataType: "text",
				data: {
					id_clave: id_clave
				},
				success:function(response, status, xhr)
				{
					alert("Accesos eliminado.");
					// location.reload("pepepep");
					window.location.href = _base_url + "login.html";
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	});
</script>


