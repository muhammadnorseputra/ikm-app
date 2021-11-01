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
        $id = decrypt_url($pertanyaan_id);
        $data = [
            'title' => 'e-Survei | Edit Jawaban',
            'content' => 'Backend/pages/jawaban_edit',
            'pertanyaan_id' => $pertanyaan_id,
            'list_jawaban' => $this->jawaban->get_jawaban($id)
        ];
        $this->load->view('Backend/layout/app', $data);
    }
    public function update_batch()
    {
        $p = $this->input->post();
        $id = decrypt_url($p['id']);
        $jawaban = $p['jdl_jawaban'];
        $jawaban_explode = [];
        foreach($jawaban as $key => $val):
            $jawaban_explode[] = ['id' => $key, 'jdl_jawaban' => $val, 'poin' => $p['poin'][$key]];
        endforeach;
        $db = $this->jawaban->update_batch('skm_jawaban', $jawaban_explode);
        if($db) {
            $this->session->set_flashdata(['msg' => 'Jawaban Berhasil Dirubah', 'msg_type' => 'success']);
        }   else {
            $this->session->set_flashdata(['msg' => 'Jawaban Gagal Dirubah', 'msg_type' => 'danger']);
        }
        redirect(base_url('jawaban'));
        // echo json_encode($jawaban_explode);
    }
    public function hapus($id) 
    {
        $id_explode = explode("-", $id);

        $jawaban_id = decrypt_url($id_explode[0]);
        $pertanyaan_id = $id_explode[1];

        $db = $this->jawaban->hapus('skm_jawaban', ['id' => $jawaban_id]);
        if($db) {
            $this->session->set_flashdata(['msg' => 'Jawaban Berhasil Dihapus', 'msg_type' => 'success']);
        }   else {
            $this->session->set_flashdata(['msg' => 'Jawaban Gagal Dihapus', 'msg_type' => 'danger']);
        }
        redirect(base_url('jawaban/edit/'.$pertanyaan_id));
        // echo json_encode($id_explode);
    }
}