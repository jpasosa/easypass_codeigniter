<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function paginas($cantidadRegistros,$rowsPerPage,$pagina, $baseUrl) {
	$paginas = array();    
	$cantidadDePaginas  = ceil($cantidadRegistros / $rowsPerPage);        
	for($i=1;$i<=$cantidadDePaginas ;$i++)
	{
		array_push($paginas,$i);
	}
	
	settype($pagina,"INT");
	$prev = 1;
    $next = 1;
   
	$inicio = 0;
	$final = $rowsPerPage;
	$resto =  ( $pagina / $rowsPerPage ) ;
	$numPagina = $pagina;
	if($resto >= 1)
	{
		$inicio = ( intval($resto) * $rowsPerPage ) -1;
		$final = $inicio + $rowsPerPage;
		if($final > $cantidadDePaginas)
		{
			$final = $cantidadDePaginas;
        }
	}
	if($numPagina == 0 and $cantidadDePaginas > 0)
	{
	    $numPagina = 1;
	}
	        
    if($cantidadDePaginas > 1)
    {
    	if($pagina > 1){
        	$prev = ($pagina -1);
        	
    	}    	
        $next = ($pagina +1);         
	}
	if($next > $cantidadDePaginas){
		$next = $cantidadDePaginas;
	}
	
    $html = '
	<div class="pagination clearfix">
		<div class="links">			
	';
    
    //if($pagina > 1) {
    	$html .= '<a href="'. $baseUrl . '/'. $prev .'">&lt;</a>';
    //}
    
    foreach ($paginas as $_pagina){
		if($_pagina == $pagina) {
			$html .= '
				<b>'. $pagina .'</b>';
		}
		else {
			$html .= '
				<a href="'. $baseUrl . '/'. $_pagina .'">'. $_pagina .'</a>
				';
		}    	
    }
    
    //if($pagina < $cantidadDePaginas){
		$html .= '<a href="'. $baseUrl . '/'. $next .'"> &gt; </a>';
    //}
	$html .='</div></div>'; 
     
	return $html;
}

function limit($pagina,$filasPorPagina) {        
	settype($pagina,"INT");
	$inicio = 0;
	if($pagina < 1){
		$pagina = 1;
	}            
	$final = $filasPorPagina;
	$inicio = ($pagina - 1) * $filasPorPagina;
	return "LIMIT $inicio,$final";        
}

?>