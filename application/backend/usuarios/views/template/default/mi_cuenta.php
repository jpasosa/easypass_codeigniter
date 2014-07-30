<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="bs-docs-container">
	<?php if(isset($success)): ?><div class="alert alert-success"><?php echo $success;?></div><?php endif;?>
	<?php if(isset($error_update)): ?><div class="alert alert-danger"><?php echo $error_update;?></div><?php endif;?>

	<?php if(isset($errors) && count($errors) > 0 ): ?>
		<div class="alert alert-danger">
			<?php foreach($errors AS $error_text):?>
				<?php echo $error_text;?><br />
			<?php endforeach;?>
		</div>
	<?php endif;?>




	<div class="lead">Mi Cuenta</div>
	<form method="post" action="<?php echo $form_action; ?>" role="form" autocomplete="off" class="bs-docs-container">
		<input type="hidden" value="<?php echo $usuario->id_localizacion(); ?>" name="localizacion[id_localizacion]" />

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Datos Personales</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control custom-input-lg" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $usuario->nombre(); ?>">
				</div>
				<div class="form-group">
					<label for="apellido">Apellido</label>
					<input type="text" class="form-control custom-input-lg" name="apellido" id="apellido" placeholder="Ingrese el apellido" value="<?php echo $usuario->apellido(); ?>">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control custom-input-lg" name="email" id="email" placeholder="Ingrese el email" value="<?php echo $usuario->email(); ?>">
				</div>
				<div class="form-group">
					<label for="clave">Clave</label>
					<input type="password" class="form-control custom-input-lg" name="clave" id="clave" placeholder="Ingrese una nueva clave" value="">
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Datos Ubicacion</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="calle">Calle</label>
					<input type="text" class="form-control custom-input-lg" name="localizacion[calle]" id="calle" placeholder="Ingrese el nombre de la calle" value="<?php echo $usuario->localizacion->calle();?>">
				</div>
				<div class="form-group">
					<label for="numero">Número</label>
					<input type="text" class="form-control custom-input-lg" name="localizacion[numero]" id="numero" placeholder="Ingrese el número" value="<?php echo $usuario->localizacion->numero();?>">
				</div>
				<div class="form-group">
					<label for="piso">Piso / Dpto</label>
					<input type="text" class="form-control custom-input-lg" name="localizacion[piso]" id="piso" placeholder="Ingrese el Piso / Dpto" value="<?php echo $usuario->localizacion->piso();?>">
				</div>
				<div class="form-group">
					<label for="codigo_postal">Código Postal</label>
					<input type="text" class="form-control custom-input-lg" name="localizacion[codigo_postal]" id="codigo_postal" placeholder="Ingrese el código postal" value="<?php echo $usuario->localizacion->codigo_postal();?>">
				</div>
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control custom-input-lg" name="telefono" id="telefono" placeholder="Ingrese el teléfono" value="<?php echo $usuario->telefono(); ?>">
				</div>
				<div class="form-group">
					<label for="id_pais">País</label>
					<select name="localizacion[id_pais]" id="id_pais" class="form-control custom-input-lg">
				    		<option value="">Seleccione un país</option>
				    		<?php foreach($paises as $pais):?>
				    			<?php if($pais['id_pais'] == $usuario->localizacion->id_pais()):?>
				    				<option value="<?php echo $pais['id_pais'];?>" selected="selected">
				    					<?php echo $pais['pais'];?>
				    				</option>
				    			<?php else:?>
				    				<option value="<?php echo $pais['id_pais'];?>">
				    					<?php echo $pais['pais'];?>
				    				</option>
				    			<?php endif;?>
				    		<?php endforeach;?>
			    		</select>
				</div>

				<div class="form-group">
					<label for="id_provincia">Provincias</label>
					<select name="localizacion[id_provincia]" id="id_provincia" class="form-control custom-input-lg">
				    		<option value="">Seleccione una provincia</option>
				    		<?php foreach($provincias as $provincia):?>
				    			<?php if($provincia['id_provincia'] == $usuario->localizacion->id_provincia()):?>
				    				<option value="<?php echo $provincia['id_provincia'];?>" selected="selected">
				    					<?php echo $provincia['provincia'];?>
				    				</option>
				    			<?php else:?>
				    				<option value="<?php echo $provincia['id_provincia'];?>">
				    					<?php echo $provincia['provincia'];?>
				    				</option>
				    			<?php endif;?>
				    		<?php endforeach;?>
			    		</select>
			    	</div>
				<div class="form-group">
					<label for="id_localidad">Localidades</label>
					<select name="localizacion[id_localidad]" id="id_localidad" class="form-control custom-input-lg" >
				    		<option value="">Seleccione una localidad</option>
				    		<?php foreach($localidades as $loc):?>
				    			<?php if($loc['id_localidad'] == $usuario->localizacion->id_localidad()):?>
				    				<option value="<?php echo $loc['id_localidad'];?>" selected="selected">
				    					<?php echo $loc['localidad'];?>
				    				</option>
				    			<?php else:?>
				    				<option value="<?php echo $loc['id_localidad'];?>">
				    					<?php echo $loc['localidad'];?>
				    				</option>
				    			<?php endif;?>
				    		<?php endforeach;?>
			    		</select>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Datos Vendedor</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="cuit">CUIT</label>
					<input type="text" class="form-control custom-input-lg" name="cuit" id="cuit" placeholder="Ingrese el cuit" value="<?php echo $usuario->cuit(); ?>">
				</div>
				<div class="form-group">
					<label for="iibb">IIBB</label>
					<input type="text" class="form-control custom-input-lg" name="iibb" id="iibb" placeholder="Ingrese el iibb" value="<?php echo $usuario->iibb(); ?>">
				</div>
				<div class="form-group">
					<label for="razon_social">Razón Social</label>
					<input type="text" class="form-control custom-input-lg" name="razon_social" id="razon_social" placeholder="Ingrese la razon social" value="<?php echo $usuario->razon_social(); ?>">
				</div>
			</div>
		</div>




		<button type="submit" name="submit" class="btn btn-default">Guardar datos</button>
	</form>
</div>

<script type="text/javascript">
$(function()
{

	$('#id_localidad').bind('change',function(e) {
		var id_localidad = $(this).val();
		get_localidad_by_id(id_localidad);
	});

	<?php if($this->usuario->id()):?>
		$('#id_provincia').bind('change',function(e){
			var id_provincia = $(this).val();
			var id_localidad = <?php echo $this->localizacion->id_localidad();?>
			get_localidades_by_provincia(id_provincia,'create_select_options', id_localidad);
			//get_localidades_by_provincia(id_provincia, 'create_select_options', 1);

		});
	<?php else:?>
		$('#id_provincia').bind('change',function(e){
			var id_provincia = $(this).val();
			get_localidades_by_provincia(id_provincia,'create_select_options','');
		});
		console.log("chauuuu");
	<?php endif;?>
});
</script>


