<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




if ( ! function_exists('objectToArray'))
{
	function objectToArray($d)
	{


		if (is_object($d))
		{
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}


		if (is_array($d))
		{
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);

			}else {
			// Return array
			return $d;
		}

	}
}


/**
 * Desetea en el array pasado por parámetro, los que tengan el mismo número en el campo dado.
 * El campo pasado debe ser int(), si no de otra manera no funciona.
 **/
if ( ! function_exists('unsetRepeats'))
{
	function unsetRepeats( $array, $campo)
	{
		$cant_array = count($array);

		for ( $i=0; $i<$cant_array; $i++)
		{
			foreach( $array AS $k=>$arr)
			{
				if(isset($array[$i][$campo]) && $arr[$campo] == $array[$i][$campo] && $k != $i)
				{
					unset($array[$k]);
				}
			}
		}

		return $array;
	}
}



































