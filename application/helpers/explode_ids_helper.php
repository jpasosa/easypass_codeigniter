<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Busca en los segmentos de $this->uri a partir de una expresión regular 
 * y devuelve el valor que sigue al utilizar explode()
 *  
 * @param string $segment_reg expresión regular para encontrar un determinado valor en los segmentos
 * @param array $segments Segmentos de la URL de la aplicación
 * @param number $default_value
 * @return Ambigous <>|Ambigous <number, multitype:>
 */
function get_explode_id($segment_reg, $segments, $default_value = 0)
{
    $match = array_values(preg_grep($segment_reg,$segments));
    
    $explode = (isset($match[0])) ? explode(':',$match[0]) : $default_value ;
    if(is_array($explode) and isset($explode[1])) {
        return $explode[1];
    } else {
        return $explode;
    }
        
}
