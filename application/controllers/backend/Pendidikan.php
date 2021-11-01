<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pendidikan','pendidikan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		$data = [
            'title' => 'e-Survei | Pendidikan',
            'content' => 'Backend/pages/pendidikan',
            'list_pendidikan' => $this->pendidikan->list_pendidikan()
        ];
        $this->load->view('Backend/layout/app', $data);		
	}

    public function insert()
    {
        $p = $this->input->post();
        $data = ['tingkat_pendidikan' => $p['tp']];
        $db = $this->pendidikan->insert('skm_pendidikan', $data);
        if($db)
        {
            $msg = ['valid' => true, 'msg' => 'Tingkat Pendidikan Behasil Ditambhakan.'];
        } else {
            $msg = ['valid' => false, 'msg' => 'Tingkat Pendidikan Gagal Ditambhakan.'];
        }
        echo json_encode($msg);
    }

    public function detail($pendidikan_id)
    {
        $id = decrypt_url($pendidikan_id);
        $db = $this->pendidikan->detail($id)->row();
        $data = ['id' => encrypt_url($db->id), 'tp' => $db->tingkat_pendidikan];
        echo json_encode($data);
    }

    public function update()
    {
        $p = $this->input->post();
        $whr = ['id' => decrypt_url($p['id'])];
        $data = ['tingkat_pendidikan' => $p['tp']];
        $db = $this->pendidikan->update('skm_pendidikan', $data, $whr);
        if($db)
        {
            $msg = ['valid' => true, 
                    'msg' => 'Tingkat Pendidikan Behasil Diupdate.', 
                        "data" => [
                            'id' => $p['id'],
                            'tp' => $p['tp']
                        ]
                    ];
        } else {
            $msg = ['valid' => false, 
                    'msg' => 'Tingkat Pendidikan Gagal Diupdate.', 
                        "data" => [
                            'id' => $p['id'],
                            'tp' => $p['tp']
                        ]
                    ];
        }
        echo json_encode($msg);
    }

    public function delete($id)
    {
        $pendidikan_id = decrypt_url($id);
        $whr = ['id' => $pendidikan_id];
        $db = $this->pendidikan->delete('skm_pendidikan', $whr);
        if($db)
        {
            $msg = ['valid' => true, 'msg' => 'Tingkat Pendidikan Behasil Dihapus.', 'item' => [ 'id' => $id]];
        } else {
            $msg = ['valid' => false, 'msg' => 'Tingkat Pendidikan Gagal Dihapus.', 'item' => [ 'id' => $id]];
        }
        echo json_encode($msg);
    }
}

/* End of file pendidikan.php */
/* Location: ./application/controllers/backend/pendidikan.php */