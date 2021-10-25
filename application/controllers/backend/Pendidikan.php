<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pendidikan','pendidikan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		$data = [
            'title' => 'e-Survei | Pendidikan',
            'content' => 'Backend/pages/pendidikan'
        ];
        $this->load->view('Backend/layout/app', $data);		
	}

}

/* End of file pendidikan.php */
/* Location: ./application/controllers/backend/pendidikan.php */