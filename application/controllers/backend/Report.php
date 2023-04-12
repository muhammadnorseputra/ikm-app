<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
        $this->load->model('m_report','report');
        $this->load->model('skm_laporan','laporan');
        cek_session();
    }
	
	public function index()
	{
		$data = [
            'title' => 'e-Survei | Report',
            'content' => 'Backend/pages/report'
        ];
        $this->load->view('Backend/layout/app', $data);	
	}

	function ch_umur() {
		$label = ['< 20','20 - 30','31 - 40','41 - 50','> 50'];
		$tahun = date('Y');
		$total_responden = $this->laporan->total_responden_by_tahun($tahun);
		// ARGS = tahun,periode,umur_min,umur_max,operator
		$down_20 = $this->laporan->responden_by_umur($tahun,null,20,null,'<');
		$between_2030 = $this->laporan->responden_by_umur($tahun,null,20,30,'<>');
		$between_3140 = $this->laporan->responden_by_umur($tahun,null,31,40,'<>');
		$between_4150 = $this->laporan->responden_by_umur($tahun,null,41,50,'<>');
		$up_50 = $this->laporan->responden_by_umur($tahun,null,50,null,'>');

		$marge = [
			$label[0] => $down_20,
			$label[1] => $between_2030,
			$label[2] => $between_3140,
			$label[3] => $between_4150,
			$label[4] => $up_50
		];
		$data = [];
		foreach ($marge as $key => $value) {
			$persentase = number_format(($value/$total_responden) * 100, 2);
			$data[] = ['y' => intval($value), 'label' => $key, 'p' => $persentase];
		}
        $this->output->set_content_type('application/json');
		echo json_encode($data);
	}
	public function ch_gender()
	{
		$tahun = date('Y');
		$total_responden = $this->laporan->total_responden_by_tahun($tahun);
		$l = $this->laporan->responden_by_gender($tahun,null,'L');
		$p = $this->laporan->responden_by_gender($tahun,null,'P');
		$marge = [
			'Laki - Laki' => intval($l),
			'Perempuan' => intval($p)
		];
		$data = [];
		foreach ($marge as $key => $value) {
			$persentase = @number_format(($value/$total_responden) * 100, 2);
			$data[] = ['y' => $value, 'label' => $key, 'p' => $persentase];
		}
		$this->output->set_content_type('application/json');
		echo json_encode($data);	
	}
	public function ch_tingpen()
	{
		$tahun = date('Y');
		$total_responden = $this->laporan->total_responden_by_tahun($tahun);
		$pendidikan = $this->skm->skm_pendidikan();
		foreach($pendidikan->result() as $p):
			$pendidikan = $p->tingkat_pendidikan;
			$total_responden_pendidikan = $this->laporan->responden_by_pendidikan($tahun,null,$p->id);
			$persentase = @number_format(($total_responden_pendidikan/$total_responden) * 100, 2);
			$data[] = ['y' => $total_responden_pendidikan, 'label' => $pendidikan, 'p' => $persentase];
		endforeach;
		$this->output->set_content_type('application/json');
		echo json_encode($data);
	}
	public function ch_jnspekerjaan()
	{
		$tahun = date('Y');
		$total_responden = $this->laporan->total_responden_by_tahun($tahun);
		$pekerjaan = $this->skm->skm_pekerjaan();
		foreach($pekerjaan->result() as $p):
			$pekerjaan = $p->jenis_pekerjaan;
			$total_responden_pekerjaan = $this->laporan->responden_by_pekerjaan($tahun,null,$p->id);
			$persentase = @number_format(($total_responden_pekerjaan/$total_responden) * 100, 2);
			$data[] = ['y' => $total_responden_pekerjaan, 'label' => $pekerjaan, 'p' => $persentase];
		endforeach;
		$this->output->set_content_type('application/json');
		echo json_encode($data);
	}
	public function ch_jnslayanan()
	{
		$tahun = date('Y');
		$jenis_layanan = $this->skm->skm_jenis_layanan();
		$count = $jenis_layanan->num_rows();
		$total_responden = $this->laporan->total_responden_by_tahun($tahun);
		foreach($jenis_layanan->result() as $jl):
			$jml_responden = $this->laporan->responden_by_jenis_layanan($tahun,null,$jl->id);
			$total_responden_by_layanan = ($jml_responden != 0) ? intval($jml_responden) : null;
			$persentase = number_format(($jml_responden/$total_responden) * 100, 2);
			$data[] = ['label' => ucwords($jl->nama_jenis_layanan), 'y' => $total_responden_by_layanan, 'p' => $persentase];
		endforeach;
		$this->output->set_content_type('application/json');
		echo json_encode($data);
	}

	public function cetak() 
	{
		$p = $this->input->post();
		$tahun = $p['report_tahun'] != '' ? $p['report_tahun'] : '-';
		$periode = $p['report_periode'] != '' ? $p['report_periode'] : '-';

		if(isset($tahun)) {
			$msg = ['valid' => true, 'ref' => base_url("print-view/{$tahun}/{$periode}") ];
		}
		echo json_encode($msg);
	}

	public function cetak_view($tahun,$periode=null) {
		$data = [
      		'title' => 'e-Survei | Cetak IKM - '.$tahun.' ( '.$this->report->getPeriodeBulan($periode).' ) ',
			'tahun' => $tahun,
			'periode' => $periode,
			'responden' => $this->laporan->responden_by_tahun_periode($tahun,$periode),
			'sampel' => $this->skm->skm_total_responden_per_tahun($tahun, $periode),
			'ikm' => apiIkm(base_url('api/ikm?periode='.$periode))
		];

        $this->load->view('Backend/pages/cetak', $data);	
	}

	public function cetak_view_two($tahun,$periode=null) {
		$data = [
      		'title' => 'e-Survei | Cetak IKM - '.$tahun.' ( '.$this->report->getPeriodeBulan($periode).' ) ',
			'tahun' => $tahun,
			'periode' => $periode,
			'responden' => $this->laporan->responden_by_tahun_periode($tahun,$periode),
			'sampel' => $this->skm->skm_total_responden_per_tahun($tahun, $periode),
			'ikm' => apiIkm(base_url('api/ikm?periode='.$periode))
		];

        $this->load->view('Backend/pages/cetakv2', $data);	
	}
}

/* End of file Report.php */
/* Location: ./application/controllers/backend/Report.php */