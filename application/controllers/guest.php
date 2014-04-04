<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('SESS_LOGGED_IN') != TRUE)
			header('location:'.base_url());

		if ($this->session->userdata('SESS_IS_ADMIN') == TRUE)
			header('location:'.base_url().'dashboard');
	}

	public function index()
	{
		$this->load->model('model_data');
		$this->load->model('model_pegawai');

		$data['count'] 		= $this->model_data->count();
		$data['list_data']	= $this->model_data->get_detail();

		$this->load->view('global/header_guest');
		$this->load->view('data/front_guest', $data);
		$this->load->view('global/footer');
	}

	public function detail($object = NULL)
	{
		$this->load->model('model_pegawai');
		$this->load->model('model_data');

		$data['list_pegawai']	= $this->model_pegawai->get();
		$data['act_cetak']		= base_url() . 'guest/cetak/' . $object;

		$pesta 					= $this->model_data->find($object);

		$data['tanggal_daftar']			= $pesta->tanggal_daftar;
		$data['nama_pemohon']			= $pesta->nama_pemohon;
		$data['jenis_pemohon']			= $pesta->jenis_pemohon;
		$data['id_pelanggan_pemohon']	= $pesta->id_pelanggan_pemohon;
		$data['daya_pemohon']			= $pesta->daya_pemohon;
		$data['no_registrasi_pemohon']	= $pesta->no_registrasi_pemohon;
		$data['alamat_pemohon']			= $pesta->alamat_pemohon;
		$data['daya_pesta']				= $pesta->daya_pesta;
		$data['lama_pesta']				= $pesta->lama_pesta;
		$data['status']					= $pesta->status;

		$pasang 		 				= explode(' ', $pesta->tanggal_pasang);
		$data['tanggal_pasang']			= $pasang[0];
		$data['jam_pasang']				= $pasang[1];

		$data['id_petugas_pasang']		= $pesta->id_petugas_pasang;
		$data['jadwal_bongkar']			= $pesta->jadwal_bongkar;

		$bongkar 						= explode(' ', $pesta->tanggal_bongkar);
		$data['tanggal_bongkar']		= $bongkar[0];
		$data['jam_bongkar']			= $bongkar[1];

		$data['id_petugas_bongkar']		= $pesta->id_petugas_bongkar;
		
		$this->load->view('global/header_guest');
		$this->load->view('data/form_guest', $data);
		$this->load->view('global/footer');
	}

	public function cetak($object = NULL)
	{
		$this->load->model('model_pegawai');
		$this->load->model('model_data');

		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$data['data']	= $this->model_data->laporan_satuan($object);
		$data['title']	= 'Laporan Pemasangan Sementara ' . $data['data']->nama_pemohon . ' - ' . $data['data']->tanggal_daftar;
		 
		ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
	    $html = $this->load->view('cetak/satuan', $data, true); // render the view into HTML
	     
	    $this->load->library('pdf');
	    $pdf = $this->pdf->load(); 
	    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
	    $pdf->WriteHTML($html); // write the HTML into the PDF
	    $pdf->Output($data['title'] . '.pdf', 'D'); // save to file because we can
	}

	public function logout()
	{
		$this->session->sess_destroy();

		header('location:'.base_url());
	}
}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */