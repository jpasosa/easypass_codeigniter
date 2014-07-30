<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//Directorio del template. default_template lo contiene config/view_template
$template_folder = "template/" . $this->config->item('default_template');
$template_folder_layout = "template/" . $this->config->item('default_template_layout_frontend');


echo '$template_folder: ' , $template_folder . '<br />';
echo '$template_folder_layout: ' , $template_folder_layout . '<br />';
// die();
//Header
$header = array();
if(isset($title)) {
	$header['title'] = $title;

} else {
	$header['title'] = $this->config->item('default_title');
}

if(isset($script_header)) {

	if(is_array($script_header)){
		$_scripts = "";
		foreach($script_header as $_script) {
			$_scripts .= '<script type="text/javascript" src="'.PUBLIC_FOLDER. $_script .'"></script>';
		}
		$header['scripts'] = $_scripts;

	} elseif(is_string($script_header)) {
		$header['scripts'] = $script_header;

	} else {
		$header['scripts'] = "";
	}

}

if(isset($script_css)) {

	if(is_array($script_css)){
		$_scripts = "";
		foreach($script_css as $_script) {
			$_scripts .= '<link href="'. PUBLIC_FOLDER . $_script . '" rel="stylesheet">';
		}
		$header['scripts_css'] = $_scripts;

	} elseif(is_string($script_css)) {
		$header['scripts_css'] = $script_css;

	} else {
		$header['scripts_css'] = "";
	}

}

//Obtengo la URL actual
$this_url = base_url($this->uri->uri_string);//.
if(!empty($this->uri->uri_string)) {
	$header['this_url'] = $this_url . $this->config->item('url_suffix');
}
$this->load->view($template_folder_layout .'head',$header);

//Fin Header


//Menu
$this->load->view($template_folder_layout . 'menu');
//Fin Menu

//Content
$data = isset($data) ? $data : null;
$this->load->view( $this->router->fetch_module(). "/". $template_folder . $view_file ,$data);
//Fin Content


//Footer
$footer = array();
if(isset($script_footer)) {
	if(is_array($script_footer)){
		$_scripts = "";
		foreach($script_footer as $_script) {
			$_scripts .= '<script type="text/javascript" src="'.PUBLIC_FOLDER. $_script .'"></script>';
		}
		$footer['scripts'] = $_scripts;

	} elseif(is_string($script_footer)) {
		$footer['scripts'] = $script_footer;

	} else {
		$footer['scripts'] = "";
	}
}
$this->load->view($template_folder_layout . 'footer',$footer);

//Fin Footer

