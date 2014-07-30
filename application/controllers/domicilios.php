<?php

class Domicilios extends MX_Controller {
	
	public function __construct(){
		parent::__construct();		
	}
	
	public function getCiudades(){
		if($this->uri->segment(3)){
			$idProvincia = (int)$this->uri->segment(3);
		}
		else{
			$idProvincia = (int)$this->input->get('idProvincia');	
		}
		
		if($idProvincia >= 0){
			$ciudades = array();
			$this->load->model('domicilios/domicilios_model');
			$data['ciudades']= $this->domicilios_model->getCiudades($idProvincia);
			if($this->uri->segment(4) == 'html'){
				$this->load->view('domicilios/ciudades_select_option',$data);
			}
			else{
				echo json_encode($data['ciudades']);
			}
		}			
	}
}