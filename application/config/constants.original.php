<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/* Definiciones locales */


/* DIRECTORIOS Y RUTAS */
if (preg_match("/([10.0.0.*]|127.0.0.1)/", $_SERVER['SERVER_ADDR']) ) {
	define('PUBLIC_FOLDER', '/TEST/');
} else {
	define('PUBLIC_FOLDER', '/demos/TEST/');
}

define('MODULOS_FRONTEND', 'frontend');
define('MODULOS_BACKEND', 'backend');

//Directorio de recursos
define('ASSETS',PUBLIC_FOLDER . 'assets/');

//Directorio de imágenes, ruta relativa url
define('IMAGENES',ASSETS . 'imagenes/');

//Directorio de imágenes, ruta absoluta filesystem
define('IMAGENES_PATH',FCPATH . ASSETS ."imagenes/");


/* FIN DIRECTORIOS Y RUTAS */


//Rol string del administrador
define('ROL_KEY','administrador');



/* End of file constants.php */
/* Location: ./application/config/constants.php */
