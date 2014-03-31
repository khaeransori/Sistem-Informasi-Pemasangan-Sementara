<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model {

	public function count()
	{
		$query = $this->db->get('user');

		return $query->num_rows();
	}

	public function get()
	{
		$query = $this->db->get('user');

		return $query->result();
	}

	public function find($id)
	{
		$query = $this->db->get_where('user', array('id' => $id));

		return $query->row();
	}

	public function update($object, $id)
	{
		return $this->db->update('user', $object, array('id' => $id));
	}

	public function hapus($id)
	{
		return $this->db->delete('user', array('id' => $id));
	}
	
	public function tambah($object)
	{
		return $this->db->insert('user', $object);
	}

	public function username_check($username)
	{
		$query = $this->db->get_where('user', array('user' => $username));

		return $query->num_rows();
	}

	public function username_check_self($username, $id)
	{
		$query = $this->db->get_where('user', array('user' => $username, 'id !=' => $id));

		return $query->num_rows();
	}
}

/* End of file model_admin.php */
/* Location: ./application/models/model_admin.php */