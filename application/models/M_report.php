<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {

	public function getPeriodeBulan($id) {
		$q = $this->db->get_where('skm_periode', ['id' => $id])->row();
		$tgl_m = $q->tgl_mulai;
		$tgl_s = $q->tgl_selesai;

		$m = date('m', strtotime($tgl_m));
		$s = date('m', strtotime($tgl_s));

		$date = bulan($m)."/".bulan($s);
		return $date; 
	}

}

/* End of file M_report.php */
/* Location: ./application/models/M_report.php */