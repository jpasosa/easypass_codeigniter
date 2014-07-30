<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row">

 <div class="twelve columns" style="margin-top:10px;">
  <h3><?php echo lang('text_title_registrarse');?></h3>
  <p> <?php echo lang('text_title_registrarse_bajada');?></p>  <hr />
 </div>

 <div class="twelve columns" style="margin-top:30px;">
 <div class="twelve columns">
 <p>&nbsp;</p>
<div>

<script>

$(function(){
	$('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
});
</script>


<form name="form2" method="post" method="post" enctype="multipart/form-data"  action="<?php echo PUBLIC_FOLDER;?>admin/usuarios/registrarse<?php echo $this->config->item('url_suffix');?>" >
  <input type="hidden" name="submit" value="1">
 <label> </label>
 <table width="100%" border="0">
   <tr>
     <td width="100%"><table width="100%" border="0">
       <tr align="left">
         <td colspan="6" style="border-bottom: 1px solid #ededed;"><h7><?php echo lang('text_datos_personales');?></h7></td>
       </tr>
       <tr>
         <td width="9%" align="left"><?php echo lang('text_nombre');?>  <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td width="31%"><input style="width:100%" type="text" name="nombre" id="nombre" value="<?php if(isset($usuario['nombre'])) echo $usuario['nombre'];?>"><?php if(isset($errors['nombre'])):?><label class="error">Incorrecto</label><?php endif;?></td>
         <td width="9%"><?php echo lang('text_apodo');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"><img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
         <td width="15%"><input style="width:100%" type="text" name="apodo" id="apodo"  value="<?php if(isset($usuario['apodo'])) echo $usuario['apodo'];?>"></td>
         <td width="12%" align="left"><?php echo lang('text_fechaNacimiento');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td width="27%"><input style="width: 100%" class="datepicker" type="text" name="fechaNacimiento" id="fechaNacimiento" value="<?php if(isset($usuario['fechaNacimiento'])) echo date('d-m-Y',strtotime($usuario['fechaNacimiento']));?>"> <?php if(isset($errors['fechaNacimiento'])):?><label class="error">Incorrecto</label><?php endif;?></td>
         </tr>
       <tr>
         <td align="left"><?php echo lang('text_apellido');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width:100%" type="text" name="apellido" id="apellido"  value="<?php if(isset($usuario['apellido'])) echo $usuario['apellido'];?>"><?php if(isset($errors['apellido'])):?><label class="error">Incorrecto</label><?php endif;?></td>
         <td><?php echo lang('text_clave');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width: 100%" type="password" name="clave" id="clave"></td>
         <td align="left"><?php echo lang('text_sexo');?></td>
         <td><select style="width:100%"  name="sexo" id="sexo">
     <?php if(isset($usuario['sexo']) and $usuario['sexo'] == lang('text_masculino')):?>
     <option value="<?php echo lang('text_masculino');?>" selected="selected"><?php echo lang('text_masculino');?></option>
     <?php else:?>
     <option value="<?php echo lang('text_masculino');?>"><?php echo lang('text_masculino');?></option>
     <?php endif;?>
     <?php if(isset($usuario['sexo']) and $usuario['sexo'] == lang('text_femenino')):?>
     <option value="<?php echo lang('text_femenino');?>" selected="selected"><?php echo lang('text_femenino');?></option>
     <?php else:?>
     <option value="<?php echo lang('text_femenino');?>"><?php echo lang('text_femenino');?></option>
     <?php endif;?>
     </select></td>
         </tr>
       <tr>
         <td align="left"><?php echo lang('text_email');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width:100%" type="text" name="email" id="email"  value="<?php if(isset($usuario['email'])) echo $usuario['email'];?>"><?php if(isset($errors['email'])):?><label class="error">Incorrecto</label><?php endif;?></td>
         <td><?php echo lang('text_clave_re');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width:100%" type="password" name="clave_re" id="clave_re"></td>
         <td align="left"><?php echo lang('text_foto');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
         <td><input style="width: 100%" type="file" name="foto" id="foto"></td>
       </tr>
       <tr>
         <td align="left"><?php echo lang('text_descripcion');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
         <td colspan="5"><textarea style="width:100%" name="descripcion" id="descripcion" placeholder="<?php echo lang('text_descripcion_placeholder');?>"><?php if(isset($usuario['descripcion'])) echo $usuario['descripcion'];?></textarea></td>
       </tr>
       </table></td>
   </tr>
   <tr>
     <td><br />
     <table width="100%" border="0">
           <tr align="left">
             <td colspan="8" style="border-bottom: 1px solid #ededed;"><h7><?php echo lang('text_redes_sociales');?></h7></td>
             </tr>
           <tr>
             <td width="105" align="left">Facebook <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="156"><input style="width:100%" type="text" name="facebook" id="facebook" value="<?php if(isset($usuario['facebook'])) echo $usuario['facebook'];?>"></td>
             <td width="106" align="left">Twitter <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" alt="" /></td>
             <td width="156"><input style="width:100%" type="text" name="twitter" id="twitter"  value="<?php if(isset($usuario['twitter'])) echo $usuario['twitter'];?>"></td>
             <td width="105" align="left">Pinterest <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" alt="" /></td>
             <td width="156"><input style="width:100%" type="text" name="pinterest" id="pinterest" value="<?php if(isset($usuario['pinterest'])) echo $usuario['pinterest'];?>"></td>
             <td width="105" align="left">Instagram <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="154"><input style="width:100%" type="text" name="instagram" id="instagram" value="<?php if(isset($usuario['instagram'])) echo $usuario['instagram'];?>"></td>
             </tr>
           <tr>
             <td width="105" align="left">Linkedin <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td><input style="width:100%" type="text" name="linkedin" id="linkedin" value="<?php if(isset($usuario['linkedin'])) echo $usuario['linkedin'];?>"></td>
             <td width="106" align="left">Behance <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" alt="" /></td>
             <td width="156"><input style="width:100%" type="text" name="behance" id="behance" value="<?php if(isset($usuario['behance'])) echo $usuario['behance'];?>"></td>
             <td width="105" align="left">Devian Art <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="156"><input style="width:100%" type="text" name="devianart" id="devianart" value="<?php if(isset($usuario['devianart'])) echo $usuario['devianart'];?>"></td>
             <td width="105" align="left">YouTube <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="154"><input style="width:100%" type="text" name="youtube" id="youtube" value="<?php if(isset($usuario['youtube'])) echo $usuario['youtube'];?>"></td>
             </tr>
           <tr>
             <td width="108" align="left">Stumbleupon <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td><input style="width:100%" type="text" name="stumbleupon" id="stumbleupon" value="<?php if(isset($usuario['stumbleupon'])) echo $usuario['stumbleupon'];?>"></td>
             <td width="106" align="left">Google+ <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="156"><input style="width:100%" type="text" name="googleplus" id="googleplus" value="<?php if(isset($usuario['googleplus'])) echo $usuario['googleplus'];?>"></td>
             <td width="105" align="left">Flirck <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="156"><input style="width:100%" type="text" name="flirck" id="flirck" value="<?php if(isset($usuario['flirck'])) echo $usuario['flirck'];?>"></td>
             <td width="105" align="left">Otra <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon.png" /></td>
             <td width="154"><input style="width:100%" type="text" name="otra" id="otra" value="<?php if(isset($usuario['otra'])) echo $usuario['otra'];?>"></td>
           </tr>
           </table>
     <br /><br />
       <table width="100%" border="0">
       <tr>
         <td style="border-bottom: 1px solid #ededed;" colspan="8"><h7><?php echo lang('text_datos_envio');?></h7></td>
       </tr>
       <tr>
         <td width="9%"><?php echo lang('text_calle');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td width="15%"><input style="width:100%" type="text" name="calle" id="calle" value="<?php if(isset($usuario['calle'])) echo $usuario['calle'];?>"></td>
         <td width="5%" align="right"><?php echo lang('text_piso');?></td>
         <td width="18%"><input style="width:100%" type="text" name="piso" id="piso" value="<?php if(isset($usuario['piso'])) echo $usuario['piso'];?>"></td>
         <td width="13%" align="right"><?php echo lang('text_apartamento');?></td>
         <td width="15%"><input style="width:100%" type="text" name="apartamento" id="apartamento" value="<?php if(isset($usuario['apartamento'])) echo $usuario['apartamento'];?>"></td>
         <td width="6%" align="right"><?php echo lang('text_codigo_postal');?></td>
         <td width="16%"><input style="width:100%" type="text" name="codigoPostal" id="codigoPostal" value="<?php if(isset($usuario['codigoPostal'])) echo $usuario['codigoPostal'];?>"></td>
       </tr>
       <tr>
         <td><?php echo lang('text_localidad');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width:100%" type="text" name="localidad" id="localidad" value="<?php if(isset($usuario['localidad'])) echo $usuario['localidad'];?>"></td>
         <td align="right"><?php echo lang('text_ciudad');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width:100%" type="text" name="ciudad" id="ciudad" value="<?php if(isset($usuario['ciudad'])) echo $usuario['ciudad'];?>"></td>
         <td align="right"><?php echo lang('text_provincia');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"> </td>
         <td><input style="width:100%" type="text" name="provincia" id="provincia" value="<?php if(isset($usuario['provincia'])) echo $usuario['provincia'];?>"></td>
         <td align="right"><?php echo lang('text_pais');?></td>
         <td><select style="width:100%" type="text" name="idPaises" id="idPaises">
     	<?php foreach($paises as $pais):?>
     		<?php if(isset($usuario['idPaises']) and $pais['idPaises'] == $usuario['idPaises'] ):?>
     		<option value="<?php echo $pais['idPaises'];?>" selected="selected"><?php echo $pais['pais'];?></option>
     		<?php else:?>
     		<option value="<?php echo $pais['idPaises'];?>"><?php echo $pais['pais'];?></option>
     		<?php endif;?>
     	<?php endforeach;?>
     </select></td>
       </tr>
       <tr>
         <td><?php echo lang('text_codigo_area');?></td>
         <td><input style="width:100%" type="text" name="codigo_area" id="codigo_area"  placeholder="<?php echo lang('text_pais_area');?>" value="<?php if(isset($usuario['codigo_area'])) echo $usuario['codigo_area'];?>"></td>
         <td width="9%" align="right"><?php echo lang('text_telefono');?> <img src="<?php echo PUBLIC_FOLDER;?>images/iconos/star-icon-red.png"></td>
         <td><input style="width:100%" type="text" name="telefono" id="telefono" value="<?php if(isset($usuario['telefono'])) echo $usuario['telefono'];?>"></td>
         <td align="right"><?php echo lang('text_celular');?></td>
         <td><input style="width:100%" type="text" name="celular" id="celular" value="<?php if(isset($usuario['celular'])) echo $usuario['celular'];?>"></td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr style="border-top: 1px solid color:#000;">
         <td  colspan="4">&nbsp;</td>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr style="border-top: 1px solid color:#000;">
         <td  colspan="4" style="border-top: 1px solid #ededed;"><input type="checkbox" name="caracteristicas" id="politicas">
           <?php echo lang('text_reto_leer_politicas_terminos');?> <a href="#" data-reveal-id="caracteristicas_tyc"><img src="<?php echo PUBLIC_FOLDER;?>images/iconos/ayuda.png" /></a></td>
         <td colspan="4">&nbsp;</td>
       </tr>
       <tr style="border-top: 1px solid color:#000;">
       <!-- COMENTADO POR XIME <td  colspan="4" style="border-top: 1px solid #ededed;"><input type="checkbox" name="politicas" id="politicas">
           <?php echo lang('text_reto_leer_caracteristicas');?><a href="#" data-reveal-id="politicas_terminos"><img src="<?php echo PUBLIC_FOLDER;?>images/iconos/ayuda.png" /></a></td>
         <td colspan="4">&nbsp;</td>-->
       </tr>
       <?php if(isset($errores)):?>
       <tr style="border-top: 1px solid color:#000;color:red;" >
			<td colspan="8" style="border-top: 1px solid #ededed;color:red;" id="td-error"><?php echo $errores;?></td>
	    	<td width="28%">&nbsp;</td>
	   </tr>
	   <?php endif;?>
       <tr style="border-top: 1px solid color:#000;">
         <td  colspan="4" style="border-top: 1px solid #ededed;"><button type="submit" class="button" style="border:none;" id="submit"><?php echo lang('text_enviar');?></button><br></td>
         <td colspan="4"></td>
       </tr>
       <tr style="border-top: 1px solid color:#000;">
         <td  colspan="4" style="border-top: 1px solid #ededed;"><strong><?php echo lang('text_datos_publicos')?><br /><?php echo lang('text_datos_obligatorios')?></strong></td>
         <td colspan="4"></td>
       </tr>
       <tr>
         <td colspan="8"></td>
       </tr>
     </table>


     </td>
   </tr>
 </table>
 </form>


</div>
  </div>
 </div>
</div>

    <!-- End Main Content -->


<div id="caracteristicas_tyc" class="reveal-modal">
	<h2><?php echo lang('text_reto_leer_politicas_terminos');?></h2>
  <p><?php echo lang('text_reto_texto_politicas_terminos');?></p>
  <a class="close-reveal-modal">×</a>
</div>
<div id="politicas_terminos" class="reveal-modal">
	<h2><?php echo lang('text_reto_caracteristicas');?></h2>
  <p class="lead"><?php echo lang('text_reto_leer_caracteristicas');?></p>
  <p><?php echo lang('text_reto_texto_caracteristicas');?></p>
  <a class="close-reveal-modal">×</a>

</div>