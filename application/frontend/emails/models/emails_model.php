<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class emails_model extends CI_Model
{



	public function __contruct()
	{
		parent::__construct();

	}



	/**
	 * Validación de la categoría
	 **/
	public function validateEmail($email)
	{

		$errores = array();

		if($email['nombre_email'] == '') {
			$errores['nombre_email'] = 'Debe ingresar el nombre del email.';
		}
		else
		{
			if( $this->yaExiste($email['nombre_email']) )
			{
				$errores['existe_email'] = 'El mail ingresado ya existe en la base de datos.';
			}
		}



		return $errores;
	}

	public function yaExiste($nombre_email)
	{
		try {

			$q_email 	= $this->db->get_where('emails', array('nombre_email'=>$nombre_email));
			$emails 	= $q_email->result_array();
			if (isset($emails[0])) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	/**
	 * Inserto una categoría
	 **/
	public function insert($email)
	{
		try {
			$this->db->insert('emails', $email);
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


	public function getEmails()
	{

		try {

			$sql 	= "SELECT * FROM emails T ";
			$q 		= $this->db->query($sql);
			$emails = $q->result_array();

			return $emails;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}

	public function update($email, $id_email)
	{
		try {

			$this->db->where('id_email', $id_email);
			$this->db->update('emails', $email);

			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}




	public function eraseEmail( $id_email )
	{
		try {
			// TODO::JUAMPA  debe comprobar que no existe el mail en algún acceso.
			if ( !$this->_existeEnAlgunIngreso($id_email))
			{
				$this->db->delete('emails', array('id_email' => $id_email));
				return true;
			} else { // Ya existía en algún acceso.
				return false;
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	/**
	 * Comprueba que este id_email no exista en algún registro de la tabla claves.
	 * @author 	Juan Pablo Sosa <jpasosa@gmail.com>
	 * @date 	27 de Mayo 2014
	 **/
	private function _existeEnAlgunIngreso($id_email)
	{
		try {
			$sql 	= "SELECT * FROM claves C WHERE C.id_email=$id_email OR C.id_email_alt=$id_email";
			$q 		= $this->db->query($sql);
			$emails = $q->result_array();

			if (isset($emails[0])) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}

	public function getemail($id_email)
	{
		try {

			$sql = "SELECT * FROM emails T WHERE T.id_email=$id_email";
			$q = $this->db->query($sql);
			$email = $q->row_array();

			return $email;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


}