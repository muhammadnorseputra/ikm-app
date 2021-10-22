<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
    }

    public function index()
    {
        $data = [
            'title' => 'Masuk Console'
        ];
        $this->load->view('Backend/login', $data);
    }
}