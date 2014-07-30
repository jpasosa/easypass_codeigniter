<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categorias_model extends CI_Model
{



	public function __contruct()
	{
		parent::__construct();

	}



	/**
	 * Validación de la categoría
	 **/
	public function validateCategoria($categoria)
	{

		$errores = array();

		if($categoria['nombre'] == '') {
			$errores['nombre'] = 'Debe ingresar el nombre';
		}

		return $errores;
	}


	/**
	 * Inserto una categoría, a la vez también inserta como un tag
	 **/
	public function insert($categoria)
	{
		try {

			$this->db->insert('categorias', $categoria);
			if ($this->db->affected_rows()) {
				$id_insert = $this->db->insert_id();
				$this->db->insert('tags', array('nombre_tag'=>$categoria['nombre']));
				return $id_insert;
			} else {
				return 0;
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}


	public function getCategorias()
	{

		try {

			$sql 	= "SELECT * FROM categorias C ";
			$q 		= $this->db->query($sql);
			$categorias = $q->result_array();

			return $categorias;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}

	public function update($categoria, $id_categoria)
	{
		try {

			$this->db->where('id_categoria', $id_categoria);
			$this->db->update('categorias', $categoria);

			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}




	public function eraseCategoria( $id_categoria )
	{
		try {

			 $this->db->delete('categorias', array('id_categoria' => $id_categoria));
			 return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function getCategoria($id_categoria)
	{
		try {

			// Adicionales en ese automovil
			$sql = "SELECT * FROM categorias C WHERE C.id_categoria=$id_categoria";
			$q = $this->db->query($sql);
			$categoria = $q->row_array();

			return $categoria;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


}