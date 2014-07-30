<?php
function dateToWords($date)
{
	$adias=array('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
	$ameses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre');

	$nombredia=date("w",strtotime($date));
	$dia=$adias[$nombredia]; // nombre del dia de la semana

	$numdiadia=date("d",strtotime($date));   //numero del dia del mes

	$numeromes=date("m",strtotime($date))-1;
	$mes=$ameses[$numeromes];//nombre del mes actual

	$anio=date("Y",strtotime($date));

	$numdiadia = number_format($numdiadia,0);


	if($numdiadia == 1){
		$textDia = "un d&iacute;a";
	}
	else{
		$textDia = "los $numdiadia d&iacute;as";
	}



	return "$numdiadia de ".$mes." de ".$anio;
}

?>