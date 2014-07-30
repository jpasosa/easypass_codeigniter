<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Inicializa las propiedades de una instancia
 * @param array $vars
 * @param string $class
 */
function inicializar_objeto($vars, $class = __CLASS__)
{

	if(isset($vars)){
		foreach ($vars as $key => $value){
			if(array_key_exists($key, get_class_vars($class))){
				if(method_exists($this, "set_" . $key)){
					$this->{"set_". $key}($value);
				}
			}
		}
	}
}