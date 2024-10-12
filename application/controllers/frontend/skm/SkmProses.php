<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SkmProses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
    }

    public function google_validate_captcha() {
        $google_captcha = $this->input->post('g-recaptcha-response');
        $google_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfiM08bAAAAAGo4Eij2kDEFrHVTOBHm6Gmi3B6I&response=" . $google_captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $data = json_decode($google_response);

        if (isset($data->success) && $data->success == "true") {
            return TRUE;
        }
        return FALSE;
    }

    public function index()
    {
        $post = $this->input->post();
        $token_verify = $this->session->csrf_token;
        $token = $post['xtoken'];
        $cookie = get_cookie('ikm_vote');

        if(!$this->google_validate_captcha()) {
             echo json_encode(['msg' => 'Verifikasi Human Errors', 'status' => false]);
             return false;
        }

        if(empty($cookie) && decrypt_url($cookie) !== '$2y$12$F.9uzoxlvk0XVFYM9UrnaepKACUcVrF4c3JEgl22cqY5Ve6RnX/o.') {
            if(!empty($token) && ($token === $token_verify)):
                $jawab = implode(',', $post['jawaban_id']);
                $data = [
                    'tahun' => date('Y'),
                    'fid_periode' => decrypt_url($this->input->post('periode', true)),
                    'fid_jenis_layanan' => $this->input->post('jns_layanan', true),
                    'nomor' => decrypt_url($this->input->post('nomor', true)),
                    'nipnik' => !empty($this->input->post('cek_nipnik', true)) ? $this->input->post('cek_nipnik', true) : null,
                    'nama_lengkap' => $this->input->post('nama_lengkap', true),
                    'umur' => $this->input->post('umur', true),
                    'jns_kelamin' => $this->input->post('jns_kelamin', true),
                    'fid_pendidikan' => $this->input->post('pendidikan', true),
                    'fid_pekerjaan' => $this->input->post('pekerjaan', true),
                    'card_responden' => $this->input->post('card', true),
                    'jawaban_responden' => $jawab,
                    'created_at' => date('Y-m-d H:i:s'),
                    'catatan' => $this->input->post('catatan', true)
                ];
                $db = $this->skm->skm_insert('skm', $data);

                if($db)
                {
                    set_cookie('ikm_vote',encrypt_url('$2y$12$F.9uzoxlvk0XVFYM9UrnaepKACUcVrF4c3JEgl22cqY5Ve6RnX/o.'),'3600');
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