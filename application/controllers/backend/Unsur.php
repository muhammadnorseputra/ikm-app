<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unsur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_unsur','unsur');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $data = [
            'title' => 'e-Survei | Unsur',
            'content' => 'Backend/pages/unsur',
            'list_unsur' => $this->unsur->get_unsur()
        ];
        $this->load->view('Backend/layout/app', $data);
    }
}