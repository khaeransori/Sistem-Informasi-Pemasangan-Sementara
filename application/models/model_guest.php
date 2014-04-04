<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_guest extends CI_Model {

	public function count()
	{
		$query = $this->db->get('guest');

		return $query->num_rows();
	}

	public function get()
	{
		$query = $this->db->get('guest');

		return $query->result();
	}

	public function find($id)
	{
		$query = $this->db->get_where('guest', array('id' => $id));

		return $query->row();
	}

	public function update($object, $id)
	{
		return $this->db->update('guest', $object, array('id' => $id));
	}

	public function hapus($id)
	{
		return $this->db->delete('guest', array('id' => $id));
	}
	
	public function tambah($object)
	{
		return $this->db->insert('guest', $object);
	}

	public function username_check($username)
	{
		$query = $this->db->get_where('guest', array('user' => $username));

		return $query->num_rows();
	}

	public function username_check_self($username, $id)
	{
		$query = $this->db->get_where('guest', array('user' => $username, 'id !=' => $id));

		return $query->num_rows();
	}

	public function get_detail_by_username($username = NULL)
	{
		$query = $this->db->get_where('guest', array('user' => $username));

		return $query->row();
	}
}

/* End of file model_guest.php */
/* Location: ./application/models/model_guest.php */