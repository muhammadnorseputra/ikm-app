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

    public function m() {
        

        $unsur = $this->skm->skm_unsur_layanan();
        $total_unsur = $unsur->num_rows();

        $periode = $this->skm->skm_periode();
        $year = $periode->num_rows() != 0 ? $periode->row()->tahun : 0;
        $tahun_skr = !empty($year) ? $year : '-';
        $periode_skr = $periode->num_rows() != 0 ? $periode->row()->id : 0;
        
        $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : $tahun_skr;
        $periode_id = isset($_GET['periode']) ? $_GET['periode'] : $periode_skr;
        $layanan_id = isset($_GET['layanan_id']) ? $_GET['layanan_id'] : null;

        $responden = $this->lap->responden_by_tahun_periode_layanan($tahun,$periode_id, $layanan_id);

        $bobot_nilai = $this->skm->skm_bobot_nilai();
        
        $data = [
            'title' => 'LAPORAN IKM - BKPPD Balangan',
            'content' => 'Frontend/skm/pages/laporan_table',
            'unsur' => $unsur,
            'total_unsur' => $total_unsur,
            'tahun' => $tahun_skr,
            'periode' => $periode_skr,
            'responden' => $responden,
            'bobot' => $bobot_nilai,
        ];
        $this->load->view('Frontend/skm/layout/app', $data);
    }

}