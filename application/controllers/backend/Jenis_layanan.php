<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_layanan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_jenis_layanan','layanan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		$data = [
            'title' => 'e-Survei | Jenis Layanan',
            'content' => 'Backend/pages/jenis_layanan'
        ];
        $this->load->view('Backend/layout/app', $data);		
	}

	public function ajax_jenis_layanan()
    {
        $db = $this->layanan->make_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($db as $r) {
        	$button = '<button id="edit-layanan" class="btn btn-sm rounded-circle btn-icon-only text-light" data-uid="'.encrypt_url($r->id).'" role="button">
                      <i class="fas fa-edit"></i>
                </button>';
            $button .= '<button id="hapus-unsur" class="btn btn-sm btn-danger rounded-circle btn-icon-only text-white" data-uid="'.encrypt_url($r->id).'" role="button">
                      <i class="fas fa-trash"></i>
                </button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucwords($r->nama_jenis_layanan);
            $row[] = $button;

            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->layanan->make_count_all(),
                "recordsFiltered" => $this->layanan->make_count_filtered(),
                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file Jenis_layanan.php */
/* Location: ./application/controllers/backend/Jenis_layanan.php */