<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pekerjaan','pekerjaan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		$data = [
            'title' => 'e-Survei | Pekerjaan',
            'content' => 'Backend/pages/pekerjaan',
            'list_pekerjaan' => $this->pekerjaan->list_pekerjaan()
        ];
        $this->load->view('Backend/layout/app', $data);		
	}

    public function detail($pekerjaan_id)
    {
        $id = decrypt_url($pekerjaan_id);
        $db = $this->pekerjaan->detail($id)->row();
        $data = ['id' => encrypt_url($db->id), 'jp' => $db->jenis_pekerjaan];
        echo json_encode($data);
    }

    public function update()
    {
        $p = $this->input->post();
        $whr = ['id' => decrypt_url($p['id'])];
        $data = ['jenis_pekerjaan' => $p['jp']];
        $db = $this->pekerjaan->update('skm_pekerjaan', $data, $whr);
        if($db)
        {
            $msg = ['valid' => true, 
                    'msg' => 'Jenis Pekerjaan Behasil Diupdate.', 
                        "data" => [
                            'id' => $p['id'],
                            'jp' => $p['jp']
                        ]
                    ];
        } else {
            $msg = ['valid' => false, 
                    'msg' => 'Jenis Pekerjaan Gagal Diupdate.', 
                        "data" => [
                            'id' => $p['id'],
                            'jp' => $p['jp']
                        ]
                    ];
        }
        echo json_encode($msg);
    }

    public function insert()
    {
        $p = $this->input->post();
        $data = ['jenis_pekerjaan' => $p['jp']];
        $db = $this->pekerjaan->insert('skm_pekerjaan', $data);
        if($db)
        {
            $msg = ['valid' => true, 'msg' => 'Jenis Pekerjaan Behasil Ditambhakan.'];
        } else {
            $msg = ['valid' => false, 'msg' => 'Jenis Pekerjaan Gagal Ditambhakan.'];
        }
        echo json_encode($msg);
    }

    public function delete($id)
    {
        $pekerjaan_id = decrypt_url($id);
        $whr = ['id' => $pekerjaan_id];
        $db = $this->pekerjaan->delete('skm_pekerjaan', $whr);
        if($db)
        {
            $msg = ['valid' => true, 'msg' => 'Jenis Pekerjaan Behasil Dihapus.', 'item' => [ 'id' => $id]];
        } else {
            $msg = ['valid' => false, 'msg' => 'Jenis Pekerjaan Gagal Dihapus.', 'item' => [ 'id' => $id]];
        }
        echo json_encode($msg);
    }

}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/backend/Pekerjaan.php */