<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SkmIndex extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');

        // $this->tahun_skr = $this->skm->skm_periode()->row()->tahun;
        $this->periode_skr = $this->skm->skm_periode()->row()->id;
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

    public function hitung()
    {

        $res = $this->skm->get_responden($this->periode_skr);
        $total_responden = $res->num_rows();
        $total_unsur = $this->skm->skm_total_indikator()->num_rows();
        // var_dump($total_responden);die();
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
            $u1[] = $poin[0];
            $u2[] = $poin[1];
            $u3[] = $poin[2];
            $u4[] = $poin[3];
            $u5[] = $poin[4];
            $u6[] = $poin[5];
            $u7[] = $poin[6];
            $u8[] = $poin[7];
            $u9[] = $poin[8];

            // TOTAL POIN PER UNSUR
            $total_u1 = array_sum($u1);
            $total_u2 = array_sum($u2);
            $total_u3 = array_sum($u3);
            $total_u4 = array_sum($u4);
            $total_u5 = array_sum($u5);
            $total_u6 = array_sum($u6);
            $total_u7 = array_sum($u7);
            $total_u8 = array_sum($u8);
            $total_u9 = array_sum($u9);

        endforeach;
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
            // var_dump($total_predikat_sama);die();
            // var_dump($presentase_predikat);die();
            
            // TOTAL KESELURUHAN UNSUR
            // $total_u = $total_u1 + $total_u2 + $total_u3 + $total_u4 + $total_u5 + $total_u6 
            //             + $total_u7 + $total_u8 + $total_u9; 
            
            // NILAI RATA-RATA PER UNSUR
            $nnr_u1 = ($total_u1/$total_responden);
            $nnr_u2 = ($total_u2/$total_responden);
            $nnr_u3 = ($total_u3/$total_responden);
            $nnr_u4 = ($total_u4/$total_responden);
            $nnr_u5 = ($total_u5/$total_responden);
            $nnr_u6 = ($total_u6/$total_responden);
            $nnr_u7 = ($total_u7/$total_responden);
            $nnr_u8 = ($total_u8/$total_responden);
            $nnr_u9 = ($total_u9/$total_responden);
            // TOTAL RATA - RATA
            $total_nnr = [$nnr_u1,$nnr_u2,$nnr_u3,$nnr_u4,$nnr_u5,$nnr_u6,$nnr_u7,$nnr_u8,$nnr_u9];

            // NILAI RATA-RATA TERTIMBANG PER UNSUR
            $bobot_nilai = $this->skm->skm_bobot_nilai();
            $nnr_t_u1 = ($nnr_u1*$bobot_nilai);
            $nnr_t_u2 = ($nnr_u2*$bobot_nilai);
            $nnr_t_u3 = ($nnr_u3*$bobot_nilai);
            $nnr_t_u4 = ($nnr_u4*$bobot_nilai);
            $nnr_t_u5 = ($nnr_u5*$bobot_nilai);
            $nnr_t_u6 = ($nnr_u6*$bobot_nilai);
            $nnr_t_u7 = ($nnr_u7*$bobot_nilai);
            $nnr_t_u8 = ($nnr_u8*$bobot_nilai);
            $nnr_t_u9 = ($nnr_u9*$bobot_nilai);
            // TOTAL RATA-RATA TERTIMBANG
            $total_nnr_t = [$nnr_t_u1,$nnr_t_u2,$nnr_t_u3, $nnr_t_u4, $nnr_t_u5, $nnr_t_u6, $nnr_t_u7, $nnr_t_u8, $nnr_t_u9];

            // var_dump(array_sum($total_nnr)*25*0.11);die();

            // die();
            // NILAI IKM
            $ikm = array_sum($total_nnr_t) * 25;
            // var_dump($total_nnr_t);die();

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

    public function hasil_ikm()
    {
        echo json_encode($this->hitung());
    }

    public function index()
    {
        $data = [
            'title' => 'SKM - BKPPD Balangan',
            'content' => 'Frontend/skm/index',
            'total_responden' => $this->skm->skm_total_responden_all()
        ];
        $this->load->view('Frontend/skm/layout/app', $data);
    }

    public function survei()
    {
        $card = $this->input->get('card');
        $title = 'Survei - BKPPD Balangan';
        if($this->skm->skm_periode()->row()->status === 'ON'){
            if($card === 'asn_balangan'):
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
        $data = [
            'title' => 'IKM - BKPPD Kab. Balangan',
            'content' => 'Frontend/skm/ikm',
            'periode' => $this->skm->skm_periode()->row(),
            'total_responden' => $this->skm->skm_total_responden($this->periode_skr),
            'total_responden_l' => $this->skm->skm_total_responden_l($this->periode_skr)->num_rows(),
            'total_responden_p' => $this->skm->skm_total_responden_p($this->periode_skr)->num_rows(),
            'total_layanan' => $this->skm->skm_total_layanan()->num_rows(),
            'total_indikator' => $this->skm->skm_total_indikator()->num_rows(),
            'hasil' => $this->hitung(),  
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
}