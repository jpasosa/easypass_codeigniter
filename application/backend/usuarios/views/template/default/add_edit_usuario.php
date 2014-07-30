<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="bs-docs-container">
	<?php if(isset($editar) and $usuario->id()):?>
			<div class="lead">
				Edición del usuario:
				<span class="text-muted"><?php echo $usuario->identificacion();?></span>
			</div>
	<?php elseif(isset($editar) and !$usuario->id()):?>
			<div class="lead">No se encontró el usuario </div>
			</div>
		<?php return "";?>
	<?php else: ?>
			<div class="lead">Alta de un usuario</div>
	<?php endif;?>

<?php if(isset($errors) and is_array($errors)): ?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error_key => $error_text):?>
				<?php echo $error_text;?><br>
			<?php endforeach;?>
		</div>
<?php endif;?>

<form method="post" action="" role="form" autocomplete="off" class="bs-docs-container">

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
				<label for="nombre">Apellido</label>
				<input type="text" class="form-control custom-input-lg" name="apellido" id="apellido" placeholder="Ingrese el apellido" value="<?php echo $usuario->apellido(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Email</label>
				<input type="email" class="form-control custom-input-lg" name="email" id="email" placeholder="Ingrese el email" value="<?php echo $usuario->email(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Clave</label>
				<input type="password" class="form-control custom-input-lg" name="clave" id="email" placeholder="Ingrese la clave" value="">
			</div>
			<div class="form-group">
				<label for="estado_usuario">Activo</label>
				<select name="estado_usuario" class="form-control custom-input-lg" >
					<option value="1" <?php if ($usuario->estado_usuario() == 1)	echo 'selected="selected"' ?> >SI</option>
					<option value="0" <?php if ($usuario->estado_usuario() == 0)	echo 'selected="selected"' ?> >NO</option>
				</select>
			</div>
			<div class="form-group">
				<label for="id_rol">Rol</label>
				<select name="id_rol" id="id_rol" class="form-control custom-input-lg" >
			    		<option value="">Ingrese el Rol</option>
			    		<?php foreach($roles as $rol):?>
			    			<?php if($rol['id_rol'] == $usuario->id_rol()):?>
			    				<option value="<?php echo $rol['id_rol'];?>" selected="selected">
			    					<?php echo $rol['descripcion'];?>
			    				</option>
			    			<?php else:?>
			    				<option value="<?php echo $rol['id_rol'];?>">
			    					<?php echo $rol['descripcion'];?>
			    				</option>
			    			<?php endif;?>
			    		<?php endforeach;?>
		    		</select>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Datos Ubicación</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="nombre">Calle</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[calle]" id="email" placeholder="Ingrese la calle" value="<?php echo $usuario->localizacion->calle();?>">
			</div>
			<div class="form-group">
				<label for="nombre">Número</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[numero]" id="email" placeholder="Ingrese el número" value="<?php echo $usuario->localizacion->numero();?>">
			</div>
			<div class="form-group">
				<label for="nombre">Piso / Dpto</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[piso]" id="email" placeholder="Ingrese el Piso / Dpto" value="<?php echo $usuario->localizacion->piso();?>">
			</div>
			<div class="form-group">
				<label for="codigo_postal">Código Postal</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[codigo_postal]" id="codigo_postal" placeholder="Ingrese el código postal" value="<?php echo $usuario->localizacion->codigo_postal();?>">
			</div>
			<div class="form-group">
				<label for="nombre">Teléfono</label>
				<input type="text" class="form-control custom-input-lg" name="telefono" id="email" placeholder="Ingrese el teléfono" value="<?php echo $usuario->telefono(); ?>">
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
				<label for="estado_usuario">Vendedor</label>
				<select name="estado_usuario" id="estado_usuario" class="form-control custom-input-lg" >
					<option>SI</option>
					<option>NO</option>
				</select>
			</div>
			<div class="form-group">
				<label for="nombre">CUIT</label>
				<input type="text" class="form-control custom-input-lg" name="cuit" id="apellido" placeholder="Ingrese el Cuit" value="<?php echo $usuario->cuit(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">IIBB</label>
				<input type="text" class="form-control custom-input-lg" name="iibb" id="apellido" placeholder="Ingrese el IIBB" value="<?php echo $usuario->iibb(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Razón Social</label>
				<input type="text" class="form-control custom-input-lg" name="razon_social" id="apellido" placeholder="Ingrese la razon social." value="<?php echo $usuario->razon_social(); ?>">
			</div>
		</div>
	</div>






	<button type="submit" class="btn btn-default">Guardar datos</button>
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