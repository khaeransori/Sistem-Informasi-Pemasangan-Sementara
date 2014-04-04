<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_auth extends CI_Model {	

	public function auth($username = NULL, $password = NULL, $jenis = NULL)
	{
		if (1 == $jenis) {
			$query = $this->db->get_where('user', array('user' => $username, 'pass' => $password ));
		} else {
			$query = $this->db->get_where('guest', array('user' => $username, 'pass' => $password ));
		}
		
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
		
	}
}

/* End of file model_auth.php */
/* Location: ./application/models/model_auth.php */