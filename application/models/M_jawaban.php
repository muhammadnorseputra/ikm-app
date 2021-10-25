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
}

/* End of file M_jawaban.php */
/* Location: ./application/models/M_jawaban.php */