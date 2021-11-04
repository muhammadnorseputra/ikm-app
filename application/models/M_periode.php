<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_periode extends CI_Model {
	public function insert($tbl,$data)
	{
		return $this->db->insert($tbl, $data);
	}
	public function hapus_periode($tbl, $id)
	{
		$this->db->where('id', $id);
		$this->db->delete($tbl);
		return true;
	}
	public function update_periode($tbl,$data,$whr) 
	{
		$this->db->where($whr);
		$this->db->update($tbl, $data);
		return true;
	}
	public function delete_batch($tbl,$whr) {
		return $this->db->where($whr)->delete($tbl);
	}
}