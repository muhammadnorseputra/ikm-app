<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_unsur extends CI_Model {
   public function get_unsur($id)
   {
   	  if($id != null) {
   	  	$this->db->where('id', $id);
   	  }
      return $this->db->get('skm_unsur');
   }
   public function insert($tbl, $data)
   {
   	return $this->db->insert($tbl, $data);
   }
   public function unsur_detail($id)
   {
   	return $this->db->get_where('skm_unsur', ['id' => $id]);
   }
   public function update($tbl,$data,$whr)
   {
   	$this->db->where($whr);
   	$this->db->update($tbl, $data);
   	return true;
   }
}