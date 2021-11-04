<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_report','report');
        cek_session();
    }
	
	public function index()
	{
		$data = [
            'title' => 'e-Survei | Report',
            'content' => 'Backend/pages/report'
        ];
        $this->load->view('Backend/layout/app', $data);	
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/backend/Report.php */