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
            // return redirect(base_url('profile/'.$username));
            $this->output->set_status_header('404');
            show_error('MAAF, HALAMAN TIDAK DITEMUKAN');
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
            if($r->is_block == 'N'):
                $btn_is_block = '<a id="btn-block" data-val="Y" data-uid="'.encrypt_url($r->id).'" data-href="'.base_url('backend/users/update_status').'" href="!#is_block" class="dropdown-item d-flex justify-content-between">
                                    Non Active <i class="fas fa-ban text-danger"></i>
                                 </a>';
            else:
                $btn_is_block = '<a id="btn-block" data-val="N" data-uid="'.encrypt_url($r->id).'" data-href="'.base_url('backend/users/update_status').'" href="!#is_block" class="dropdown-item d-flex justify-content-between">
                                    Active <i class="fas fa-check-circle text-success"></i>
                                 </a>';
            endif;
            if($r->is_restricted == 'N'):
                $btn_is_restricted = '<a id="btn-restricted" data-val="Y" data-uid="'.encrypt_url($r->id).'" class="dropdown-item d-flex justify-content-between" data-href="'.base_url('backend/users/update_status/restricted').'" href="!#is_restrected">
                                        Restrected <i class="fas fa-star-of-life text-danger"></i>
                                      </a>';
            else:
                $btn_is_restricted = '<a id="btn-restricted" data-val="N" data-uid="'.encrypt_url($r->id).'" class="dropdown-item d-flex justify-content-between" data-href="'.base_url('backend/users/update_status/restricted').'" href="!#is_restrected">
                                        Off Restrected <i class="fas fa-star-of-life text-success"></i>
                                      </a>';
            endif;
            $button = '<div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light bg-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              '.$btn_is_block.'
                              '.$btn_is_restricted.'
                              <a class="dropdown-item d-flex justify-content-between" href="'.base_url("users/u/".encrypt_url($r->id)).'">
                                Edit <i class="fas fa-edit small"></i> 
                              </a>
                              <a class="dropdown-item d-flex justify-content-between" href="'.base_url("privileges/".encrypt_url($r->id)).'">
                                Privileges <i class="fas fa-user-lock"></i>
                              </a>
                              <a id="resspwd" data-uid="'.encrypt_url($r->id).'" class="dropdown-item d-flex justify-content-between" href="!#resspwd">
                                Reset Password <i class="fas fa-key text-warning"></i>
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

    public function update_status($ch='')
    {
        $p = $this->input->post();
        $whr = ['id' => decrypt_url($p['uid'])];
        if($ch === 'restricted') {
            $data = ['is_restricted' => $p['status']];
        } else {
            $data = ['is_block' => $p['status']];
        }
        $db = $this->users->update_tbl('t_users',$data,$whr);
        if($db)
        {
            $valid = ['valid' => true];
        } else {
            $valid = ['valid' => false];
        }
        echo json_encode($valid);
    }

    public function baru()
    {
        $data = [
            'title' => 'e-Survei | User Baru',
            'content' => 'Backend/pages/users_baru'
        ];
        $this->load->view('Backend/layout/app', $data); 
    }

    public function insert()
    {
        // Req post
        $p = $this->input->post();
        
        // Valid Form
        // $this->form_validation->set_rules('photo', 'Photo', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[4]|max_length[12]');

        if ($this->form_validation->run() == false) {
            $msg = ['valid' => false, 'pesan' => validation_errors()];
        } else {
            // Config Image
            $user_nama = strtolower($p['nama']);
            $path = './assets/images/pic';
            $config['upload_path'] = $path;  
            $config['allowed_types'] = 'jpg|jpeg|png'; 
            $config['max_size'] = 1000; // 1MB
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $user_nama;
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config); 
            if(!$this->upload->do_upload('photo'))  
                {  
                    $msg = ['valid' => false, 'pesan' => $this->upload->    display_errors()];  
                } 
            else {
                $data = array('upload_data' => $this->upload->data());
                $image= $data['upload_data']['file_name'];
                $data_insert = [
                    'pic' => $image,
                    'nama' => $p['nama'],
                    'username' => $p['username'],
                    'password' => sha1($p['pwd']),
                    'role' => $p['role'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $db = $this->users->insert('t_users', $data_insert);
                if($db)
                {
                 $row = $this->users->profile_username($data_insert['username'])->row();
                 $msg = ['valid' => true, 'pesan' => 'User baru berhasil ditambahkan.', 'redirectTo' => base_url('privileges/'.encrypt_url($row->id))];
                } else {
                    $msg = ['valid' => false, 'pesan' => 'User Gagal Ditambahkan, server tidak meresponse'];  
                }
            }
        }
        echo json_encode($msg);
    }

    // Check if username exists
    public function check_username_exists($username){
        $this->form_validation->set_message('check_username_exists', 'Username Sudah dipakai. Silahkan gunakan username lain');
         if($this->users->check_username_exists($username)){
             return true;
         } else {
             return false;
         }
    }

    public function resspwd_act()
    {
        $uid = $this->input->post('uid');
        if(!$uid) {
            $msg = ['redirectTo' => base_url('users')];
        } else {
            $msg = ['redirectTo' => base_url('resspwd/'.$uid)];
        }
        echo json_encode($msg);
    }

    public function resspwd_aksi()
    {
        $p = $this->input->post();
        $this->form_validation->set_rules('newpwd', 'Password', 'trim|required|min_length[4]|max_length[12]');
        $this->form_validation->set_rules('newpwd_confirm', 'Re-Type Password', 'required|matches[newpwd]');
        $this->form_validation->set_rules('username_confirm', 'Username Confirm', 'required');
        if ($this->form_validation->run() == false) {
            $msg = ['valid' => false, 'pesan' => validation_errors()];
        } else {
            if($p['username_confirm'] === $this->session->userdata('user_name')):
                $uid = decrypt_url($p['uid']);
                $data = [
                    'password' => sha1($p['newpwd'])
                ];
                $whr = ['id' => $uid];

                $db = $this->users->update_tbl('t_users',$data,$whr);
                if($db) {
                    $msg = ['valid' => true, 'pesan' => 'Password '.$p["user_name"].' Berhasil Diubah.', 'redirectUrl' => base_url('users')];
                } else {
                    $msg = ['valid' => false, 'pesan' => 'Ops!, password '.$p["user_name"].' gagal diubah.'];
                }
            else:
                $msg = ['valid' => false, 'pesan' => 'Konfirmasi Username Tidak Valid'];
            endif;
        }
        echo json_encode($msg);
    }

    public function resspwd($uid)
    {
        if($this->users->profile_id($uid)->num_rows() === 0) {
            redirect(base_url('users'));
            return false;
        }

        $data = [
            'title' => 'e-Survei | Reset Password',
            'content' => 'Backend/pages/users_resspwd',
            'uid' => $uid,
            'user_id' => decrypt_url($uid),
            'profile' => $this->users->profile_id($uid)->row()
        ];
        $this->load->view('Backend/layout/app', $data); 
    }

    public function privileges($uid)
    {
        $data = [
            'title' => 'e-Survei | User Privileges',
            'content' => 'Backend/pages/users_privileges',
            'uid' => decrypt_url($uid),
            'profile' => $this->users->profile_id($uid)->row()
        ];
        // Update Preferensi
        $cek_preferensi = $this->users->get_privileges_count('t_preferensi',$data['uid']);
        if($cek_preferensi->num_rows()==0) {
            $data_preferensi = [
                'fid_user' => $data['uid'],
                'theme_base' => 'default,dark,light,white,primary',
                'theme' => 'white',
                'top_bar' => 'primary',
                'main_bg' => 'primary'
            ];
            $this->users->insert('t_preferensi', $data_preferensi);
        }
        $this->load->view('Backend/layout/app', $data); 
    }

    public function privileges_update()
    {
        $p = $this->input->post();
        $uid = decrypt_url($p['uid']);
        $type = $this->input->post('f_type');

        if($type === 'privilege')
        {
            $data = [
                'fid_user' => $uid,
                'priv_default' => !empty($p['priv_default']) ? $p['priv_default'] : "N",
                'priv_responden' => !empty($p['priv_responden']) ? $p['priv_responden'] : "N",
                'priv_periode' => !empty($p['priv_periode']) ? $p['priv_periode'] : "N",
                'priv_unsur' => !empty($p['priv_unsur']) ? $p['priv_unsur'] : "N",
                'priv_daftar_pertanyaan' => !empty($p['priv_daftar_pertanyaan']) ? $p['priv_daftar_pertanyaan'] : "N",
                'priv_daftar_jawaban' => !empty($p['priv_daftar_jawaban']) ? $p['priv_daftar_jawaban'] : "N",
                'priv_jenis_layanan' => !empty($p['priv_jenis_layanan']) ? $p['priv_jenis_layanan'] : "N",
                'priv_pendidikan' => !empty($p['priv_pendidikan']) ? $p['priv_pendidikan'] : "N",
                'priv_pekerjaan' => !empty($p['priv_pekerjaan']) ? $p['priv_pekerjaan'] : "N",
                'priv_users' => !empty($p['priv_users']) ? $p['priv_users'] : "N",
            ];
            $tbl = 't_privileges';
            $cek_privilege = $this->users->get_privileges_count($tbl,$uid);
            if($cek_privilege->num_rows() == 0) {
                $db = $this->users->insert($tbl,$data);
            } else {
                $db = $this->users->update_tbl($tbl,$data,['fid_user' => $uid]);
            }
            if($db)
            {
                // $msg = ['valid' => true, 'pesan' => 'Set Privileges Berhasil'];
                $this->session->set_flashdata(['pesan' => 'Set Privileges Berhasil', 'pesan_type' => 'success']);
            } else {
                // $msg = ['valid' => false, 'pesan' => 'Set Privileges Gagal'];
                $this->session->set_flashdata(['pesan' => 'Set Privileges Gagal', 'pesan_type' => 'danger']);
            }

        } elseif($type === 'sub_privilege') {
            
            $data = [
                'fid_user' => $uid,
                'sub_responden' => implode(",", $p['sub_priv_responden']),
                'sub_periode' => implode(",", $p['sub_priv_periode']),
                'sub_unsur' => implode(",", $p['sub_priv_unsur']),
                'sub_pertanyaan' => implode(",", $p['sub_priv_pertanyaan']),
                'sub_jawaban' => implode(",", $p['sub_priv_jawaban']),
                'sub_jenis_layanan' => implode(",", $p['sub_priv_jenis_layanan']),
                'sub_pendidikan' => implode(",", $p['sub_priv_pendidikan']),
                'sub_pekerjaan' => implode(",", $p['sub_priv_pekerjaan'])            
            ];
            $tbl = 't_sub_privileges';
            $cek_privilege = $this->users->get_privileges_count($tbl,$uid);
            if($cek_privilege->num_rows() == 0) {
                $db = $this->users->insert($tbl,$data);
            } else {
                $db = $this->users->update_tbl($tbl,$data,['fid_user' => $uid]);
            }
            if($db)
            {
                $this->session->set_flashdata(['pesan' => 'Sub Privileges Berhasil', 'pesan_type' => 'success']);
            } else {
                $this->session->set_flashdata(['pesan' => 'Sub Privileges Gagal', 'pesan_type' => 'danger']);
            }
        }
        // echo json_encode($data);
        redirect(base_url('privileges/'.$p['uid']));
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
                         'top_bar' => $p['theme'][1],
                         'main_bg' => $p['theme'][2]
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
        $profile = $this->users->profile_id($user_id)->row();
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
             $config['file_name'] = strtolower($user_nama);
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
        $profile = $this->users->profile_id($user_id)->row();
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

    public function update_profile($uid)
    {
        $profile = $this->users->profile_id($uid);
        if($profile->num_rows() === 0) {
            redirect(base_url('users'));
            return false;
        }
        $user_id = decrypt_url($uid);
        $data = [
            'title' => 'e-Survei | User '.ucwords($profile->row()->nama),
            'content' => 'Backend/pages/users_profile',
            'uid' => $uid,
            'user_id' => $user_id,
            'profile' => $profile->row()
        ];
        $this->load->view('Backend/layout/app', $data); 
    }

    public function update_profile_aksi()
    {
        $p = $this->input->post();
        $profile = $this->users->profile_id($p['uid'])->row();
        $user_nama = $profile->username;
        $nama = $p['nama'];
        $role = $p['role'];
        $whr = ['id' => decrypt_url($p['uid'])]; 
        $path = './assets/images/pic';
        if(!empty($_FILES["file"]["name"]))  
        {  
             $config['upload_path'] = $path;  
             $config['allowed_types'] = 'jpg|jpeg|png'; 
             $config['max_size'] = 1000; // 1MB
             $config['file_ext_tolower'] = TRUE;
             $config['file_name'] = strtolower($user_nama);
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

                 $userdata = ['nama' => $nama, 'role' => $role, 'pic' => $image]; 
                 
                 $result = $this->users->update($userdata,$whr);
                  
                 if($result)
                 {
                    $msg = ['valid' => true, 'pesan' => 'Profile berhasil di perbaharui', 'redirectTo' => base_url("users")];
                 } else {
                    $msg = ['valid' => false, 'pesan' => 'Update profil gagal'];
                 }
             } 
        } else {
            $userdata = ['nama' => $nama, 'role' => $role];
            $result= $this->users->update($userdata,$whr);
            if($result)
             {
                $msg = ['valid' => true, 'pesan' => 'Profile berhasil di perbaharui', 'redirectTo' => base_url("users")];
             } else {
                $msg = ['valid' => false, 'pesan' => 'Update profil gagal'];
             }
        }  
        echo json_encode($msg); 
    }
}

/* End of file Profile.php */
/* Location: ./application/controllers/backend/Profile.php */