<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('SESS_LOGGED_IN') != TRUE)
			header('location:'.base_url());

		if ($this->session->userdata('SESS_IS_ADMIN') != TRUE)
			header('location:'.base_url().'guest');
	}

	public function index()
	{
		$this->load->model('model_data');
		$this->load->model('model_pegawai');

		$data['count'] 		= $this->model_data->count();
		$data['list_data']	= $this->model_data->get_detail();

		$this->load->view('global/header');
		$this->load->view('dashboard/front');
		$this->load->view('data/front', $data);
		$this->load->view('global/footer');
	}

	public function data($act = NULL, $object = NULL)
	{
		$this->load->model('model_data');
		$this->load->model('model_pegawai');

		switch ($act) {
			case 'tambah':
  				$this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|xss_clean');
				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('no_registrasi', 'No. Registrasi', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');
				$this->form_validation->set_rules('daya_pesta', 'Daya Pemasangan Sementara', 'required');
				$this->form_validation->set_rules('lama_pesta', 'Lama Penyambungan Sementara', 'required');
				$this->form_validation->set_rules('tanggal_pasang', 'Tanggal Pasang', 'required');
				$this->form_validation->set_rules('jam_pasang', 'Jam Pasang', 'required');
				$this->form_validation->set_rules('petugas_pasang', 'Petugas Pasang', 'required');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 			= 'tambah';
					$data['action']			= base_url() . 'dashboard/data/tambah';
					$data['list_pegawai']	= $this->model_pegawai->get();

					$this->load->view('global/header');
					$this->load->view('data/form', $data);
					$this->load->view('global/footer');
				} else {

					$status 		= ($this->input->post('status') == 'on') ? 1 : 0;
					$id_pelanggan 	= ($this->input->post('jenis') == 1) ? $this->input->post('id_pelanggan') : '';
					$daya_pelanggan = ($this->input->post('jenis') == 1) ? $this->input->post('daya') : '';
					$data = array(
						'tanggal_daftar'		=> $this->input->post('tanggal_daftar'),
						'nama_pemohon'			=> $this->input->post('nama'),
						'jenis_pemohon'			=> $this->input->post('jenis'),
						'id_pelanggan_pemohon'	=> $id_pelanggan,
						'daya_pemohon'			=> $daya_pelanggan,
						'no_registrasi_pemohon'	=> $this->input->post('no_registrasi'),
						'alamat_pemohon'		=> $this->input->post('alamat'),
						'daya_pesta' 			=> $this->input->post('daya_pesta'),
						'lama_pesta' 			=> $this->input->post('lama_pesta'),
						'status'				=> $status,
						'tanggal_pasang' 		=> $this->input->post('tanggal_pasang') . ' ' . $this->input->post('jam_pasang'),
						'id_petugas_pasang' 	=> $this->input->post('petugas_pasang'),
						'tanggal_bongkar' 		=> $this->input->post('tanggal_bongkar') . ' ' . $this->input->post('jam_bongkar'),
						'id_petugas_bongkar' 	=> $this->input->post('petugas_bongkar')
						);

					if ($this->model_data->tambah($data)) {
						$this->session->set_flashdata('class', 'alert-success');
						$this->session->set_flashdata('message', 'Data data berhasil ditambahkan.');
						$this->session->set_flashdata('short', 'Well done!');
					} else {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Data data gagal ditambahkan.');
						$this->session->set_flashdata('short', 'Oh snap!');
					}

					header('location:' . base_url() . 'dashboard/data');
					
				}
				break;
			
			case 'edit':

				$this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|xss_clean');
				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('no_registrasi', 'No. Registrasi', 'required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'required');
				$this->form_validation->set_rules('daya_pesta', 'Daya Pemasangan Sementara', 'required');
				$this->form_validation->set_rules('lama_pesta', 'Lama Penyambungan Sementara', 'required');
				$this->form_validation->set_rules('tanggal_pasang', 'Tanggal Pasang', 'required');
				$this->form_validation->set_rules('jam_pasang', 'Jam Pasang', 'required');
				$this->form_validation->set_rules('petugas_pasang', 'Petugas Pasang', 'required');
				$this->form_validation->set_rules('tanggal_bongkar', 'Tanggal Bongkar', 'required');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 			= 'edit';
					$data['action']			= base_url() . 'dashboard/data/edit/' . $object;
					$data['list_pegawai']	= $this->model_pegawai->get();
					$data['act_cetak']		= base_url() . 'dashboard/data/cetak/' . $object;

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
					
					$this->load->view('global/header');
					$this->load->view('data/form', $data);
					$this->load->view('global/footer');
				} else {

					$status 		= ($this->input->post('status') == 'on') ? 1 : 0;
					$id_pelanggan 	= ($this->input->post('jenis') == 1) ? $this->input->post('id_pelanggan') : '';
					$daya_pelanggan = ($this->input->post('jenis') == 1) ? $this->input->post('daya') : '';
					$data = array(
						'tanggal_daftar'		=> $this->input->post('tanggal_daftar'),
						'nama_pemohon'			=> $this->input->post('nama'),
						'jenis_pemohon'			=> $this->input->post('jenis'),
						'id_pelanggan_pemohon'	=> $id_pelanggan,
						'daya_pemohon'			=> $daya_pelanggan,
						'no_registrasi_pemohon'	=> $this->input->post('no_registrasi'),
						'alamat_pemohon'		=> $this->input->post('alamat'),
						'daya_pesta' 			=> $this->input->post('daya_pesta'),
						'lama_pesta' 			=> $this->input->post('lama_pesta'),
						'status'				=> $status,
						'tanggal_pasang' 		=> $this->input->post('tanggal_pasang') . ' ' . $this->input->post('jam_pasang'),
						'id_petugas_pasang' 	=> $this->input->post('petugas_pasang'),
						'tanggal_bongkar' 		=> $this->input->post('tanggal_bongkar') . ' ' . $this->input->post('jam_bongkar'),
						'id_petugas_bongkar' 	=> $this->input->post('petugas_bongkar')
						);

					if ($this->model_data->update($data, $object)) {
						$this->session->set_flashdata('class', 'alert-success');
						$this->session->set_flashdata('message', 'Data data berhasil diperbaharui.');
						$this->session->set_flashdata('short', 'Well done!');
					} else {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Data data gagal diperbaharui.');
						$this->session->set_flashdata('short', 'Oh snap!');
					}

					header('location:' . base_url() . 'dashboard/data');
					
				}
				break;

			case 'hapus':

				if ($this->model_data->hapus($object)) {
					$this->session->set_flashdata('class', 'alert-success');
					$this->session->set_flashdata('message', 'Data data berhasil dihapus.');
					$this->session->set_flashdata('short', 'Well done!');
				} else {
					$this->session->set_flashdata('class', 'alert-success');
					$this->session->set_flashdata('message', 'Data data gagal dihapus.');
					$this->session->set_flashdata('short', 'Oh snap!');
				}

				header('location:' . base_url() . 'dashboard/data');
				break;

			case 'cetak':
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
				 
				
				break;

			case 'check':
				$this->load->model('model_data');
				$ret['count'] 	= $this->model_data->count_warning();
				$ret['data'] 	= $this->model_data->data_warning();

				echo json_encode($ret);
				break;

			default:
				$data['count'] 		= $this->model_data->count();
				$data['list_data']	= $this->model_data->get_detail();

				$this->load->view('global/header');
				$this->load->view('data/front', $data);
				$this->load->view('global/footer');
				break;
		}
	}

	public function laporan($act = NULL)
	{
		$this->load->model('model_data');

		switch ($act) {
			case 'bulanan':
					$this->form_validation->set_rules('bulan', 'Bulan', 'required');
					$this->form_validation->set_rules('tahun', 'Tahun', 'required');

					if ($this->form_validation->run() === FALSE) {
						$data['max'] 	= $this->model_data->get_max_year();
						$data['min'] 	= $this->model_data->get_min_year();
						$data['action']	= base_url() . 'dashboard/laporan/bulanan';

						$this->load->view('global/header');
						$this->load->view('laporan/bulanan', $data);
						$this->load->view('global/footer');
					} else {
						$bulan = $this->input->post('bulan');
						$tahun = $this->input->post('tahun');

						$list_data 	= $this->model_data->laporan_bulanan($bulan, $tahun);

						//load our new PHPExcel library
						$this->load->library('excel');
						//activate worksheet number 1
						$this->excel->setActiveSheetIndex(0);
						//name the worksheet
						$this->excel->getActiveSheet()->setTitle('SIPS');
						//set cell A1 content with some text
						//$this->excel->getActiveSheet()->setCellValue('A1', 'Tanggal Daftar');
						//merge cell A1 until D1
						$this->excel->getActiveSheet()->mergeCells('A1:U1');
						$this->excel->getActiveSheet()->mergeCells('A2:A3');
						$this->excel->getActiveSheet()->mergeCells('B2:G2');
						$this->excel->getActiveSheet()->mergeCells('H2:I2');
						$this->excel->getActiveSheet()->mergeCells('J2:M2');
						$this->excel->getActiveSheet()->mergeCells('N2:P2');
						$this->excel->getActiveSheet()->mergeCells('Q2:T2');
						$this->excel->getActiveSheet()->mergeCells('U2:U3');

						$this->excel->getActiveSheet()->setCellValue('A1', 'Data Pemasangan Sementara');
						$this->excel->getActiveSheet()->setCellValue('A2', 'Tanggal Daftar');
						$this->excel->getActiveSheet()->setCellValue('B2', 'Pemohon');
						$this->excel->getActiveSheet()->setCellValue('H2', 'Pemasangan Sementara');
						$this->excel->getActiveSheet()->setCellValue('J2', 'Pemasangan');
						$this->excel->getActiveSheet()->setCellValue('N2', 'Jadwal Bongkar');
						$this->excel->getActiveSheet()->setCellValue('Q2', 'Pembongkaran');
						$this->excel->getActiveSheet()->setCellValue('U2', 'Delta Jam');

						$this->excel->getActiveSheet()->setCellValue('B3', 'Nama');
						$this->excel->getActiveSheet()->setCellValue('C3', 'Jenis Pelanggan');
						$this->excel->getActiveSheet()->setCellValue('D3', 'ID Pelanggan');
						$this->excel->getActiveSheet()->setCellValue('E3', 'Daya');
						$this->excel->getActiveSheet()->setCellValue('F3', 'No. Registrasi');
						$this->excel->getActiveSheet()->setCellValue('G3', 'Alamat');
						$this->excel->getActiveSheet()->setCellValue('H3', 'Daya Penyambungan Sementara');
						$this->excel->getActiveSheet()->setCellValue('I3', 'Lama Penyambungan Sementara');
						$this->excel->getActiveSheet()->setCellValue('J3', 'Tanggal Pasang');
						$this->excel->getActiveSheet()->setCellValue('K3', 'Jam Pasang');
						$this->excel->getActiveSheet()->setCellValue('L3', 'Petugas');
						$this->excel->getActiveSheet()->setCellValue('M3', 'No. Handphone');
						$this->excel->getActiveSheet()->setCellValue('N3', 'Tanggal Bongkar');
						$this->excel->getActiveSheet()->setCellValue('O3', 'Jam Bongkar');
						$this->excel->getActiveSheet()->setCellValue('P3', 'Status');
						$this->excel->getActiveSheet()->setCellValue('Q3', 'Tanggal Bongkar');
						$this->excel->getActiveSheet()->setCellValue('R3', 'Jam Bongkar');
						$this->excel->getActiveSheet()->setCellValue('S3', 'Petugas');
						$this->excel->getActiveSheet()->setCellValue('T3', 'No. Handphone');

						$row = 4;
						foreach($list_data as $data) {
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data->tanggal_daftar);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data->nama_pemohon);
							$jenis = ($data->jenis_pemohon == 1) ? 'Pelanggan' : 'Non-Pelanggan';
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $jenis);
							$this->excel->getActiveSheet()->setCellValueExplicit('D'.$row, $data->id_pelanggan_pemohon, PHPExcel_Cell_DataType::TYPE_STRING);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data->daya_pemohon);
							$this->excel->getActiveSheet()->setCellValueExplicit('F'.$row, $data->no_registrasi_pemohon, PHPExcel_Cell_DataType::TYPE_STRING);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data->alamat_pemohon);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data->daya_pesta);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $data->lama_pesta . ' Jam');
							$tanggal_pasang = explode(' ', $data->tanggal_pasang);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $tanggal_pasang[0]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $tanggal_pasang[1]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $data->nama_pegawai_pasang);
							$this->excel->getActiveSheet()->setCellValueExplicit('M'.$row, $data->no_hp_pegawai_pasang, PHPExcel_Cell_DataType::TYPE_STRING);
							$jadwal_bongkar = explode(' ', $data->jadwal_bongkar);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $jadwal_bongkar[0]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $jadwal_bongkar[1]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, (1 == $data->status) ? 'ON' : 'OFF');
							$tanggal_bongkar = explode(' ', $data->tanggal_bongkar);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $tanggal_bongkar[0]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $tanggal_bongkar[1]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $data->nama_pegawai_bongkar);
							$this->excel->getActiveSheet()->setCellValueExplicit('T'.$row, $data->no_hp_pegawai_bongkar, PHPExcel_Cell_DataType::TYPE_STRING);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $data->delta_jam);
							$row++;
						}
						 
						$filename='Laporan Pemasangan Sementara ' . $bulan . ' - ' . $tahun . '.xls'; //save our workbook as this file name
						header('Content-Type: application/vnd.ms-excel'); //mime type
						header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
						header('Cache-Control: max-age=0'); //no cache
						             
						//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
						//if you want to save it as .XLSX Excel 2007 format
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
						//force user to download the Excel file without writing it to server's HD
						$objWriter->save('php://output');
					}
				break;

			case 'tahunan':
					$this->form_validation->set_rules('tahun', 'Tahun', 'required');

					if ($this->form_validation->run() === FALSE) {
						$data['max'] 	= $this->model_data->get_max_year();
						$data['min'] 	= $this->model_data->get_min_year();
						$data['action']	= base_url() . 'dashboard/laporan/tahunan';

						$this->load->view('global/header');
						$this->load->view('laporan/tahunan', $data);
						$this->load->view('global/footer');
					} else {
						$tahun = $this->input->post('tahun');

						$list_data 	= $this->model_data->laporan_tahunan($tahun);

						//load our new PHPExcel library
						$this->load->library('excel');
						//activate worksheet number 1
						$this->excel->setActiveSheetIndex(0);
						//name the worksheet
						$this->excel->getActiveSheet()->setTitle('SIPS');
						//set cell A1 content with some text
						//$this->excel->getActiveSheet()->setCellValue('A1', 'Tanggal Daftar');
						//merge cell A1 until D1
						$this->excel->getActiveSheet()->mergeCells('A1:U1');
						$this->excel->getActiveSheet()->mergeCells('A2:A3');
						$this->excel->getActiveSheet()->mergeCells('B2:G2');
						$this->excel->getActiveSheet()->mergeCells('H2:I2');
						$this->excel->getActiveSheet()->mergeCells('J2:M2');
						$this->excel->getActiveSheet()->mergeCells('N2:P2');
						$this->excel->getActiveSheet()->mergeCells('Q2:T2');
						$this->excel->getActiveSheet()->mergeCells('U2:U3');

						$this->excel->getActiveSheet()->setCellValue('A1', 'Data Pemasangan Sementara');
						$this->excel->getActiveSheet()->setCellValue('A2', 'Tanggal Daftar');
						$this->excel->getActiveSheet()->setCellValue('B2', 'Pemohon');
						$this->excel->getActiveSheet()->setCellValue('H2', 'Pemasangan Sementara');
						$this->excel->getActiveSheet()->setCellValue('J2', 'Pemasangan');
						$this->excel->getActiveSheet()->setCellValue('N2', 'Jadwal Bongkar');
						$this->excel->getActiveSheet()->setCellValue('Q2', 'Pembongkaran');
						$this->excel->getActiveSheet()->setCellValue('U2', 'Delta Jam');

						$this->excel->getActiveSheet()->setCellValue('B3', 'Nama');
						$this->excel->getActiveSheet()->setCellValue('C3', 'Jenis Pelanggan');
						$this->excel->getActiveSheet()->setCellValue('D3', 'ID Pelanggan');
						$this->excel->getActiveSheet()->setCellValue('E3', 'Daya');
						$this->excel->getActiveSheet()->setCellValue('F3', 'No. Registrasi');
						$this->excel->getActiveSheet()->setCellValue('G3', 'Alamat');
						$this->excel->getActiveSheet()->setCellValue('H3', 'Daya Penyambungan Sementara');
						$this->excel->getActiveSheet()->setCellValue('I3', 'Lama Penyambungan Sementara');
						$this->excel->getActiveSheet()->setCellValue('J3', 'Tanggal Pasang');
						$this->excel->getActiveSheet()->setCellValue('K3', 'Jam Pasang');
						$this->excel->getActiveSheet()->setCellValue('L3', 'Petugas');
						$this->excel->getActiveSheet()->setCellValue('M3', 'No. Handphone');
						$this->excel->getActiveSheet()->setCellValue('N3', 'Tanggal Bongkar');
						$this->excel->getActiveSheet()->setCellValue('O3', 'Jam Bongkar');
						$this->excel->getActiveSheet()->setCellValue('P3', 'Status');
						$this->excel->getActiveSheet()->setCellValue('Q3', 'Tanggal Bongkar');
						$this->excel->getActiveSheet()->setCellValue('R3', 'Jam Bongkar');
						$this->excel->getActiveSheet()->setCellValue('S3', 'Petugas');
						$this->excel->getActiveSheet()->setCellValue('T3', 'No. Handphone');

						$row = 4;
						foreach($list_data as $data) {
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data->tanggal_daftar);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data->nama_pemohon);
							$jenis = ($data->jenis_pemohon == 1) ? 'Pelanggan' : 'Non-Pelanggan';
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $jenis);
							$this->excel->getActiveSheet()->setCellValueExplicit('D'.$row, $data->id_pelanggan_pemohon, PHPExcel_Cell_DataType::TYPE_STRING);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data->daya_pemohon);
							$this->excel->getActiveSheet()->setCellValueExplicit('F'.$row, $data->no_registrasi_pemohon, PHPExcel_Cell_DataType::TYPE_STRING);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data->alamat_pemohon);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data->daya_pesta);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $data->lama_pesta . ' Jam');
							$tanggal_pasang = explode(' ', $data->tanggal_pasang);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $tanggal_pasang[0]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $tanggal_pasang[1]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $data->nama_pegawai_pasang);
							$this->excel->getActiveSheet()->setCellValueExplicit('M'.$row, $data->no_hp_pegawai_pasang, PHPExcel_Cell_DataType::TYPE_STRING);
							$jadwal_bongkar = explode(' ', $data->jadwal_bongkar);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $jadwal_bongkar[0]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $jadwal_bongkar[1]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, (1 == $data->status) ? 'ON' : 'OFF');
							$tanggal_bongkar = explode(' ', $data->tanggal_bongkar);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $tanggal_bongkar[0]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $tanggal_bongkar[1]);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $data->nama_pegawai_bongkar);
							$this->excel->getActiveSheet()->setCellValueExplicit('T'.$row, $data->no_hp_pegawai_bongkar, PHPExcel_Cell_DataType::TYPE_STRING);
							$this->excel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $data->delta_jam);
							$row++;
						}
						 
						$filename='Laporan Pemasangan Sementara ' . $tahun . '.xls'; //save our workbook as this file name
						header('Content-Type: application/vnd.ms-excel'); //mime type
						header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
						header('Cache-Control: max-age=0'); //no cache
						             
						//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
						//if you want to save it as .XLSX Excel 2007 format
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
						//force user to download the Excel file without writing it to server's HD
						$objWriter->save('php://output');
					}
				break;

			default:
				header("location:" . base_url() . "dashboard/laporan/bulanan");
				break;
		}
	}
	public function admin($act = NULL, $object = NULL)
	{
		$this->load->model('model_admin');

		switch ($act) {
			case 'tambah':

				$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 		= 'tambah';
					$data['action']		= base_url() . 'dashboard/admin/tambah';

					$this->load->view('global/header');
					$this->load->view('admin/form', $data);
					$this->load->view('global/footer');
				} else {

					if ($this->model_admin->username_check($this->input->post('username')) > 0) {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Username sudah ada.');
						$this->session->set_flashdata('short', 'Oh snap!');

						header('location:' . base_url() . 'dashboard/admin/tambah');
					} else {
						$data = array(
							'nama' 		=> $this->input->post('nama'),
							'user'		=> $this->input->post('username'),
							'pass'		=> $this->input->post('password')
							);

						if ($this->model_admin->tambah($data)) {
							$this->session->set_flashdata('class', 'alert-success');
							$this->session->set_flashdata('message', 'Data admin berhasil ditambahkan.');
							$this->session->set_flashdata('short', 'Well done!');
						} else {
							$this->session->set_flashdata('class', 'alert-danger');
							$this->session->set_flashdata('message', 'Data admin gagal ditambahkan.');
							$this->session->set_flashdata('short', 'Oh snap!');
						}
					}

					header('location:' . base_url() . 'dashboard/admin');
					
				}
				break;
			
			case 'edit':

				$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 		= 'edit';
					$data['action']		= base_url() . 'dashboard/admin/edit/' . $object;

					$admin 				= $this->model_admin->find($object);

					$data['nama']		= $admin->nama;
					$data['username']	= $admin->user;
					$data['password']	= $admin->pass;

					$this->load->view('global/header');
					$this->load->view('admin/form', $data);
					$this->load->view('global/footer');
				} else {

					if ($this->model_admin->username_check_self($this->input->post('username'), $object) > 0) {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Username sudah ada.');
						$this->session->set_flashdata('short', 'Oh snap!');

						header('location:' . base_url() . 'dashboard/admin/tambah');
					} else {
						$data = array(
							'nama' 		=> $this->input->post('nama'),
							'user'		=> $this->input->post('username'),
							'pass'		=> $this->input->post('password')
							);

						if ($this->model_admin->update($data, $object)) {
							$this->session->set_flashdata('class', 'alert-success');
							$this->session->set_flashdata('message', 'Data admin berhasil diperbaharui.');
							$this->session->set_flashdata('short', 'Well done!');
						} else {
							$this->session->set_flashdata('class', 'alert-danger');
							$this->session->set_flashdata('message', 'Data admin gagal diperbaharui.');
							$this->session->set_flashdata('short', 'Oh snap!');
						}
					}

					header('location:' . base_url() . 'dashboard/admin');
					
				}
				break;

			case 'hapus':

				if ($this->session->userdata('SESS_ID_USER') == $object) {
					$this->session->set_flashdata('class', 'alert-danger');
					$this->session->set_flashdata('message', 'Tidak bisa menghapus data diri sendiri.');
					$this->session->set_flashdata('short', 'Oh snap!');
				} else {
					if ($this->model_admin->hapus($object)) {
						$this->session->set_flashdata('class', 'alert-success');
						$this->session->set_flashdata('message', 'Data admin berhasil dihapus.');
						$this->session->set_flashdata('short', 'Well done!');
					} else {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Data admin gagal dihapus.');
						$this->session->set_flashdata('short', 'Oh snap!');
					}
				}
				

				header('location:' . base_url() . 'dashboard/admin');
				break;

			default:
				$data['count'] 			= $this->model_admin->count();
				$data['list_admin']		= $this->model_admin->get();

				$this->load->view('global/header');
				$this->load->view('admin/front', $data);
				$this->load->view('global/footer');
				break;
		}		
	}

	public function guest($act = NULL, $object = NULL)
	{
		$this->load->model('model_guest');

		switch ($act) {
			case 'tambah':

				$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 		= 'tambah';
					$data['action']		= base_url() . 'dashboard/guest/tambah';

					$this->load->view('global/header');
					$this->load->view('guest/form', $data);
					$this->load->view('global/footer');
				} else {

					if ($this->model_guest->username_check($this->input->post('username')) > 0) {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Username sudah ada.');
						$this->session->set_flashdata('short', 'Oh snap!');

						header('location:' . base_url() . 'dashboard/guest/tambah');
					} else {
						$data = array(
							'nama' 		=> $this->input->post('nama'),
							'user'		=> $this->input->post('username'),
							'pass'		=> $this->input->post('password')
							);

						if ($this->model_guest->tambah($data)) {
							$this->session->set_flashdata('class', 'alert-success');
							$this->session->set_flashdata('message', 'Data guest berhasil ditambahkan.');
							$this->session->set_flashdata('short', 'Well done!');
						} else {
							$this->session->set_flashdata('class', 'alert-danger');
							$this->session->set_flashdata('message', 'Data guest gagal ditambahkan.');
							$this->session->set_flashdata('short', 'Oh snap!');
						}
					}

					header('location:' . base_url() . 'dashboard/guest');
					
				}
				break;
			
			case 'edit':

				$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 		= 'edit';
					$data['action']		= base_url() . 'dashboard/guest/edit/' . $object;

					$guest 				= $this->model_guest->find($object);

					$data['nama']		= $guest->nama;
					$data['username']	= $guest->user;
					$data['password']	= $guest->pass;

					$this->load->view('global/header');
					$this->load->view('guest/form', $data);
					$this->load->view('global/footer');
				} else {

					if ($this->model_guest->username_check_self($this->input->post('username'), $object) > 0) {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Username sudah ada.');
						$this->session->set_flashdata('short', 'Oh snap!');

						header('location:' . base_url() . 'dashboard/guest/tambah');
					} else {
						$data = array(
							'nama' 		=> $this->input->post('nama'),
							'user'		=> $this->input->post('username'),
							'pass'		=> $this->input->post('password')
							);

						if ($this->model_guest->update($data, $object)) {
							$this->session->set_flashdata('class', 'alert-success');
							$this->session->set_flashdata('message', 'Data guest berhasil diperbaharui.');
							$this->session->set_flashdata('short', 'Well done!');
						} else {
							$this->session->set_flashdata('class', 'alert-danger');
							$this->session->set_flashdata('message', 'Data guest gagal diperbaharui.');
							$this->session->set_flashdata('short', 'Oh snap!');
						}
					}

					header('location:' . base_url() . 'dashboard/guest');
					
				}
				break;

			case 'hapus':

				if ($this->session->userdata('SESS_ID_USER') == $object) {
					$this->session->set_flashdata('class', 'alert-danger');
					$this->session->set_flashdata('message', 'Tidak bisa menghapus data diri sendiri.');
					$this->session->set_flashdata('short', 'Oh snap!');
				} else {
					if ($this->model_guest->hapus($object)) {
						$this->session->set_flashdata('class', 'alert-success');
						$this->session->set_flashdata('message', 'Data guest berhasil dihapus.');
						$this->session->set_flashdata('short', 'Well done!');
					} else {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Data guest gagal dihapus.');
						$this->session->set_flashdata('short', 'Oh snap!');
					}
				}
				

				header('location:' . base_url() . 'dashboard/guest');
				break;

			default:
				$data['count'] 			= $this->model_guest->count();
				$data['list_guest']		= $this->model_guest->get();

				$this->load->view('global/header');
				$this->load->view('guest/front', $data);
				$this->load->view('global/footer');
				break;
		}		
	}
	public function pegawai($act = NULL, $object = NULL)
	{
		$this->load->model('model_pegawai');

		switch ($act) {
			case 'tambah':

				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('no_hp', 'No. Handphone', 'required');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 		= 'tambah';
					$data['action']		= base_url() . 'dashboard/pegawai/tambah';

					$this->load->view('global/header');
					$this->load->view('pegawai/form', $data);
					$this->load->view('global/footer');
				} else {
					$data = array(
						'nama' 	=> $this->input->post('nama'),
						'no_hp'	=> $this->input->post('no_hp')
						);

					if ($this->model_pegawai->tambah($data)) {
						$this->session->set_flashdata('class', 'alert-success');
						$this->session->set_flashdata('message', 'Data pegawai berhasil ditambahkan.');
						$this->session->set_flashdata('short', 'Well done!');
					} else {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Data pegawai gagal ditambahkan.');
						$this->session->set_flashdata('short', 'Oh snap!');
					}

					header('location:' . base_url() . 'dashboard/pegawai');
					
				}
				break;
			
			case 'edit':

				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('no_hp', 'No. Handphone', 'required');

				if ($this->form_validation->run() === FALSE) {
					$data['act'] 		= 'edit';
					$data['action']		= base_url() . 'dashboard/pegawai/edit/' . $object;

					$pegawai 			= $this->model_pegawai->find($object);

					$data['nama']		= $pegawai->nama;
					$data['no_hp']		= $pegawai->no_hp;

					$this->load->view('global/header');
					$this->load->view('pegawai/form', $data);
					$this->load->view('global/footer');
				} else {
					$data = array(
						'nama' 	=> $this->input->post('nama'),
						'no_hp'	=> $this->input->post('no_hp')
						);

					if ($this->model_pegawai->update($data, $object)) {
						$this->session->set_flashdata('class', 'alert-success');
						$this->session->set_flashdata('message', 'Data pegawai berhasil diperbaharui.');
						$this->session->set_flashdata('short', 'Well done!');
					} else {
						$this->session->set_flashdata('class', 'alert-danger');
						$this->session->set_flashdata('message', 'Data pegawai gagal diperbaharui.');
						$this->session->set_flashdata('short', 'Oh snap!');
					}

					header('location:' . base_url() . 'dashboard/pegawai');
					
				}
				break;

			case 'hapus':

				if ($this->model_pegawai->hapus($object)) {
					$this->session->set_flashdata('class', 'alert-success');
					$this->session->set_flashdata('message', 'Data pegawai berhasil dihapus.');
					$this->session->set_flashdata('short', 'Well done!');
				} else {
					$this->session->set_flashdata('class', 'alert-success');
					$this->session->set_flashdata('message', 'Data pegawai gagal dihapus.');
					$this->session->set_flashdata('short', 'Oh snap!');
				}

				header('location:' . base_url() . 'dashboard/pegawai');
				break;

			default:
				$data['count'] 			= $this->model_pegawai->count();
				$data['list_pegawai']	= $this->model_pegawai->get();

				$this->load->view('global/header');
				$this->load->view('pegawai/front', $data);
				$this->load->view('global/footer');
				break;
		}		
	}

	public function get_date($lama = NULL, $menit = NULL, $jam = NULL, $hari = NULL, $bulan = NULL, $tahun = NULL)
	{
		$jam 	= $jam  + $lama;

		if ($hari != 'undefined' || $bulan != 'undefined') {
			$tanggal = mktime($jam,$menit,0,$bulan,$hari,$tahun);
			echo date("Y-m-d H:i:s", $tanggal);
		} else {
			echo 'Isi tanggal pasang terlebih dahulu';
		}
		
		
	}

	public function logout()
	{
		$this->session->sess_destroy();

		header('location:'.base_url());
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */