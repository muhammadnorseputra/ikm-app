<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Console extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $card_responden = 'demo';
        $last_periode = $this->skm->skm_periode()->row()->id;
        $data = [
            'title' => 'e-Survei | Dashboard',
            'content' => 'Backend/pages/dashboard',
            'total_responden' => $this->skm->skm_total_responden_all(),
            'total_responden_periode' => $this->skm->skm_total_responden($last_periode),
            'total_responden_card' => $this->skm->skm_total_responden_card($card_responden),
            '_card_responden' => $card_responden,
            'total_periode' => $this->skm->skm_total_periode(),
            '_d' => $this->skm->skm_target_periode($last_periode),
            'ikm' => api_client(base_url('api/ikm'))
        ];
        $this->load->view('Backend/layout/app', $data);
    }
}