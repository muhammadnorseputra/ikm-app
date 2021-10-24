<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_unsur extends CI_Model {
   public function get_unsur()
   {
      return $this->db->get('skm_unsur');
   }
}