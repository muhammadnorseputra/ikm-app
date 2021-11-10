<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Console extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
    }

    public function chart_responden_tahun()
    {
        $years = $this->skm->list_year();
        $list_year = []; $list_respo = [];
        foreach($years->result() as $year):
            $respo = $this->skm->list_year($year->tahun)->num_rows();
            $list_year[] = $year->tahun;
            $list_respo[] = $respo;
        endforeach;
        echo json_encode(['tahun' => $list_year, 'responden' => $list_respo]);
    }

    public function chart_responden_bulan()
    {
        $tahun = date('Y');
        $month = $this->skm->list_bulan($tahun);
        $list_month = []; $list_respo = [];
        foreach($month->result() as $m):
            $bulan = date("m",strtotime($m->created_at));
            $respo = $this->skm->jml_list_bulan($tahun, $bulan)->num_rows();
            $list_month[] = date("F", strtotime($m->created_at));
            $list_respo[] = $respo;
        endforeach;
        echo json_encode(['bulan' => $list_month, 'responden' => $list_respo]);
    }

    public function index()
    {
        $card_responden = 'bkpsdm_balangan';
        $periode = $this->skm->skm_periode();
        if($periode->num_rows() != 0) {
            $periode_id = $periode->row()->id;
        }
        $last_periode = !empty($periode_id) ? $periode_id : 0;
        $target_periode = $this->skm->skm_target_periode($last_periode);
        $data = [
            'title' => 'e-Survei | Dashboard',
            'content' => 'Backend/pages/dashboard',
            'total_responden' => $this->skm->skm_total_responden($last_periode),
            'total_responden_periode' => $this->skm->skm_total_responden($last_periode),
            'total_responden_card' => $this->skm->skm_total_responden_card($card_responden),
            '_card_responden' => $card_responden,
            'total_periode' => $this->skm->skm_total_periode(),
            '_d' => $target_periode,
            'responden_per_pertanyaan' => $this->responden_per_pertanyaan(),
            'ikm' => api_client(base_url('api/ikm'))
        ];
        $this->load->view('Backend/layout/app', $data);
    }

    public function chart_responden_periode()
    {
        $year_now = date('Y');
        $labels = $this->skm->skm_periode_by_tahun($year_now);
        $label = []; $periode_id = [];
        foreach($labels->result() as $l):
            $label[] = date("F", strtotime($l->tgl_mulai))."/".date("F", strtotime($l->tgl_selesai));
            $periode_id[] = $l->id;
        endforeach;

        $responden = [];
        foreach($periode_id as $p => $v) {
            $responden[] = $this->skm->skm_total_responden($v);
        }
        $this->output->set_content_type('application/json');
        echo json_encode(['labels' => $label, 'respondens' => $responden]);
    }

    public function responden_per_pertanyaan()
    {
        $respondens = $this->skm->skm_get_responden();
        $tanya = $this->skm->get_pertanyaan('skm_pertanyaan',4);
        
        foreach($respondens->result() as $u):
            $j_responden[] = $this->skm->_get_jawaban_responden($u->id);
        endforeach;
        
        foreach($tanya->result() as $k => $t) {
            $jawaban[] = $this->skm->get_jawaban($t->id)->result();
            $data_tanya[] = $t->jdl_pertanyaan;
        }

        $acc = array_shift($j_responden);
        foreach ($j_responden as $val) {
            foreach ($val as $key => $val) {
                $acc[$key] += $val;
            }
        }

        $total = array_sum($acc);

        // $this->output->set_content_type('application/json');
        return (['pertanyaan' => $data_tanya, 'jawaban_responden' => $acc, 'jawaban_total' => $total]);
    }

    public function auto_complete()
    {
        $q = $this->input->post('q');
        $db = $this->users->get_menus_all($q);
        $list = [];
        if($db->num_rows() > 0):
            foreach ($db->result() as $m) {
                if(privileges($m->privilege)):
                    $list[] = ['value' => ucwords($m->nama_menu), 'url' => base_url($m->url)];
                else:
                    $list[] = ['value' => "Navigasi tidak ditemukan.", 'url' => "#"];
                endif;
            }
        else:
            $list[] = ['value' => "Navigasi tidak ditemukan.", 'url' => "#"];
        endif;
        $data = [
            "query" => "Unit",
            "suggestions" => $list
        ];
        echo json_encode($data);
    }

}