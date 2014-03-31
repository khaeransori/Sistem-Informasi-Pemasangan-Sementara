<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_data extends CI_Model {

	public function count()
	{
		$query = $this->db->get('data');

		return $query->num_rows();
	}

	public function get()
	{
		$query = $this->db->get('data');

		return $query->result();
	}

	public function get_detail()
	{
		$query = $this->db->query('SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar, TIMESTAMPDIFF(HOUR, NOW(), (tanggal_pasang + INTERVAL lama_pesta HOUR)) as delta_jam FROM data');

		return $query->result();
	}

	public function find($id)
	{
		$query = $this->db->query('SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar FROM data WHERE id = '.$id.'');

		return $query->row();
	}

	public function update($object, $id)
	{
		return $this->db->update('data', $object, array('id' => $id));
	}

	public function hapus($id)
	{
		return $this->db->delete('data', array('id' => $id));
	}
	
	public function tambah($object)
	{
		return $this->db->insert('data', $object);
	}

	public function laporan_bulanan($bulan, $tahun)
	{
		$query = $this->db->query("SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar, TIMESTAMPDIFF(HOUR, (tanggal_pasang + INTERVAL lama_pesta HOUR), tanggal_bongkar ) as delta_jam, (select nama from pegawai where id=id_petugas_pasang) as nama_pegawai_pasang, (select no_hp from pegawai where id=id_petugas_pasang) as no_hp_pegawai_pasang, (select nama from pegawai where id=id_petugas_bongkar) as nama_pegawai_bongkar, (select no_hp from pegawai where id=id_petugas_bongkar) as no_hp_pegawai_bongkar FROM data WHERE substring(tanggal_daftar,1,7) = '".$tahun."-".$bulan."'");

		return $query->result();
	}

	public function laporan_tahunan($tahun)
	{
		$query = $this->db->query('SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar, TIMESTAMPDIFF(HOUR, (tanggal_pasang + INTERVAL lama_pesta HOUR), tanggal_bongkar ) as delta_jam, (select nama from pegawai where id=id_petugas_pasang) as nama_pegawai_pasang, (select no_hp from pegawai where id=id_petugas_pasang) as no_hp_pegawai_pasang, (select nama from pegawai where id=id_petugas_bongkar) as nama_pegawai_bongkar, (select no_hp from pegawai where id=id_petugas_bongkar) as no_hp_pegawai_bongkar FROM data WHERE substring(tanggal_daftar,1,4) = '.$tahun);

		return $query->result();
	}

	public function laporan_satuan($id)
	{
		$query = $this->db->query('SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar, TIMESTAMPDIFF(HOUR, (tanggal_pasang + INTERVAL lama_pesta HOUR), tanggal_bongkar ) as delta_jam, (select nama from pegawai where id=id_petugas_pasang) as nama_pegawai_pasang, (select no_hp from pegawai where id=id_petugas_pasang) as no_hp_pegawai_pasang, (select nama from pegawai where id=id_petugas_bongkar) as nama_pegawai_bongkar, (select no_hp from pegawai where id=id_petugas_bongkar) as no_hp_pegawai_bongkar FROM data WHERE id ='.$id);

		return $query->row();
	}

	public function get_max_year()
	{
		$query = $this->db->query('SELECT MAX(SUBSTRING(tanggal_daftar,1,4)) as max_tahun from data');

		return $query->row()->max_tahun;
	}

	public function get_min_year()
	{
		$query = $this->db->query('SELECT MIN(SUBSTRING(tanggal_daftar,1,4)) as min_tahun from data');

		return $query->row()->min_tahun;
	}

	public function count_warning()
	{
		$query = $this->db->query('SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar FROM data WHERE status=1 AND ((tanggal_pasang + INTERVAL lama_pesta HOUR) BETWEEN DATE_ADD(NOW(), INTERVAL 3 HOUR) AND NOW() OR ((tanggal_pasang + INTERVAL lama_pesta HOUR) < NOW()))');

		return $query->num_rows();
	}

	public function data_warning()
	{
		$query = $this->db->query('SELECT *, (tanggal_pasang + INTERVAL lama_pesta HOUR) as jadwal_bongkar FROM data WHERE status=1 AND ((tanggal_pasang + INTERVAL lama_pesta HOUR) BETWEEN DATE_ADD(NOW(), INTERVAL 3 HOUR) AND NOW() OR ((tanggal_pasang + INTERVAL lama_pesta HOUR) < NOW()))');

		return $query->result();
	}

	public function migrasi()
	{
		$query = $this->db->query("ALTER TABLE  `data` ADD  `status` INT( 1 ) NOT NULL DEFAULT  '0' AFTER  `id_petugas_pasang`");

		return $query;
	}
}

/* End of file model_data.php */
/* Location: ./application/models/model_data.php */