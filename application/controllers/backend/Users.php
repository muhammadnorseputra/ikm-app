<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_users','users');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		
	}

	public function profile($username)
	{
		echo $username;
	}
}

/* End of file Profile.php */
/* Location: ./application/controllers/backend/Profile.php */