<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

	public function get_privileges($user_id)
	{
		$q = $this->db->get_where('t_privileges', ['fid_user' => decrypt_url($user_id)])->row_array();
		return $q;
	}

}

/* End of file M_users.php */
/* Location: ./application/models/M_users.php */