<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pertanyaan extends CI_Model {
	public function get_pertanyaan()
	{
		$this->db->select('p.*,u.jdl_unsur');
		$this->db->from('skm_pertanyaan AS p');
		$this->db->join('skm_unsur AS u', 'p.fid_unsur = u.id');
		$q = $this->db->get();
		return $q;
	}
	public function get_unsur()
	{
		return $this->db->get('skm_unsur');
	}
	public function insert($tbl,$data)
	{
		return $this->db->insert($tbl, $data);
	}
	public function detail($id)
	{
		return $this->db->get_where('skm_pertanyaan', ['id' => $id]);
	}
	public function update($tbl,$data,$whr)
	{
		$this->db->where($whr);
		$this->db->update($tbl, $data);
		return true;
	}
}