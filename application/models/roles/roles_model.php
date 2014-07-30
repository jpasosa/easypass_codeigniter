<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all()
	{
		$sql = "SELECT * FROM roles r ORDER BY r.descripcion ASC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}