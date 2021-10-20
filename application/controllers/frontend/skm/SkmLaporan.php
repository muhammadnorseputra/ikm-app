<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SkmLaporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
        $this->load->model('skm_laporan', 'lap');
    }

    public function index()
    {
        $data = [
            'title' => 'LAPORAN IKM - BKPPD Balangan',
            'content' => 'Frontend/skm/pages/laporan',
            'total_responden' => $this->skm->skm_total_responden(),
            'pendidikan' => $this->skm->skm_pendidikan(),
            'pekerjaan' => $this->skm->skm_pekerjaan(),
        ];
        $this->load->view('Frontend/skm/layout/app', $data);
    }
}