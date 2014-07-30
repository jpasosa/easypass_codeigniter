<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="bs-docs-container">
<h2 id="">Listado de usuarios</h2>
<?php if($this->session->flashdata('success') != ''):?>
<div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
<?php endif;?>

<form method="post" action="<?php echo $form_action; ?>" enctype="multipart/form-data" role="form" autocomplete="off" id="my-form" class="bs-docs-container" >
	<label>Filtrar por &nbsp;&nbsp; </label>
	<select name="tipo_filtro">
		<option value="id_usuario" <?php if(isset($tipo_filtro) && $tipo_filtro=='id_usuario') echo 'selected="selected"'; ?> >Id</option>
		<option value="email" <?php if(isset($tipo_filtro) && $tipo_filtro=='email') echo 'selected="selected"'; ?> >Email</option>
		<option value="apellido" <?php if(isset($tipo_filtro) && $tipo_filtro=='apellido') echo 'selected="selected"'; ?> >Apellido</option>
	</select>

	<label>Rol &nbsp;&nbsp; </label>
	<select name="id_rol">
		<option value=0>Todos</option>
		<?php foreach ($roles AS $rol): ?>
			<option value="<?php echo $rol['id_rol']; ?>" <?php if(isset($id_rol) && $id_rol==$rol['id_rol']) echo 'selected="selected"'; ?> >
				<?php echo $rol['descripcion']; ?>
			</option>
		<?php endforeach; ?>
	</select>

	<div class="form-group">
		<label for="valor"> Palabra Clave</label>
		<input type="text" class="form-control custom-input-lg" name="valor" id="marca" placeholder="Ingrese un valor de Búsqueda" value="<?php if(isset($valor_filtro))	echo $valor_filtro; ?>">
	</div>
	<button type="submit" class="btn btn-default">Filtrar</button>
	<button type="button" class="btn btn-default reset">Resetear</button>
</form>


<div class="table-responsive bs-docs-container">
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Email</th>
				<th>Teléfono</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($usuarios) and sizeof($usuarios) > 0 ): ?>
			<?php foreach($usuarios as $usuario):?>
			<tr id="tr_<?php echo $usuario['id_usuario']?>">
				<td><?php echo $usuario['id_usuario']?></td>
				<td><?php echo $usuario['nombre']?></td>
				<td><?php echo $usuario['apellido']?></td>
				<td><?php echo $usuario['email']?></td>
				<td><?php echo $usuario['telefono']?></td>
				<td><?php echo $usuario['descripcion'];?></td>
				<td>
					<a  class="btn btn-default" href="<?php echo base_url('admin/usuarios/editar') . '/' . $usuario['id_usuario'] . $this->config->item('url_suffix');?>" >
						<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a  class="btn btn-default" href="<?php echo base_url('admin/mediospago/lista') . '/' . $usuario['id_usuario'] . $this->config->item('url_suffix');?>" >
						<span class="glyphicon glyphicon-usd"></span>
					</a>
					<button class="delete btn " type="button"  data-id="<?php echo $usuario['id_usuario'];?>">
						<span class="glyphicon glyphicon-remove-circle"></span>
					</button>
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



<script type="text/javascript">
	$(function(){
		$('.delete').bind('click',function(e){
			var id = $(this).data('id');
			console.log(id);
		});
	});
</script>



<script>
	$(document).ready(function() {
		//##### Resetear FILTROS #########
		$("body").on("click", ".reset", function(e)
		{
			e.returnValue   = false;
			jQuery.ajax({
					type: "POST",
					url: _base_url + 'admin/usuarios/resetFilters',
					dataType: "json",
					data: {},
				success:function(data, status, xhr){
					location.reload();
					// console.log(data.mensaje);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert('Error: ' + thrownError);
				}
			});
		});
	});
</script>


