<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

class Api extends RestController {
    public function __construct()
    {
        parent::__construct();
        //MODEL
        $this->load->model('skm');
        $this->load->model('skm_laporan', 'lap');
    }

    function configToken(){
        $cnf['exp'] = 3600; //milisecond
        $cnf['secretkey'] = '2212336221';
        return $cnf;        
    }

    public function authtoken(){
        $secret_key = $this->configToken()['secretkey']; 
        $token = null; 
        $authHeader = isset($this->input->request_headers()['Authorization']) ? $this->input->request_headers()['Authorization'] : 'AUTH NOT_ALLOWED';  
        $arr = explode(" ", $authHeader); 
        $token = !empty($arr[1]) ? $arr[1] : 'TOKEN_REQUIRED';        
        if ($token){
            try{
                $decoded = JWT::decode($token, $this->configToken()['secretkey'], array('HS256'));          
                if ($decoded){
                    return true;
                }
            } catch (\Exception $e) {
                return false;                
            }
        }       
    }

    public function getToken_post(){               
            $exp = time() + 3600;
            $token = array(
                "iss" => 'apprestservice',
                "aud" => 'pengguna',
                "iat" => time(),
                "nbf" => time() + 10,
                "exp" => $exp,
                "data" => array(
                    "username" => 'admin',
                    "password" => '1234'
                )
            );       
        
        $jwt = JWT::encode($token, $this->configToken()['secretkey'], 'HS256');
        $output = [
                'status' => 200,
                'message' => 'Berhasil login',
                "token" => $jwt,                
                "expireAt" => $token['exp']
            ];      
        $data = array('kode'=>'200', 'pesan'=>'token', 'data'=>array('token'=>$jwt, 'exp'=>$exp));
        $this->response($data, 200 );       
    }


    public function layanan_post()
    {
        if ($this->authtoken() === false){
            return $this->response(array('status'=>false, 'message'=>'signature tidak sesuai'), RestController::HTTP_UNAUTHORIZED);
            die();
        }
        $layanan = $this->skm->skm_jenis_layanan();
        if($layanan->num_rows() == 0) {
            return $this->response( [
                'status' => false,
                'message' => 'Data is empty on database'
            ], RestController::HTTP_NOT_FOUND);
            die();
        }

        $data = [];
        foreach($layanan->result() as $r) {
            $row['id'] = $r->id;
            $row['name'] = strtoupper($r->nama_jenis_layanan);
            $data[] = $row;
        }
        $this->response($data, RestController::HTTP_OK);
    }
    public function pendidikan_get()
    {
        $pendidikan = $this->skm->skm_pendidikan();
        if($pendidikan->num_rows() == 0) {
            return $this->response( [
                'status' => false,
                'message' => 'Data is empty on database'
            ], RestController::HTTP_NOT_FOUND );
        }
        $data = [];
        foreach($pendidikan->result() as $r) {
            $row['id'] = $r->id;
            $row['name'] = strtoupper($r->tingkat_pendidikan);
            $data[] = $row;
        }
        $this->response($data, RestController::HTTP_OK);
    }
    public function pekerjaan_get()
    {
        $pekerjaan = $this->skm->skm_pekerjaan();
        if($pekerjaan->num_rows() == 0) {
            return $this->response( [
                'status' => false,
                'message' => 'Data is empty on database'
            ], 410 );
        }
        $data = [];
        foreach($pekerjaan->result() as $r) {
            $row['id'] = $r->id;
            $row['name'] = strtoupper($r->jenis_pekerjaan);
            $data[] = $row;
        }
        $this->response($data, 200);
    }
    public function ikm_get()
    {
        $periode_skr = $this->skm->skm_periode()->row()->id;
        $filter_tahun = $this->get('tahun');
        $filter_periode = $this->get('periode');
        $p = isset($filter_periode) ? $filter_periode : $periode_skr;  

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
            // $responden = $this->skm->skm_total_responden_all();
            $responden = $this->skm->get_responden($periode_skr)->num_rows();
            $responden_pria = $this->skm->skm_total_responden_l($periode_skr)->num_rows();
            $responden_wanita = $this->skm->skm_total_responden_p($periode_skr)->num_rows();
        endif;
        $jml_indikator = $this->skm->skm_total_indikator()->num_rows();
        $jml_layanan = $this->skm->skm_total_layanan()->num_rows();
        $data_ikm = apiIkm(base_url('frontend/skm/skmIndex/hasil_ikm/'.$p));
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
            $this->response( $data, RestController::HTTP_OK );
        else:
            // Set the response and exit
            $this->response( [
                'status' => false,
                'message' => 'Not Found Data'
            ], RestController::HTTP_NOT_FOUND );
        endif;
        
        if(count($data) == 0) {
            $this->response( [
                'status' => false,
                'message' => 'Data is empty on server'
            ], RestController::HTTP_FORBIDDEN );
            return;
        }
    }

