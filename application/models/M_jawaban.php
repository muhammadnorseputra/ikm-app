<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jawaban extends CI_Model {

	public function skm_all_jawaban($id)
	{
		return $this->db->get_where('skm_jawaban', ['fid_pertanyaan' => $id]);
	}
	
	public function insert($tbl,$data)
	{
		return $this->db->insert($tbl, $data);
	}

	public function get_jawaban($pertanyaan_id)
	{
		return $this->db->get_where('skm_jawaban', ['fid_pertanyaan' => $pertanyaan_id]);
	}

	public function update_batch($tbl,$data)
	{
		$this->db->update_batch($tbl, $data, 'id');
		return true;
	}

	public function hapus($tbl,$whr) 
	{
		$this->db->where($whr);
		$this->db->delete($tbl);
		return true;
	}
}

/* End of file M_jawaban.php */
/* Location: ./application/models/M_jawaban.php */