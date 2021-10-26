<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_layanan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_jenis_layanan','layanan');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		$data = [
            'title' => 'e-Survei | Jenis Layanan',
            'content' => 'Backend/pages/jenis_layanan'
        ];
        $this->load->view('Backend/layout/app', $data);		
	}

	public function ajax_jenis_layanan()
    {
        $db = $this->layanan->make_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($db as $r) {
        	$button = '<button id="edit-layanan" class="btn btn-sm rounded-circle btn-icon-only text-light" data-uid="'.encrypt_url($r->id).'" role="button">
                      <i class="fas fa-edit"></i>
                </button>';
            $button .= '<button id="hapus-layanan" class="btn btn-sm btn-danger rounded-circle btn-icon-only text-white" data-uid="'.encrypt_url($r->id).'" role="button">
                      <i class="fas fa-trash"></i>
                </button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucwords($r->nama_jenis_layanan);
            $row[] = $button;

            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->layanan->make_count_all(),
                "recordsFiltered" => $this->layanan->make_count_filtered(),
                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

    public function baru()
    {
        $data = [
            'title' => 'e-Survei | Jenis Layanan Baru',
            'content' => 'Backend/pages/jenis_layanan_baru'
        ];
        $this->load->view('Backend/layout/app', $data); 
    }

    public function insert()
    {
        $p = $this->input->post();
        $data = ['nama_jenis_layanan' => $p['jenis_layanan']];
        
        $this->form_validation->set_rules('jenis_layanan', 'Jenis_layanan', 'required');

        if($this->form_validation->run() != false){
            $db = $this->layanan->insert('skm_jenis_layanan', $data);
            if($db)
            {
                $this->session->set_flashdata(['msg' => 'Layanan <b> '.$p['jenis_layanan'].' </b> Berhasil Ditambahhkan.', 'msg_type' => 'success']);
            } else {
                $this->session->set_flashdata(['msg' => 'Layanan <b> '.$p['jenis_layanan'].' </b> Gagal Ditambahhkan.', 'msg_type' => 'danger']);
            }
            redirect(base_url('jenis_layanan'));
        } else {
            redirect(base_url('jenis_layanan/baru?msg=galat'));
        }
    }

    public function detail()
    {
        $id = $this->input->post('id');
        $db = $this->layanan->detail(['id' => decrypt_url($id)])->row();
        echo json_encode($db);
    }

    public function update()
    {
        $p = $this->input->post();
        $whr = ['id' => $p['id']];
        $data = ['nama_jenis_layanan' => $p['nama_jenis_layanan']];
        $db = $this->layanan->update('skm_jenis_layanan', $data, $whr);
        if($db)
        {
            $msg = ['valid' => true, 'msg' => 'Jenis Layanan Berhasil Diubah'];
        } else {
            $msg = ['valid' => false, 'msg' => 'Jenis Layanan Gagal Diubah'];
        }
        echo json_encode($msg);
    }

    public function delete()
    {
        $id = $this->input->get('id');
        $db = $this->layanan->delete('skm_jenis_layanan', ['id' => decrypt_url($id)]);
        if($db)
        {
            $msg = ['valid' => true, 'msg' => 'Jenis Layanan Telah Dihapus'];
        } else {
            $msg = ['valid' => false, 'msg' => 'Jenis Layanan Gagal Dihapus'];
        }
        echo json_encode($msg);

    }
}

/* End of file Jenis_layanan.php */
/* Location: ./application/controllers/backend/Jenis_layanan.php */