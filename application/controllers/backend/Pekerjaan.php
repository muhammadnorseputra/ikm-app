<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pekerjaan','pekerjaan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		$data = [
            'title' => 'e-Survei | Pekerjaan',
            'content' => 'Backend/pages/pekerjaan'
        ];
        $this->load->view('Backend/layout/app', $data);		
	}

}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/backend/Pekerjaan.php */