<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SkmProses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
    }

    public function index()
    {
        $post = $this->input->post();
        $token_verify = $this->session->csrf_token;
        $token = $post['xtoken'];
        $cookie = get_cookie('ikm_vote');
        if(empty($cookie) || $cookie !== '1') {
            if(!empty($token) && ($token === $token_verify)):
                $jawab = implode(',', $post['jawaban_id']);
                $data = [
                    'tahun' => date('Y'),
                    'fid_periode' => decrypt_url($post['periode']),
                    'fid_jenis_layanan' => $post['jns_layanan'],
                    'nomor' => decrypt_url($post['nomor']),
                    'nipnik' => !empty($post['cek_nipnik']) ? $post['cek_nipnik'] : null,
                    'nama_lengkap' => $post['nama_lengkap'],
                    'umur' => $post['umur'],
                    'jns_kelamin' => $post['jns_kelamin'],
                    'fid_pendidikan' => $post['pendidikan'],
                    'fid_pekerjaan' => $post['pekerjaan'],
                    'card_responden' => $post['card'],
                    'jawaban_responden' => $jawab,
                    'created_at' => date('Y-m-d')
                ];
                $db = $this->skm->skm_insert('skm', $data);

                if($db)
                {
                    set_cookie('ikm_vote','1','3600');
                    $msg = ['msg' => 'Token Valid', 'status' => true, 'redirectTo' => base_url('finish/'.$post['nomor'])];
                } else {
                    delete_cookie('ikm_vote');
                    $msg = ['msg' => 'Token valid, but send to server error', 'status' => false];
                }
            else:
                $msg = ['msg' => 'Invalid Token', 'status' => false];
            endif;
        } else {
            $msg = ['msg' => 'Invalid Responden', 'status' => false, 'redirectTo' => base_url('invalid/'.$post['nomor'])];
        }
        echo json_encode($msg);
    }
    
    public function invalid($nomor)
    {
        $data = [
            'title' => 'Invalid Responden',
            'content' => 'Frontend/skm/pages/survei_invalid',
            'nomor' => $nomor
        ];  
        if(!empty($nomor)):
            $this->load->view('Frontend/skm/layout/app', $data);
        else:
            exit(redirect(base_url('survei?msg=NotFound'),'refresh'));
        endif;
    }

    public function selesai($nomor)
    {
        $no = decrypt_url($nomor);
        $cek_nomor = $this->skm->ceknomor($no)->num_rows();
        $data = [
            'title' => 'Finish - Survei telah selesai.',
            'content' => 'Frontend/skm/pages/survei_selesai',
            'nomor' => $nomor
        ];  

        if(!empty($nomor)):
            $this->load->view('Frontend/skm/layout/app', $data);
        else:
            exit(redirect(base_url('survei?msg=NotFound'),'refresh'));
        endif;

    }

}