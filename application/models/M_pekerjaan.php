<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pekerjaan extends CI_Model {

	public function list_pekerjaan()
	{
		return $this->db->get('skm_pekerjaan');
	}
	public function detail($id)
	{
		return $this->db->get_where('skm_pekerjaan', ['id' => $id]);
	}
	public function update($tbl,$data,$whr)
	{
		$this->db->where($whr);
		$this->db->update($tbl, $data);
		return true;
	}
	public function insert($tbl,$data)
	{
		return $this->db->insert($tbl, $data);
	}
	public function delete($tbl, $whr)
	{
		return $this->db->where($whr)->delete($tbl);
	}

}

/* End of file M_pekerjaan.php */
/* Location: ./application/models/M_pekerjaan.php */