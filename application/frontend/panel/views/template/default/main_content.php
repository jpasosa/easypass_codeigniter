


<div class="errors_debito">
	<?php if (isset($errors)): ?>
		<?php if ($errors != false): ?>
			<?php foreach ($errors AS $message_error): ?>
				<?php echo $message_error . '<br />'; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>


<form action="<?php echo $form_action; ?>" method="post" name="form_entrada" target="_self" >
	<!-- NÚMERO DE CLIENTE -->
	<div class="form-group">
		<label for="nrocliente">Nro Cliente</label>
		<select name="nrocliente" class="chzn-select form-control" id="nrocliente" placeholder="nro cliente">
			<option value=""> Seleccione cliente. . .</option>
			<!--
			<?php foreach($clientes as $cl):?>
				<option value="<?php echo $cl['id_clientes'] . ':' . $cl['nro_cliente'] . ':' . $cl['cbu']; ?>" >
					<?php echo $cl['nombre_apellido']. " - ". $cl['nro_cliente'];?>
				</option>
			<?php endforeach;?>
			-->
		</select>
	</div>

	<!-- CBU -->
	<div class="form-group">
		<label for="cbu">CBU</label>
		<input type="text" name="cbu" class="form-control" id="cbu" readonly="readonly" maxlength="8" size="8" value="datosdeprueba">
		<span class="help-block"> (8 Digitos - 14 Digitos) </span>
	</div>datosdeprueba

	<!-- FECHA COBRO CLIENTE -->
	<div class="form-group">
		<label for="cbu">Fecha Cobro Cliente</label>
		<input type="text" id="fecha_cobro" name="cobro" class="form-control" maxlength="8" size="8" value="datosdeprueba">
		<span class="help-block"> Fecha del tipo Año mes día. Ejemplo ( 20080831 ) </span>
	</div>

	<!-- FECHA SIGUIENTE DÍA HÁBIL -->
	<div class="form-group">
		<label for="cbu">Fecha Siguiente día hábil</label>
		<input type="text" id="fecha_siguiente" name="diahabil" class="form-control" maxlength="8" size="8" value="datosdeprueba">
	</div>

	<!-- IMPORTE -->
	<div class="form-group">
		<label for="cbu">IMPORTE</label>
		<input type="text" class="form-control" name="importe" maxlength="10" size="10" value="datosdeprueba">
		<span class="help-block"> Separa decimales con . Ejemplo ( 105.23; 10059.50 ) </span>
	</div>

	<!-- NRO_FACTURA -->
	<div class="form-group">
		<label for="cbu">NÚMERO DE FACTURA</label>
		<input type="text" name="nrofactura" class="form-control" maxlength="15" size="15" value="datosdeprueba">
		<span class="help-block">  </span>
	</div>

	<button type="submit" name="grabar" class="btn btn-default" value="1">Grabar</button>

	<?php if ($show_finalizar): ?>
		<button type="submit" name="finalizar" class="btn btn-default" value="1">Finalizar</button>
	<?php endif; ?>

</form>



