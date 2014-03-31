<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function get_detail_by_username($username = NULL)
	{
		$query = $this->db->get_where('user', array('user' => $username));

		return $query->row();
	}

}

/* End of file model_user.php */
/* Location: ./application/models/model_user.php */