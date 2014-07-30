<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Instancia un objeto de la clase pasada como parametro.<br>
 * La clase tiene que estar cargada previamente
 * @param string $className
 * @return Un objeto del tipo pasado como parametro o null en caso de que no exista la clase
 * @author AllyTech Cloud Hosting
 */
function getInstance($class_name)
{
	if(class_exists($class_name)) {

		return new $class_name;

	} else {
		return null;
	}

}

