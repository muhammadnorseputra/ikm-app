<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendidikan extends CI_Model {

	public function list_pendidikan()
	{
		return $this->db->get('skm_pendidikan');
	}

	public function insert($tbl,$data)
	{
		return $this->db->insert($tbl, $data);
	}

	public function detail($id)
	{
		return $this->db->get_where('skm_pendidikan', ['id' => $id]);
	}

}

/* End of file M_pendidikan.php */
/* Location: ./application/models/M_pendidikan.php */