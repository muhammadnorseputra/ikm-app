<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {
    public function __construct()
    {
        parent::__construct();
        //MODEL
        $this->load->model('skm');
        $this->load->model('skm_laporan', 'lap');
    }

    public function index_get()
    {
        // Set the response and exit
        $this->response( [
            'status' => true,
            'message' => 'API Web Survei Indeks Kepuasan Masyarakat'
        ], 404 );
    }

    public function ikm_get()
    {

        $filter_tahun = $this->get('tahun');
        $filter_periode = $this->get('periode');

        $skm_periode = $this->skm->skm_periode()->row();
        $tahun_skr = $skm_periode->tahun;
        $periode_skr = $skm_periode->id;
        $periode_skr_start = $skm_periode->tgl_mulai;
        $periode_skr_end = $skm_periode->tgl_selesai;

        if(!empty($filter_periode)):
            $responden = $this->skm->get_responden($filter_periode)->num_rows();
            $responden_pria = $this->skm->skm_total_responden_l($filter_periode)->num_rows();
            $responden_wanita = $this->skm->skm_total_responden_p($filter_periode)->num_rows();
        else:
            $responden = $this->skm->skm_total_responden_all();
            $responden_pria = $this->skm->skm_total_responden_l()->num_rows();
            $responden_wanita = $this->skm->skm_total_responden_p()->num_rows();
        endif;
        $jml_indikator = $this->skm->skm_total_indikator()->num_rows();
        $jml_layanan = $this->skm->skm_total_layanan()->num_rows();

        $data = [
            'kind' => 'Hasil IKM',
            'status' => true, 
            'tahun' => $tahun_skr,
            'jml_responden' => $responden,
            'jml_indikator' => $jml_indikator,
            'jml_layanan' => $jml_layanan,
            'jenis_kelamin' => ['L' => $responden_pria, 'P' => $responden_wanita],
            'periode' => [
                'start' => $periode_skr_start, 
                'end' => $periode_skr_end,
                'start_id' => longdate_indo($periode_skr_start),
                'end_id' => longdate_indo($periode_skr_end),
            ],
            'data' => api_curl_get(base_url('frontend/skm/skmIndex/hasil_ikm'))
        ];
        
        if($responden > 0):
            // Set the response and exit
            $this->response( $data, 200 );
        else:
            // Set the response and exit
            $this->response( [
                'status' => false,
                'message' => 'Not Found Data'
            ], 404 );
        endif;
        
        if(count($data) == 0) {
            $this->response( [
                'status' => false,
                'message' => 'Data is empty on server'
            ], 410 );
            return;
        }
    }

}