<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_periode','periode');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $data = [
            'title' => 'e-Survei | Periode',
            'content' => 'Backend/pages/periode',
            'list_periode' => $this->skm->skm_all_periode()
        ];
        $this->load->view('Backend/layout/app', $data);
    }

    public function baru()
    {
        $p = $this->input->post();

        $start_date = join('-',array_reverse(explode('/',$p['start'])));
        $end_date = join('-',array_reverse(explode('/',$p['end'])));
        $status = isset($p['aktif']) ? $p['aktif'] : 'OFF';

        $data = ['tgl_mulai' => $start_date, 'tgl_selesai' => $end_date, 'tahun' => $p['tahun'], 'target' => $p['target'], 'status' => $status];
        $db = $this->periode->insert('skm_periode', $data);
        if($db) {
            $msg = 'Periode Berhasil Ditambahkan';
        } else {
            $msg = 'Galat, periode invalid !';
        }
        echo json_encode($msg);
    }

    public function edit($id)
    {
        $id_periode = decrypt_url($id);
        $data = [
            'title' => 'e-Survei | Periode edit',
            'content' => 'Backend/pages/periode_edit',
            'id' => $id_periode,
            'd' => $this->skm->skm_periode_by_id($id_periode)
        ];
        $this->load->view('Backend/layout/app', $data);
    }
    public function update()
    {
        $p = $this->input->post();
        // $status = isset($p['aktif']) ? $p['aktif'] : 'OFF';
        $status = $p['aktif'];

        $whr = ['id' => decrypt_url($p['id'])];
        $data = ['tgl_mulai' => $p['start'], 'tgl_selesai' => $p['end'], 'target' => $p['target'], 'status' => $status];
        $update = $this->periode->update_periode('skm_periode', $data, $whr);
        if($update) {
            $this->session->set_flashdata(['msg' => 'Periode '.$p['tahun'].' (<b>'.date("F", strtotime($p['start'])).'/'.date("F", strtotime($p['end'])).'</b>) Berhasil Diupdate', 'msg_type' => 'success']);
        } else {
            $this->session->set_flashdata(['msg' => 'Periode '.$p['tahun'].' (<b>'.date("F", strtotime($p['start'])).'/'.date("F", strtotime($p['end'])).'</b>) Gagal Diupdate', 'msg_type' => 'danger']);
        }
        redirect(base_url('periode'));
        // echo json_encode([$data,$whr]);
    }
    public function hapus()
    {
        $id = decrypt_url($this->input->get('id'));
        $delete = $this->periode->hapus_periode('skm_periode', $id);
        if($delete) {
            $msg = ['valid' => true, 'rediract' => base_url('periode')];
        } else {
            $msg = ['valid' => false, 'rediract' => false];
        }
        echo json_encode($msg);
    }
}