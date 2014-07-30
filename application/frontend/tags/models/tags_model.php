<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tags_model extends CI_Model
{



	public function __contruct()
	{
		parent::__construct();

	}



	/**
	 * Validación de la categoría
	 **/
	public function validateTag($tag)
	{

		$errores = array();

		if($tag['nombre_tag'] == '')
		{
			$errores['nombre_tag'] = 'Debe ingresar el nombre';
		}

		return $errores;
	}


	/**
	 * Inserto una categoría
	 **/
	public function insert($tag)
	{
		try {

			$this->db->insert('tags', $tag);
			if ($this->db->affected_rows()) {
				$id_insert = $this->db->insert_id();
				return $id_insert;
			} else {
				return 0;
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}


	public function getTags()
	{

		try {

			$sql 	= "SELECT * FROM tags T ";
			$q 		= $this->db->query($sql);
			$tags = $q->result_array();

			return $tags;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}

	public function update($tag, $id_tag)
	{
		try {

			$this->db->where('id_tag', $id_tag);
			$this->db->update('tags', $tag);

			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}




	public function eraseTag( $id_tag )
	{
		try {

			 $this->db->delete('tags', array('id_tag' => $id_tag));
			 return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function getTag($id_tag)
	{
		try {

			$sql = "SELECT * FROM tags T WHERE T.id_tag=$id_tag";
			$q = $this->db->query($sql);
			$tag = $q->row_array();

			return $tag;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


}