    function ch_gender()
    {
        // row data periode yg terakhir di database
        $periode_db = $this->skm->skm_periode()->row();
        // ambil parameters yg dikirim lewat ajax ?periode=???
        $getPeriode = $this->input->get('periode');
        //jika parameter ada maka pakai $getPeriode jika tidak ada pakai periode terkahir dari database
        $priode = isset($getPeriode) ? $getPeriode : $periode_db->id;
        // row data periode berdasarkan id
        $periode_db_id = $this->skm->skm_periode_by_id($getPeriode);
        //jika parameter ada maka tahun pakai periode yang dipilih dan jika tidak pakai tahun terakhir dari database
        $tahun = $getPeriode !== '' ? $periode_db_id->tahun : $periode_db->tahun;
        
        if(!$tahun) {
            $this->response('DATA TIDAK DITEMUKAN', 404);  
            return false;
        }
        $total_responden = $this->lap->total_responden_by_tahun_periode($tahun, $priode);
        $l = $this->lap->responden_by_gender($tahun,$priode,'L');
        $p = $this->lap->responden_by_gender($tahun,$priode,'P');
        $marge = [
            'Laki - Laki' => intval($l),
            'Perempuan' => intval($p)
        ];
        $data = [];
        foreach ($marge as $key => $value) {
            $persentase = @number_format(($value/$total_responden) * 100, 2);
            $data[] = ['y' => $value, 'label' => $key, 'p' => $persentase];
        }
        $this->response( $data, 200 );  
        
    }

    function ch_tingpen()
    {
        // row data periode yg terakhir di database
        $periode_db = $this->skm->skm_periode()->row();
        // ambil parameters yg dikirim lewat ajax ?periode=???
        $getPeriode = $this->input->get('periode');
        //jika parameter ada maka pakai $getPeriode jika tidak ada pakai periode terkahir dari database
        $priode = isset($getPeriode) ? $getPeriode : $periode_db->id;
        // row data periode berdasarkan id
        $periode_db_id = $this->skm->skm_periode_by_id($getPeriode);
        //jika parameter ada maka tahun pakai periode yang dipilih dan jika tidak pakai tahun terakhir dari database
        $tahun = $getPeriode !== '' ? $periode_db_id->tahun : $periode_db->tahun;
        
        if(!$tahun) {
            $this->response('DATA TIDAK DITEMUKAN', 404);  
            return false;
        }
        // $tahun = date('Y'); // tahun sekarang
        $total_responden = $this->lap->total_responden_by_tahun_periode($tahun, $priode);
        $pendidikan = $this->skm->skm_pendidikan();
        foreach($pendidikan->result() as $p):
            $pendidikan = $p->tingkat_pendidikan;
            $total_responden_pendidikan = $this->lap->responden_by_pendidikan($tahun,$priode,$p->id);
            $persentase = @number_format(($total_responden_pendidikan/$total_responden) * 100, 2);
            $data[] = ['y' => $total_responden_pendidikan, 'label' => $pendidikan, 'p' => $persentase];
        endforeach;
        $this->response( $data, 200 );
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