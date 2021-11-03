<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skm_laporan extends CI_Model {
    public function responden_by_tahun_periode_jenis_akun($tahun,$periode=null,$akun)
    {
    	$this->db->select('p.target, count(s.id) as total_responden, s.card_responden');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($akun)):
			$this->db->where('s.card_responden', $akun);
		endif;
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$this->db->group_by('s.card_responden');
		$q = $this->db->get();
		return $q;
    }	
    public function tahun_list()
    {
    	$this->db->select('id,tahun,tgl_mulai,tgl_selesai');
    	$this->db->from('skm_periode');
    	// $this->db->order_by('id', 'desc');
    	$this->db->limit('3');
    	$this->db->group_by('tahun');
    	$q = $this->db->get();
    	return $q;
    }

    public function rekap_by_tahun($tahun)
    {
    	$this->db->select('r.*, p.tahun');
    	$this->db->from('skm_rekap AS r');
    	$this->db->join('skm_periode AS p', 'r.fid_periode = p.id');
    	$this->db->where('p.tahun', $tahun);
    	$q = $this->db->get();
    	return $q;
    }

    public function target_by_tahun($tahun)
    {
    	$this->db->select('SUM(target) as target_tahunan');
		$this->db->from('skm_periode');
		$this->db->where('tahun', $tahun);
		$q = $this->db->get();
		return $q;
    }
    public function responden_by_tahun_periode($tahun,$periode=null)
    {
    	$this->db->select('s.id,s.nama_lengkap,s.jawaban_responden,p.target,p.tahun');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q;
    }	
    public function responden_by_tahun_periode_layanan($tahun,$periode=null, $layanan_id)
    {
    	$this->db->select('s.id,s.nama_lengkap,s.jawaban_responden');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->join('skm_jenis_layanan AS jl', 's.fid_jenis_layanan = jl.id');
		$this->db->where('p.tahun', $tahun);
		$this->db->where('jl.id', $layanan_id);
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q;
    }
    public function responden_by_tahun($tahun) {
    	$q = $this->db->get_where('skm', ['tahun' => $tahun]);
		return $q;
    }
    public function total_responden_by_tahun($tahun) {
    	$q = $this->db->get_where('skm', ['tahun' => $tahun]);
		return $q->num_rows();
    }
	public function total_responden_by_tahun_periode($tahun, $periode=null) {
		$this->db->select('p.tahun');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q->num_rows();
	}
	public function responden_by_umur($tahun, $periode=null, $umur_min=0, $umur_max=0, $operator) {

		if($operator === '='):
			if(!empty($periode)):
				$sql_inject = "AND s.fid_periode = $periode";
			endif;
			$q = $this->db->query("SELECT count(s.id) as total_responden 
			FROM `skm` as s
			JOIN `skm_periode` as p ON s.fid_periode=p.id
			WHERE s.umur = $umur_min AND p.tahun = $tahun ".@$sql_inject."
			");
		elseif($operator === '<'):
			if(!empty($periode)):
				$sql_inject = "AND s.fid_periode = $periode";
			endif;
			$q = $this->db->query("SELECT count(s.id) as total_responden 
			FROM `skm` as s
			JOIN `skm_periode` as p ON s.fid_periode=p.id
			WHERE s.umur <= $umur_min AND p.tahun = $tahun ".@$sql_inject."
			");
		elseif($operator === '>'):
			if(!empty($periode)):
				$sql_inject = "AND s.fid_periode = $periode";
			endif;
			$q = $this->db->query("SELECT count(s.id) as total_responden 
			FROM `skm` as s
			JOIN `skm_periode` as p ON s.fid_periode=p.id
			WHERE s.umur >= $umur_min AND p.tahun = $tahun ".@$sql_inject."
			");
		elseif($operator === '<>'):
			if(!empty($periode)):
				$sql_inject = "AND s.fid_periode = $periode";
			endif;
			$q = $this->db->query("SELECT count(s.id) as total_responden 
			FROM `skm` as s
			JOIN `skm_periode` as p ON s.fid_periode=p.id
			WHERE s.umur BETWEEN $umur_min AND $umur_max AND p.tahun = $tahun ".@$sql_inject."
			");
		endif;
		$r = $q->row();
		return $r->total_responden;
	}
	public function responden_by_gender($tahun,$periode=null,$gender) {
		$this->db->select('s.id');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($gender)):
			$this->db->where('jns_kelamin', $gender);
		endif;
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q->num_rows();
	}
	public function responden_by_pendidikan($tahun,$periode=null,$pendidikan_id) {
		$this->db->select('s.id');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($pendidikan_id)):
			$this->db->where('s.fid_pendidikan', $pendidikan_id);
		endif;
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q->num_rows();
	}
	public function responden_by_pekerjaan($tahun,$periode=null,$pekerjaan_id) {
		$this->db->select('s.id');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($pekerjaan_id)):
			$this->db->where('s.fid_pekerjaan', $pekerjaan_id);
		endif;
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q->num_rows();
	}
	public function responden_by_jenis_layanan($tahun,$periode=null,$layanan_id) {
		$this->db->select('s.id');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($layanan_id)):
			$this->db->where('s.fid_jenis_layanan', $layanan_id);
		endif;
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$q = $this->db->get();
		return $q->num_rows();
	}
	public function responden_by_jenis_akun($tahun,$periode=null)
	{
		$this->db->select('count(s.id) as total_responden, s.card_responden');
		$this->db->from('skm AS s');
		$this->db->join('skm_periode AS p', 's.fid_periode = p.id');
		$this->db->where('p.tahun', $tahun);
		if(!empty($periode)):
			$this->db->where('s.fid_periode', $periode);
		endif;
		$this->db->group_by('s.card_responden');
		$q = $this->db->get();
		return $q;
	}
	public function unsur_layanan($id)
	{
		return $this->db->get_where('skm_unsur', ['id' => $id]);
	}
	public function pertanyaan($id)
	{
		return $this->db->get_where('skm_pertanyaan', ['fid_unsur' => $id]);
	}
	public function jawaban($id)
	{
		return $this->db->get_where('skm_jawaban', ['fid_pertanyaan' => $id]);
	}
	public function total_responden_by_jawaban($jawaban_id)
	{
		$this->db->select('jawaban_responden');
		$this->db->from('skm');
		$this->db->like('jawaban_responden', $jawaban_id);
		$q = $this->db->get()->result();
		$j=[];
		foreach($q as $r){
			$j[] = explode(",", $r->jawaban_responden);
		}
		// $t = $j);
		return $j;
		// return array_count_values($j);
	}
}