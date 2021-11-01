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
        $data = [
            'title' => 'e-Survei | Users',
            'content' => 'Backend/pages/users'
        ];
        $this->load->view('Backend/layout/app', $data);
	}

    public function ajax_users()
    {
        $db = $this->users->make_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($db as $r) {
            $pic = "<img src='".base_url('assets/images/pic/'.$r->pic)."' width='30' class='rounded'>";
            $button = '<div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light bg-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a class="dropdown-item d-flex justify-content-between" href="#">
                                Edit <i class="fas fa-edit small"></i> 
                              </a>
                              <a class="dropdown-item d-flex justify-content-between" href="#">
                                Non Active <i class="fas fa-ban"></i>
                              </a>
                              <a class="dropdown-item d-flex justify-content-between" href="#">
                                Restrected <i class="fas fa-star-of-life"></i>
                              </a>
                              <a class="dropdown-item d-flex justify-content-between" href="#">
                                Privileges <i class="fas fa-user-lock"></i>
                              </a>
                              <a class="dropdown-item d-flex justify-content-between text-warning" href="#">
                                Reset Password <i class="fas fa-key"></i>
                              </a>
                            </div>
                        </div>';
            $is_block = $r->is_block == 'Y' ? '<span class="badge badge-warning">YA</span>' : '<span class="badge badge-success">TIDAK</span>';
            $is_restrected = $r->is_restricted == 'Y' ? '<span class="badge badge-warning">YA</span>' : '<span class="badge badge-success">TIDAK</span>';
            $check_in = '<span class="text-sm">'.date("d-m-Y H:i", strtotime($r->check_in)).'</span>';
            $check_out = '<span class="text-sm">'.date("d-m-Y H:i", strtotime($r->check_out)).'</span>';

            $no++;
            $row = array();
            $row[] = $pic;
            $row[] = ucwords($r->nama);
            $row[] = $this->role($r->id);
            $row[] = $is_block;
            $row[] = $is_restrected;
            $row[] = $check_in;
            $row[] = $check_out;
            $row[] = $button;

            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->users->make_count_all(),
                "recordsFiltered" => $this->users->make_count_filtered(),
                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

    public function baru()
    {
        $data = [
            'title' => 'e-Survei | User Baru',
            'content' => 'Backend/pages/users_baru'
        ];
        $this->load->view('Backend/layout/app', $data); 
    }

    public function role($id)
    {
        $row = $this->users->profile_id(encrypt_url($id))->row();
        $role_name = $row->role;
        if($role_name == 'SUPER_USER'):
            $role_color = '<span class="badge badge-success">'.$role_name.'</span>';
        elseif($role_name == 'ADMIN'):
            $role_color = '<span class="badge badge-info">'.$role_name.'</span>';
        elseif($role_name == 'USER'):
            $role_color = '<span class="badge badge-dark">'.$role_name.'</span>';
        elseif($role_name == 'TAMU'):
            $role_color = '<span class="badge badge-gray">'.$role_name.'</span>';
        else:
            $role_color = '<span class="badge badge-default">'.$role_name.'</span>';
        endif;
        return $role_color;
    }

	public function profile($username)
	{
		$data = [
            'title' => 'e-Survei | Profile '.ucwords($username),
            'content' => 'Backend/pages/profile'
        ];
        $this->load->view('Backend/layout/app', $data);	
	}

    public function preferensi($username,$method='')
    {
        $user_id = $this->session->userdata('user_id');
        switch($method) {
            case "update":
                $p = $this->input->post();
                $whr = ['fid_user' => decrypt_url($user_id)];
                $data = ['theme' => $p['theme'][0], 
                         'top_bar' => $p['theme'][0],
                         'main_bg' => $p['theme'][0]
                     ];
                $db = $this->users->preferensi_update('t_preferensi', $data, $whr);
                if($db)
                {
                    $msg = ['valid' => true, 'pesan' => 'Preferensi Berhasil Telah Dirubah'];
                } else {
                    $msg = ['valid' => true, 'pesan' => 'Preferensi Gagal Telah Dirubah'];
                }
                echo json_encode($msg);
            break;
            default:
                $data = [
                    'title' => 'e-Survei | Preferensi '.ucwords($username),
                    'content' => 'Backend/pages/preferensi',
                    'list_theme' => $this->users->user_preferensi($user_id)->row()
                ];
                $this->load->view('Backend/layout/app', $data); 
        }
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