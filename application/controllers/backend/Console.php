<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Console extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
    }

    public function index()
    {
        $data = [
            'title' => 'Welcome Dashboard',
            'content' => 'Backend/pages/dashboard'
        ];
        $this->load->view('Backend/layout/app', $data);
    }
}