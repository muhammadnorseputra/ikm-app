<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_users','users');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

	public function index()
	{
		
	}

	public function profile($username)
	{
		$data = [
            'title' => 'e-Survei | '.ucwords($username),
            'content' => 'Backend/pages/profile'
        ];
        $this->load->view('Backend/layout/app', $data);	
	}

    function update_profile_basic()  
    {  
        $user_id = $this->session->userdata('user_id');
        $nama= $this->input->post('nama');
        $whr = ['id' => decrypt_url($user_id)]; 

        if(isset($_FILES["file"]["name"]))  
        {  
             $config['upload_path'] = './assets/images/pic';  
             $config['allowed_types'] = 'jpg|jpeg|png';  
             
             $this->load->library('upload', $config);  

             if(!$this->upload->do_upload('file'))  
             {  
                $msg = ['valid' => false, 'pesan' => $this->upload->display_errors()];  
             }  
             else  
             {  
                 $data = array('upload_data' => $this->upload->data());
                 $image= $data['upload_data']['file_name'];

                 $userdata = ['nama' => $nama, 'pic' => $image]; 
                 
                 $result= $this->users->update($userdata,$whr);
                  
                 if($result)
                 {
                    $msg = ['valid' => true, 'pesan' => 'Profile berhasil di perbaharui, silahkan relog untuk melihat perubahan.'];
                 } else {
                    $msg = ['valid' => false, 'pesan' => 'Update profil gagal'];
                 }
             } 
        } else {
            $userdata = ['nama' => $nama];
            $result= $this->users->update($userdata,$whr);
            if($result)
             {
                $msg = ['valid' => true, 'pesan' => 'Profile berhasil di perbaharui, silahkan relog untuk melihat perubahan.'];
             } else {
                $msg = ['valid' => false, 'pesan' => 'Update profil gagal'];
             }
        }  
        echo json_encode($msg); 
    }
}

/* End of file Profile.php */
/* Location: ./application/controllers/backend/Profile.php */