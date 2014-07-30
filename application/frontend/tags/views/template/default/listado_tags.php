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


<h2 id="">Listado de Tags</h2>
<div class="table-responsive bs-docs-container">

	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Acción</th>
			</tr>
		</thead>
		<br />
		<tbody>
			<?php if(isset($tags)): ?>
						<h3><?php //echo $msg; ?></h3>
						<?php foreach($tags as $tag):?>
							<tr id="tr_<?php echo $tag['id_tag']; ?>">
								<td><?php echo $tag['id_tag']; ?></td>
								<td><?php echo $tag['nombre_tag']; ?></td>
								<td>
									<a  class="btn btn-default" href="<?php echo base_url('tags/editar') . '/' . $tag['id_tag'] . $this->config->item('url_suffix');?>">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a>
										<button class="delete btn "  type="button"  id="<?php echo $tag['id_tag'];?>" data-id="<?php echo $tag['id_tag'];?>">
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




<script>
$(document).ready(function() {
	//##### Aumentar el porcentaje de toda la base #########
	$("body").on("click", ".btn_porcentaje", function(e)
	{
		e.returnValue   = false;
		var porcentaje 	= $("#porcentaje").val();
		if (confirm('Seguro desea modificar los valores de todas las categorías?')) {
			jQuery.ajax({
					type: "POST",
					url: _base_url + '/categorias/sumPorcentajes',
					dataType: "text",
					data: {
					porcentaje: porcentaje
				},
				success:function(response, status, xhr){
					location.reload();
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	});
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

