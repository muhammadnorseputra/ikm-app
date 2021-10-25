<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jawaban extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pertanyaan','pertanyaan');
        $this->load->model('m_jawaban','jawaban');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $data = [
            'title' => 'e-Survei | Jawaban',
            'content' => 'Backend/pages/jawaban',
            'list_pertanyaan' => $this->pertanyaan->get_pertanyaan()
        ];
        $this->load->view('Backend/layout/app', $data);
    }
    public function insert()
    {
        $p = $this->input->post();
        $id = decrypt_url($p['id']);
        $data = ['fid_pertanyaan' => $id, 'jdl_jawaban' => $p['jdl_jawaban'], 'poin' => $p['poin']];
        $db = $this->jawaban->insert('skm_jawaban', $data);
        if($db)
        {
            $msg = ['msg' => 'Jawaban Berhasil Ditambahkan', 'valid' => true];
        } else {
            $msg = ['msg' => 'Jawaban Gagal Ditambahkan', 'valid' => false];
        }
        echo json_encode($msg);
    }
    public function edit($pertanyaan_id)
    {
        $data = [
            'title' => 'e-Survei | Edit Jawaban',
            'content' => 'Backend/pages/jawaban_edit',
            'list_jawaban' => $this->jawaban->get_jawaban(decrypt_url($pertanyaan_id))
        ];
        $this->load->view('Backend/layout/app', $data);
    }
}