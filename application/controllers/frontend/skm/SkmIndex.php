<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SkmIndex extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');

        // $this->tahun_skr = $this->skm->skm_periode()->row()->tahun;
        $this->periode = $this->skm->skm_periode();
        $this->periode_skr = $this->periode->num_rows() != 0 ? $this->periode->row()->id : 0;
    }

    public function getAsn($value)
    {
        $url = 'http://silka.bkppd-balangankab.info/api/filternipnik';
        $api = api_client($url.'/'.$value);
        echo json_encode($api);
    }
    public function cekNipNik()
    {
        $response = array(
            'valid' => false,
            'message' => 'Silahkan masukan NIP/NIK anda dengan benar.'
        );
        $input= $this->input->post('nipnik');
        if(!empty($input)) {
            $period_skr = $this->skm->skm_periode()->row();
            $nipnik = $this->skm->ceknipnik($input, $period_skr->id);
            $cek_periode = $this->skm->responden_by_nipnik($input);
            $getnipnik = $nipnik->num_rows();
            
            if($cek_periode->num_rows() > 0){
                $periode = $cek_periode->row();
                $p = $periode->fid_periode;
            }

            if( ($getnipnik === 1) && ($period_skr->id === $p) ) {
                // false, nipnik ada di database
                $response = array('valid' => false, 'message' => 'Anda hanya dapat mengikuti survei 1 kali dalam 1 periode, silahkan untuk mengikuti pada periode berikutnya.');
            } else {
                // true, nipnik baru
                $response = array('valid' => true);
            }
        }
        echo json_encode($response);
    }

    public function _cekValue($value, $default = null)
    {
        return isset($value) ? $value : $default;
    }

    public function hitung($p)
    {
        $res = $this->skm->get_responden($p);
        $total_responden = $res->num_rows();
        $total_unsur = $this->skm->skm_total_indikator()->num_rows();
        
        if($total_responden > 0):
        foreach($res->result() as $r):
            $db = $this->skm->_get_jawaban_responden($r->id);
            $poin = [];
            foreach($db as $t):
                $poin[] = $this->skm->_get_poin_responden_per_unsur($t);
            endforeach;
            // TOTAL POIN PER RESPONDEN (x)
            $total_poin_per_responden[] = $poin;
            // POIN PER UNSUR
            $u[] = array_merge([], $poin);
        endforeach;

            // TOTAL POIN PER UNSUR
            for ($i=0; $i < $total_responden ; $i++) { 
               $total_poin_unsur_sum[] = array_sum($u[$i]);
            }
            // var_dump($total_unsur_sum);die();

            // TOTAL POIN PER RESPONDEN (x)
            for ($i=0; $i < $total_responden ; $i++) { 
                $total_p_r_p[] = array_sum($total_poin_per_responden[$i]);
            }

            // RATA-RATA PER RESPONDEN (x)
            for ($x=0; $x < $total_responden ; $x++) { 
                $rr_p_p[] = ($total_p_r_p[$x]/$total_unsur); 
            }

            // PREDIKAT (x)
            for ($y=0; $y < $total_responden; $y++) { 
                $predikat_x[] = $this->skm->predikat($rr_p_p[$y]);
            }

            // GET_PREDIKAT (x)
            for ($z=0; $z < $total_responden; $z++) { 
                $get_predikat_x[] = $predikat_x[$z]['x']; 
            }

            // TOTAL PREDIKAT (x)
            $total_predikat=[];
            for ($a=0; $a < $total_responden; $a++) { 
                $total_predikat[] = $get_predikat_x[$a]; 
            }
            
            // PERSENTASE PREDIKAT (x)
            $total_predikat_sama = array_count_values($total_predikat);
            $presentase_a = ($this->_cekValue(@$total_predikat_sama['A'], '0') / $total_responden) * 100;
            $presentase_b = ($this->_cekValue(@$total_predikat_sama['B'], '0') / $total_responden) * 100;
            $presentase_c = ($this->_cekValue(@$total_predikat_sama['C'], '0') / $total_responden) * 100;
            $presentase_d = ($this->_cekValue(@$total_predikat_sama['D'], '0') / $total_responden) * 100;
            $presentase_predikat = ['A' => number_format($presentase_a, 2), 
                                    'B' => number_format($presentase_b, 2), 
                                    'C' => number_format($presentase_c, 2), 
                                    'D' => number_format($presentase_d, 2)];
            
            // TOTAL KESELURUHAN UNSUR
            // $total_u = $total_u1 + $total_u2 + $total_u3 + $total_u4 + $total_u5 + $total_u6 
            //             + $total_u7 + $total_u8 + $total_u9; 
            
            // NILAI RATA-RATA PER UNSUR
            foreach ($total_poin_unsur_sum as $key => $value) {
                $nnr[] = ($value/$total_responden);
            }

            // NILAI RATA-RATA TERTIMBANG PER UNSUR
            $bobot_nilai = $this->skm->skm_bobot_nilai();
            foreach ($nnr as $key => $value) {
                $nnr_t[] = ($value*$bobot_nilai);
            }
            // var_dump($nnr_t);die();

            $total_nnr_t = array_merge([], $nnr_t);

            // NILAI IKM
            $ikm = array_sum($total_nnr_t) * 25;

        else:
            $ikm = '0';
        endif;
            // NILAI IKM DIKONVERSI 
            $konversi = $this->skm->nilai_predikat($ikm);
            // var_dump($konversi);
            $j = ['nilai_ikm' => $ikm, 'nilai_konversi' => $konversi, 'presentase' => @$presentase_predikat];
            // var_dump($j);
            // echo json_encode($j);
            return $j;
    }
    
    public function hasil_ikm($p)
    {
        $this->output->set_content_type('application/json');
        echo json_encode($this->hitung($p));
    }

    public function index()
    {
        $data = [
            'title' => 'SKM - BKPSDM Kab. Balangan',
            'content' => 'Frontend/skm/index',
            'total_responden' => $this->skm->skm_total_responden($this->periode_skr)
        ];
        $this->load->view('Frontend/skm/layout/app', $data);
    }

    public function survei()
    {
        $card = $this->input->get('card');
        $title = 'Survei - BKPSDM Kab. Balangan';
        if($this->skm->skm_periode()->row()->status === 'ON'){
            if($card === 'bkpsdm_balangan'):
                $data = [
                    'title' => $title,
                    'content' => 'Frontend/skm/pages/survei_mulai',
                    'periode' => $this->skm->skm_periode()->row(),
                    'pertanyaan' => $this->skm->skm_pertanyaan(),
                    'jenis_layanan' => $this->skm->skm_jenis_layanan(),
                    'pendidikan' => $this->skm->skm_pendidikan(),
                    'pekerjaan' => $this->skm->skm_pekerjaan(),
                    'nomor' => generateRandomString(7)
                ];  
            elseif($card === 'non_asn_balangan'):
                $data = [
                    'title' => $title,
                    'content' => 'Frontend/skm/pages/survei_mulai',
                    'periode' => $this->skm->skm_periode()->row(),
                    'pertanyaan' => $this->skm->skm_pertanyaan(),
                    'jenis_layanan' => $this->skm->skm_jenis_layanan(),
                    'pendidikan' => $this->skm->skm_pendidikan(),
                    'pekerjaan' => $this->skm->skm_pekerjaan(),
                    'nomor' => generateRandomString(7)
                ];  
            elseif($card === 'demo'):
                $data = [
                    'title' => $title,
                    'content' => 'Frontend/skm/pages/survei_mulai',
                    'periode' => $this->skm->skm_periode()->row(),
                    'pertanyaan' => $this->skm->skm_pertanyaan(),
                    'jenis_layanan' => $this->skm->skm_jenis_layanan(),
                    'pendidikan' => $this->skm->skm_pendidikan(),
                    'pekerjaan' => $this->skm->skm_pekerjaan(),
                    'nomor' => generateRandomString(7)
                ];  
            else:
                $data = [
                    'title' => $title,
                    'content' => 'Frontend/skm/pages/survei',
                ];  
            endif;
            $this->load->view('Frontend/skm/layout/app', $data);
        } else {
            exit(redirect(base_url('closed')));
        }
    }
    public function ikm()
    {
        $periode = isset($_GET['periode']) ? $_GET['periode'] : $this->skm->skm_periode()->row()->id;
        $data = [
            'title' => 'IKM - BKPSDM Kab. Balangan',
            'content' => 'Frontend/skm/ikm',
            'periode_all' => $this->skm->skm_all_periode(),
            'periode' => $this->skm->skm_periode()->row(),
            'total_responden' => $this->skm->skm_total_responden($periode),
            'total_responden_l' => $this->skm->skm_total_responden_l($periode)->num_rows(),
            'total_responden_p' => $this->skm->skm_total_responden_p($periode)->num_rows(),
            'total_layanan' => $this->skm->skm_total_layanan()->num_rows(),
            'total_indikator' => $this->skm->skm_total_indikator()->num_rows(),
            'hasil' => $this->hitung($periode),  
        ];
        $this->load->view('Frontend/skm/layout/app', $data);
    }
    public function cetakFormulir(){
        $layanan_id = isset($_GET['f']) ? $_GET['f'] : '';
        $data = [
            'title' => 'CETAK FORMULIR',
            'content' => 'Frontend/skm/print',
            'periode' => $this->skm->skm_periode()->row(),
            'pertanyaan' => $this->skm->skm_pertanyaan(),
            'jenis_layanan' => $this->skm->skm_jenis_layanan_byid($layanan_id)->row(),
            'pendidikan' => $this->skm->skm_pendidikan(),
            'pekerjaan' => $this->skm->skm_pekerjaan()
        ];  
        $this->load->view($data['content'], $data);
    }
    public function closed() {
        if(($this->periode->num_rows != 0 ? $this->periode->row()->status : 'OFF') === 'ON'):
          redirect(base_url('survei'));
        else:
          $data = [
            'title' => 'Survey Kepuasan Masyarakat - BKPSDM Kab. Balangan'];
          $this->load->view('Frontend/skm/pages/h_survei_closed', $data);
        endif;
      }
}