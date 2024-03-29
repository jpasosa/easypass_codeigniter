<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('sanear_string'))
{
	function sanear_string($string)
	{

		$string = trim($string);

		$string = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$string
		);

		$string = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$string
		);

		$string = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$string
		);

		$string = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$string
		);

		$string = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$string
		);

		$string = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C',),
				$string
		);

		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
				array("\\", "¨", "º", "-", "~",
						 "#", "@", "|", "!", "\"",
						 "·", "$", "%", "&", "/",
						 "(", ")", "?", "'", "¡",
						 "¿", "[", "^", "`", "]",
						 "+", "}", "{", "¨", "´",
						 ">", "< ", ";", ",", ":",
						 "."),
				'',
				$string
		);


		return $string;
	}
}


if ( ! function_exists('cortar_palabra'))
{
	function cortar_palabra($input, $length, $ellipses = true, $strip_html = false)
	{
		//strip tags, if desired
		if ($strip_html) {
		$input = strip_tags($input);
		}

		//no need to trim, already shorter than trim length
		if (strlen($input) <= $length) {
		return $input;
		}

		//find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		$trimmed_text = substr($input, 0, $last_space);

		//add ellipses (...)
		if ($ellipses) {
		$trimmed_text .= ' . . . . . .';
		}

		return $trimmed_text;
	}
}

