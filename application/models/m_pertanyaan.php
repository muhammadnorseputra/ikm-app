<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pertanyaan extends CI_Model {
	public function get_pertanyaan()
	{
		$this->db->select('p.*,u.*');
		$this->db->from('skm_pertanyaan AS p');
		$this->db->join('skm_unsur AS u', 'p.fid_unsur = u.id');
		$q = $this->db->get();
		return $q;
	}
	public function get_unsur()
	{
		return $this->db->get('skm_unsur');
	}
}