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
        $level = $this->session->userdata('role');
    	$username = $this->session->userdata('user_name');
        if($level !== 'SUPER_USER') {
            return redirect(base_url('profile/'.$username));
        }
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
        $profile = $this->users->profile(decrypt_url($user_id))->row();
        $user_nama = $profile->username;
        $nama= $this->input->post('nama');
        $whr = ['id' => decrypt_url($user_id)]; 
        $path = './assets/images/pic';
        if(!empty($_FILES["file"]["name"]))  
        {  
             $config['upload_path'] = $path;  
             $config['allowed_types'] = 'jpg|jpeg|png'; 
             $config['max_size'] = 1000; // 1MB
             $config['file_ext_tolower'] = TRUE;
             $config['file_name'] = $user_nama."_".$user_id;
             $config['overwrite'] = TRUE;
             
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
                    $msg = ['valid' => true, 'pesan' => 'Profile berhasil di perbaharui, silahkan relog untuk melihat perubahan.', 'redirectTo' => base_url("profile/{$user_nama}")];
                 } else {
                    $msg = ['valid' => false, 'pesan' => 'Update profil gagal', 'redirectTo' => false];
                 }
             } 
        } elseif(($nama == $profile->nama) && (empty($_FILES["file"]["name"]))) {
            $msg = ['valid' => false, 'pesan' => 'Tidak ada perubahan', 'redirectTo' => false];
        } else {
            $userdata = ['nama' => $nama];
            $result= $this->users->update($userdata,$whr);
            if($result)
             {
                $msg = ['valid' => true, 'pesan' => 'Profile berhasil di perbaharui, silahkan relog untuk melihat perubahan.', 'redirectTo' => base_url("profile/{$user_nama}")];
             } else {
                $msg = ['valid' => false, 'pesan' => 'Update profil gagal', 'redirectTo' => false];
             }
        }  
        echo json_encode($msg); 
    }

    public function update_profile_pwd()
    {
        $user_id = $this->session->userdata('user_id');
        $profile = $this->users->profile(decrypt_url($user_id))->row();
        $true_token = $this->session->csrf_token;
        $p = $this->input->post();
        
        if($p['token'] != $true_token):
            $this->output->set_status_header('403');
            $this->session->unset_userdata('csrf_token');
            show_error('This request rejected');
            return false;   
        endif;

        if($p)
        {
            // user submitted the form
            $pwd_old_db = $profile->password;
            $pwd_old_post = sha1($p['old_pwd']);
            $pwd_new_post = sha1($p['new_pwd']);
            if($pwd_old_post == $pwd_old_db) 
            {
                $this->form_validation->set_rules('new_pwd', 'New Password', 'trim|required|min_length[4]|max_length[12]');
                if ($this->form_validation->run() == false) {
                    $msg = ['valid' => false, 'pesan' => validation_errors()];
                 } else {
                    $data = ['password' => $pwd_new_post];
                    $whr = ['id' => $profile->id];
                    $db = $this->users->update_pwd('t_users',$data, $whr);
                    if($db) {
                    $msg = ['valid' => true, 'pesan' => 'Password Telah Diperbaharui, silahkan relog untuk menggunakannya.', 'redirectTo' => base_url('profile/'.$profile->username)];
                    } else {
                    $msg = ['valid' => false, 'pesan' => 'Password Gagal Diperbaharui, server tidak meresponse'];    
                    }
                 }
            } else {
                $msg = ['valid' => false, 'pesan' => 'Old Password Is Invalid'];
            }
        } else {
            $msg = ['valid' => false, 'pesan' => 'Form is empty !'];
        }
        echo json_encode($msg);
    }
}

/* End of file Profile.php */
/* Location: ./application/controllers/backend/Profile.php */