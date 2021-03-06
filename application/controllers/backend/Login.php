<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login', 'login');
    }

    public function index()
    {
        if($this->session->userdata('user_id') != ''):
            redirect(base_url('dashboard'));
        endif;
        
        $data = [
            'title' => 'Masuk Console | e-Survei'
        ];
        $this->load->view('Backend/login', $data);
    }

    public function cek_akun()
    {
        $true_token = $this->session->csrf_token;
        if($this->input->post('token') != $true_token):
            $this->output->set_status_header('403');
            $this->session->unset_userdata('csrf_token');
            show_error('This request rejected');
            return false;
            // $json_msg = ['valid' => false, 'msg' => 'Token Invalid', 'redirect' => base_url('console')];
            // return false;   
        endif;

        if(!empty($this->session->userdata('user_id'))):
            return redirect(base_url('dashboard'));
        endif;

        $username = trim($this->security->xss_clean($this->input->post('username', true)));
        $password = trim($this->security->xss_clean($this->input->post('pwd', true)));

        $pwd = sha1($password);
        $where = array(
            'username' => $username,
            'password' => $pwd,
            // 'is_block' => 'N'
        );
        $cek = $this->login->cek_login('t_users', $where);
        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $key) {
                $row = $key;
            }
            $data_session = array(
                'user_id' => encrypt_url($row->id),
                'user_name' => $username,
                'nama' => $row->nama,
                'pic' => $row->pic,
                'role' => $row->role,
                'check_in' => date('Y-m-d H:i:s'),
                'check_out' => $row->check_out,
            );
            $this->db->update('t_users', ['check_in' => date('Y-m-d H:i:s')], ['id' => $row->id]);
            $this->session->set_userdata($data_session);
            $p_continue = $this->input->post('continue');
            $continue = isset($p_continue) ? $p_continue : base_url('dashboard');
            $json_msg = ['valid' => true, 'msg' => 'Auth success, akun ditemukan.', 'redirect' => $continue];
        } else {
            $json_msg = ['valid' => false, 'msg' => 'Auth gagal, akun tidak ditemukan.', 'redirect' => base_url('console')];
        }
        echo json_encode($json_msg);
    }

    public function sign_out()
    {
        $redirectTo = isset($_GET['continue']) ? "?continue=".$_GET['continue'] : '';
        $data = array('user_name', 'user_id','csrf_token');
        $this->db->update('t_users', ['check_out' => date('Y-m-d H:i:s')], ['id' => decrypt_url($this->session->userdata('user_id'))]);
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect(base_url('console/'.$redirectTo));
    }
}