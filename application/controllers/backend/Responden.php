<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Responden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_responden','responden');
        if($this->session->userdata('user_id') == ''):
            redirect(base_url('console'));
        endif;
    }

    public function index()
    {
        $data = [
            'title' => 'e-Survei | Responden',
            'content' => 'Backend/pages/responden',
            'ikm_tahun' => $this->skm->skm_all_tahun(),
            'ikm_periode' => $this->skm->skm_all_periode(),
            'ikm_form' => $this->skm->skm_all_card()
        ];
        $this->load->view('Backend/layout/app', $data);
    }

    public function ajax_responden()
    {
        // Argument
        $dateset = $this->input->post('order_date');
        // parameter
        $filter_tahun = $this->input->post('filter_tahun');
        $filter_periode = $this->input->post('filter_periode');
        $filter_form = $this->input->post('filter_form');
        $filter_start = $this->input->post('filter_start');
        $filter_end = $this->input->post('filter_end');

        $list = $this->responden->get_datatables($filter_tahun,$filter_periode,$filter_form,$filter_start,$filter_end,$dateset);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = !empty($r->nipnik) ? sensor($r->nipnik) : "-";
            $row[] = sensor($r->nama_lengkap);
            $row[] = $r->umur;
            $row[] = $r->jns_kelamin;
            $row[] = $r->tingkat_pendidikan;
            $row[] = $r->jenis_pekerjaan;
            $row[] = $r->card_responden;

            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->responden->count_all($filter_tahun,$filter_periode,$filter_form,$filter_start,$filter_end,$dateset),
                "recordsFiltered" => $this->responden->count_filtered($filter_tahun,$filter_periode,$filter_form,$filter_start,$filter_end,$dateset),
                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }
}