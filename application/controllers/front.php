<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('SESS_LOGGED_IN') === TRUE)
			header('location:'.base_url().'dashboard');

		$this->load->model('model_auth');
		$this->load->model('model_user');
	}
	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('front/login');
		} else {
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');

			if ($this->model_auth->auth($username, $password)) {
				$detail_user = $this->model_user->get_detail_by_username($username);

				$array = array(
					'SESS_ID_USER' 		=> $detail_user->id,
					'SESS_NAMA_USER' 	=> $detail_user->nama,
					'SESS_LOGGED_IN'	=> TRUE
				);
				
				$this->session->set_userdata( $array );

				echo 'true';
			} else {
				$this->session->set_flashdata('message', 'true');

				echo 'false';
			}
			
		}
		
	}

}

/* End of file front.php */
/* Location: ./application/controllers/front.php */