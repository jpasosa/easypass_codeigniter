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
		else {
			if($this->_existNameTag($tag['nombre_tag']))
			{
				$errores['existe_nombre'] = 'El tag ingresado ya existe.';
			}
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


	/**
	 * Nos trae todos los id_tags pertenecientes a la clave, todos juntos en un array.
	 * ejemplo de salida. .  array(21,23,26)  -> donde 21 23 y 26 son los id_tags que pertenecen a esa clave
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	default
	 *
	 * @param       String
	 * @return      String
	 **/
	public function getIdTagsByClave( $id_clave )
	{
		try {

			$sql = "SELECT * FROM tags_claves TC
					INNER JOIN tags T
						ON TC.id_tag=T.id_tag
					WHERE id_clave=$id_clave
					";
			$tags 			= $this->db->query($sql);
			$tags_claves 	= $tags->result_array();

			$arr_tags 		= array();
			foreach ($tags_claves AS $tc)
			{
				$arr_tags[] = $tc['id_tag'];
			}

			return $arr_tags;


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

	private function _existNameTag( $nombre_tag )
	{
		try {

			$tag = $this->db->get_where('tags', array('nombre_tag'=>$nombre_tag));
			$tag = $tag->row_array();
			if ( isset($tag['id_tag']) ) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


}