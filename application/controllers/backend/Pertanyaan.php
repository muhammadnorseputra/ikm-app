<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pertanyaan','pertanyaan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $data = [
            'title' => 'e-Survei | Pertanyaan',
            'content' => 'Backend/pages/pertanyaan',
            'list_pertanyaan' => $this->pertanyaan->get_pertanyaan()
        ];
        $this->load->view('Backend/layout/app', $data);
    }

    public function baru()
    {
        $data = [
            'title' => 'e-Survei | Pertanyaan Baru',
            'content' => 'Backend/pages/pertanyaan_baru',
            'list_unsur' => $this->pertanyaan->get_unsur()
        ];
        $this->load->view('Backend/layout/app', $data);        
    }

    public function insert()
    {
        $p = $this->input->post();
        $data = ['fid_unsur' => $p['unsur_id'], 'jdl_pertanyaan' => $p['jdl_pertanyaan'], 'status' => $p['status']];
        
        $this->form_validation->set_rules('unsur_id', 'Unsur', 'required');
        $this->form_validation->set_rules('jdl_pertanyaan', 'Judul Pertanyaan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run() != false){
            $db = $this->pertanyaan->insert('skm_pertanyaan', $data);
            if($db)
            {
                $this->session->set_flashdata(['msg' => 'Pertanyaan Berhasil Ditambahkan', 'msg_type' => 'success']);
            } else {
                $this->session->set_flashdata(['msg' => 'Pertanyaan Gagal Ditambahkan', 'msg_type' => 'danger']);
            }
            redirect(base_url('pertanyaan'));
        }else{
            redirect(base_url('pertanyaan/baru?msg=galat'));
        }
        
    }

    public function edit($id)
    {
        $pertanyaan_id = decrypt_url($id);
        $data = [
            'title' => 'e-Survei | Pertanyaan Edit',
            'content' => 'Backend/pages/pertanyaan_edit',
            'list_unsur' => $this->pertanyaan->get_unsur(),
            'd' => $this->pertanyaan->detail($pertanyaan_id)->row()
        ];
        $this->load->view('Backend/layout/app', $data);        
    }

    public function update()
    {
        $p  = $this->input->post();
        $whr = ['id' => decrypt_url($p['pertanyaan_id'])];
        $data = ['fid_unsur' => $p['unsur_id'], 'jdl_pertanyaan' => $p['jdl_pertanyaan'], 'status' => $p['status']];
        
        $this->form_validation->set_rules('unsur_id', 'Unsur', 'required');
        $this->form_validation->set_rules('jdl_pertanyaan', 'Judul Pertanyaan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run() != false){
        $db = $this->pertanyaan->update('skm_pertanyaan', $data, $whr);
            if($db)
            {
                $this->session->set_flashdata(['msg' => 'Pertanyaan Berhasil Diupdate', 'msg_type' => 'success']);
            } else {
                $this->session->set_flashdata(['msg' => 'Pertanyaan Gagal Diupdate', 'msg_type' => 'danger']);
            }
            redirect(base_url('pertanyaan'));
        } else {
            redirect(base_url('pertanyaan/edit/'.$p['pertanyaan_id'].'?msg=galat'));
        }
    }
}