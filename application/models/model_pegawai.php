<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pegawai extends CI_Model {

	public function count()
	{
		$query = $this->db->get('pegawai');

		return $query->num_rows();
	}

	public function get()
	{
		$query = $this->db->get('pegawai');

		return $query->result();
	}

	public function find($id)
	{
		$query = $this->db->get_where('pegawai', array('id' => $id));

		return $query->row();
	}

	public function update($object, $id)
	{
		return $this->db->update('pegawai', $object, array('id' => $id));
	}

	public function hapus($id)
	{
		return $this->db->delete('pegawai', array('id' => $id));
	}
	
	public function tambah($object)
	{
		return $this->db->insert('pegawai', $object);
	}
}

/* End of file model_pegawai.php */
/* Location: ./application/models/model_pegawai.php */