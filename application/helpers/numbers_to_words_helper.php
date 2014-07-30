<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function numberToWords($num){
	$numers = array(
	'1' => 'uno',
	'2' => 'dos',
	'3' => 'tres',
	'4' => 'cuatro',
	'5' => 'cinco',
	'6' => 'seis',
	'7' => 'siete',
	'8' => 'ocho',
	'9' => 'nueve',
	'10' => 'diez'
	);
	if(array_key_exists($num, $numers)){
		return $numers[$num];
	}
	else{
		return "";
	}
}
