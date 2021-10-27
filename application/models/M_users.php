<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

	public function profile($user_id)
	{
		return $this->db->get('t_users');
	}

	public function get_menus($position)
	{
		$q = $this->db->get_where('t_menus', ['position' => $position, 'status' => 'Y']);
		return $q;
	}

	public function get_menus_all($q)
	{
		return $this->db->like('nama_menu', $q)->get_where('t_menus', ['status' => 'Y']);
	}

	public function get_privileges($user_id)
	{
		$q = $this->db->get_where('t_privileges', ['fid_user' => decrypt_url($user_id)]);
		if($q->num_rows() > 0) {
			$query = $q->row_array();
		} else {
			$query = 0;
		}
		return $query;
	}

	public function get_privileges_sub($user_id,$col,$priv_key)
	{
		$q = $this->db->get_where('t_sub_privileges', ['fid_user' => decrypt_url($user_id)]);
		if($q->num_rows() > 0):
			$r = $q->row();
	     	$data = explode(",", $r->$col);	
	     	foreach ($data as $key => $value) {
	     		$priv[$key] = $value;
	     	}
	     	$privilege = isset($priv[$priv_key]) ? $priv[$priv_key] : 0;  
	     	$result =  $privilege;
	    else:
	    	$result = 0;
		endif;
		return $result;
	}

}

/* End of file M_users.php */
/* Location: ./application/models/M_users.php */