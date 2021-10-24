<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pertanyaan','pertanyaan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $data = [
            'title' => 'e-Survei | Pertanyaan',
            'content' => 'Backend/pages/pertanyaan',
            'list_pertanyaan' => $this->pertanyaan->get_pertanyaan()
        ];
        $this->load->view('Backend/layout/app', $data);
    }

    public function baru()
    {
        $data = [
            'title' => 'e-Survei | Pertanyaan Baru',
            'content' => 'Backend/pages/pertanyaan_baru',
            'list_unsur' => $this->pertanyaan->get_unsur()
        ];
        $this->load->view('Backend/layout/app', $data);        
    }

}