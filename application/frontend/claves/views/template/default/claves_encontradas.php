<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="bs-docs-container">

	<?php if (isset($msg)): ?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Perfecto!</strong> <?php echo $msg; ?>
		</div>
	<?php endif; ?>
	<?php if (isset($msg_error)): ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert">x</a>
			<strong>Error!</strong> <?php echo $msg_error; ?>
		</div>
	<?php endif; ?>


<h2 id="">Listado de Claves Encontradas</h2>
<div class="table-responsive bs-docs-container">

	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Titulo</th>
				<th>Url</th>
				<th>Usuario</th>
				<th>Clave</th>
				<th>Acción</th>
			</tr>
		</thead>
		<br />
		<tbody>
			<?php if(isset($claves_encontradas)): ?>
						<h3><?php //echo $msg; ?></h3>
						<?php foreach($claves_encontradas as $cl):?>
							<tr id="tr_<?php echo $cl['id_clave']; ?>">
								<td><?php echo $cl['id_clave']; ?></td>
								<td><?php echo $cl['titulo']; ?></td>
								<td><?php echo $cl['url']; ?></td>
								<td><?php echo $cl['usuario']; ?></td>
								<td>
									<input type="password" value="<?php echo $this->encrypt->decode($cl['clave']); ?>" />
								</td>
								<td>
									<a  class="btn btn-default" href="<?php echo base_url('claves/editar') . '/' . $cl['id_clave'] . $this->config->item('url_suffix');?>">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a>
										<button class="delete btn "  type="button"  id="<?php echo $cl['id_clave'];?>" data-id="<?php echo $cl['id_clave'];?>">
											<span class="glyphicon glyphicon-remove-circle"></span>
										</button>
									</a>
								</td>
							</tr>
						<?php endforeach;?>
			<?php else: ?>
						<tr><td colspan="8">No se encontraron registros</td></tr>
			<?php endif; ?>
		</tbody>
	</table>
<?php if(isset($paginas)) echo $paginas;?>

</div>
</div>

<button id="copy-button" data-clipboard-text="Copy Me!" title="Click to copy me.">
	Copy to Clipboard
</button>
<script src="<?php echo PUBLIC_FOLDER . 'assets/js/ZeroClipboard.Core.min.js';  ?>"></script>
<script src="<?php echo PUBLIC_FOLDER . 'assets/js/main_clipboard.js'; ?>"></script>



<script>
$(document).ready(function()
{
	$("")
});
</script>


<script>
$(document).ready(function() {
	//##### ELIMINAR categoría #########
	$("body").on("click", ".delete", function(e)
	{
		e.returnValue   = false;
		var id_tag 	= this.id;
		if (confirm('Seguro de eliminarlo?')) {
			jQuery.ajax({
					type: "POST",
					url: _base_url + '/tags/erase_ajax',
					dataType: "text",
					data: {
					id_tag: id_tag
				},
				success:function(response, status, xhr){
					$('tr#tr_'+id_tag).fadeOut("slow");
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	});
});
</script>

