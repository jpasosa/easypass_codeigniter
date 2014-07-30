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


<h2 id="">Listado de Emails</h2>
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
			<?php if(isset($emails)): ?>
						<h3><?php //echo $msg; ?></h3>
						<?php foreach($emails as $email):?>
							<tr id="tr_<?php echo $email['id_email']; ?>">
								<td><?php echo $email['id_email']; ?></td>
								<td><?php echo $email['nombre_email']; ?></td>
								<td>
									<a  class="btn btn-default" href="<?php echo base_url('emails/editar') . '/' . $email['id_email'] . $this->config->item('url_suffix');?>">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a>
										<button class="delete btn "  type="button"  id="<?php echo $email['id_email'];?>" data-id="<?php echo $email['id_email'];?>">
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
	//##### ELIMINAR categoría #########
	$("body").on("click", ".delete", function(e)
	{
		e.returnValue   = false;
		var id_email 	= this.id;
		if (confirm('Seguro de eliminarlo?'))
		{
			jQuery.ajax({
					type: "POST",
					url: _base_url + '/emails/erase_ajax',
					dataType: "json",
					data: {
					id_email: id_email
				},
				success:function(data)
				{
					if(data.ok) {
						$('tr#tr_'+id_email).fadeOut("slow");
					} else {
						alert("No se puede eliminar, debe estar ingresado ya en un acceso.");
					}
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	});
});
</script>

