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
        $data_ikm = apiIkm(base_url('frontend/skm/skmIndex/hasil_ikm'));
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
            'data' => $data_ikm
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

    function ch_gender()
    {
        $tahun = date('Y');
        $total_responden = $this->lap->total_responden_by_tahun($tahun);
        $l = $this->lap->responden_by_gender($tahun,null,'L');
        $p = $this->lap->responden_by_gender($tahun,null,'P');
        $marge = [
            'Laki - Laki' => intval($l),
            'Perempuan' => intval($p)
        ];
        $data = [];
        foreach ($marge as $key => $value) {
            $persentase = @number_format(($value/$total_responden) * 100, 2);
            $data[] = ['y' => $value, 'label' => $key, 'p' => $persentase];
        }
        $this->output->set_content_type('application/json');
        echo json_encode($data);    
    }

    function ch_tingpen()
    {
        $tahun = date('Y');
        $total_responden = $this->lap->total_responden_by_tahun($tahun);
        $pendidikan = $this->skm->skm_pendidikan();
        foreach($pendidikan->result() as $p):
            $pendidikan = $p->tingkat_pendidikan;
            $total_responden_pendidikan = $this->lap->responden_by_pendidikan($tahun,null,$p->id);
            $persentase = @number_format(($total_responden_pendidikan/$total_responden) * 100, 2);
            $data[] = ['y' => $total_responden_pendidikan, 'label' => $pendidikan, 'p' => $persentase];
        endforeach;
        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

    public function chart_get($type)
    {
        if($type === 'CH_GENDER'):
            $ch_data = $this->ch_gender();
        elseif($type === 'CH_TINGPEN'):
            $ch_data = $this->ch_tingpen();
        endif;
        return $ch_data;
    }

}