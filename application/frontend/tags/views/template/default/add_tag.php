<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<a class="lead" id="desplegar-form">Alta de Tags</a>

	<!-- ERRORES -->
	<br />
	<?php foreach ($errores_validacion AS $err): ?>
		<span style="color: red;"><?php echo $err; ?></span><br />
	<?php endforeach; ?>


	<form method="post" action="<?php echo $url_action; ?>" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
		<div id="home">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control custom-input-lg" name="nombre_tag" id="nombre_tag" placeholder="Ingrese el nombre. Una sola pabra seguida." value="<?php echo $tag['nombre_tag']?>">
			</div>

			<?php if(isset($tag['id_tag'])):?>
				<input type="hidden"  name="id_tag" value="<?php echo $tag['id_tag']?>">
			<?php endif;?>

			<button type="submit" class="btn btn-default">Guardar datos</button>
		</div>
	</form>
</div>



<script type="text/javascript">
	$( document ).ready(function()
	{
	      $( "#nombre_tag" ).focus();


		$("#nombre_tag").keydown(function (e)
		{
		     if (e.keyCode == 32)
		     {
		       $(this).val($(this).val() + "-"); // append '-' to input
		       return false; // return false to prevent space from being added
		     }
		});
	});
</script>


