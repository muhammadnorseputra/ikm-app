<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skm extends CI_Model {
	public function skm_unsur_layanan()
	{
		return $this->db->get('skm_unsur');
	}
	public function skm_all_tahun()
	{
		return $this->db->order_by('id','desc')->group_by('tahun')->get('skm_periode');
	}
	public function skm_all_periode()
	{
		return $this->db->order_by('id','desc')->get('skm_periode');
	}
	public function skm_total_periode() {
		return $this->db->select('id')->group_by('tahun')->get('skm_periode')->num_rows();
	}
	public function skm_target_periode($periode=null)
	{
		return $this->db->get_where('skm_periode',  ['id' => $periode])->row();
	}
	public function skm_periode()
	{
		return $this->db->order_by('id','desc')->get('skm_periode', 1);
	}
	public function skm_periode_by_id($id)
	{
		return $this->db->get_where('skm_periode', ['id'=>$id])->row();
	}
	public function skm_pertanyaan()
	{
		return $this->db->get('skm_pertanyaan');
	}
	public function skm_jawaban_pertanyaan($id)
	{
		return $this->db->get_where('skm_jawaban', ['fid_pertanyaan' => $id]);
	}
	public function skm_jenis_layanan()
	{
		return $this->db->get('skm_jenis_layanan');
	}
	public function skm_jenis_layanan_byid($id)
	{
		return $this->db->get_where('skm_jenis_layanan', ['id' => $id]);
	}
	public function skm_pendidikan()
	{
		return $this->db->get('skm_pendidikan');
	}
	public function skm_pekerjaan()
	{
		return $this->db->get('skm_pekerjaan');
	}	
	public function ceknomor($nomor)
	{
		return $this->db->get_where('skm', ['nomor' => $nomor]);
	}
	public function skm_insert($tbl, $data)
	{
		return $this->db->insert($tbl, $data);
	}
	public function skm_get_responden()
	{
		return $this->db->get('skm');
	}
	public function skm_total_responden_all()
	{
		return $this->db->get_where('skm')->num_rows();
	}
	public function skm_periode_by_tahun($tahun)
	{
		return $this->db->get_where('skm_periode', ['tahun' => $tahun]);
	}
	public function skm_all_card()
	{
		return $this->db->group_by('card_responden')->get('skm');
	}
	public function skm_total_responden_card($card)
	{
		return $this->db->get_where('skm', ['card_responden' => $card])->num_rows();
	}
	public function skm_total_responden_per_tahun($tahun)
	{
		$q = $this->db->select_sum('target')
		->from('skm_periode')
		->where('tahun', $tahun)
		->get();
		if($q->num_rows() != 0)
		{
			$r = $q->row()->target;
		}
		return $r;
	}
	public function get_responden($periode=null)
	{
		return $this->db->get_where('skm', ['fid_periode' => $periode]);
	}
	public function responden_by_nipnik($nipnik)
	{
		return $this->db->get_where('skm', ['nipnik' => $nipnik]);
	}
	public function skm_total_responden($periode=null)
	{
		return $this->db->get_where('skm',  ['fid_periode' => $periode])->num_rows();
	}
	public function list_responden()
	{
		$this->db->select('*');
		$this->db->from('skm');
		$this->db->where('created_at', date('Y-m-d'));
		$this->db->limit(7);
		$this->db->order_by('id', 'desc');
		$q = $this->db->get();
		return $q->result();
	}
	public function jml_list_responden()
	{
		$this->db->select('*');
		$this->db->from('skm');
		$this->db->where('created_at', date('Y-m-d'));
		$q = $this->db->get();
		return $q->num_rows();	
	}
	public function skm_total_responden_l($periode=null)
	{
		// return $this->db->get_where('skm', ['jns_kelamin' => 'L', 'fid_periode' => $periode]); //Laki-laki
		if(!empty($periode)):
			$this->db->where('fid_periode', $periode);
		endif;
		$this->db->where('jns_kelamin', 'L');
		return $this->db->get('skm');
	}
	public function skm_total_responden_p($periode=null)
	{
		// return $this->db->get_where('skm', ['jns_kelamin' => 'P', 'fid_periode' => $periode]); //Perempuan
		if(!empty($periode)):
			$this->db->where('fid_periode', $periode);
		endif;
		$this->db->where('jns_kelamin', 'P');
		return $this->db->get('skm');
	}
	public function skm_total_layanan()
	{
		return $this->db->get('skm_jenis_layanan');
	}
	public function skm_total_indikator()
	{
		return $this->db->get('skm_pertanyaan');
	}

	public function skm_bobot_nilai()
	{
		$jumlah_bobot = 1;
		$jumlah_unsur = $this->skm_pertanyaan()->num_rows();
		$bobot_nilai = $jumlah_bobot / $jumlah_unsur;
		return number_format($bobot_nilai,2);
	}

	public function _get_jawaban_responden($userId)
	{
		$responden = $this->db->get_where('skm', ['id' => $userId]);
		foreach($responden->result() as $r):
			$q = $r->jawaban_responden;
			$s = explode(',', $q);
			$d = $s;
		endforeach;
		return $d;
	}

	public function _get_poin_responden_per_unsur($id)
	{
		$this->db->select('poin');
		$this->db->from('skm_jawaban');
		$this->db->where('id', $id);
		$q = $this->db->get()->row();
		return $q->poin;
	}

	public function ceknipnik($n,$periode_id)
	{
		return $this->db->get_where('skm', ['nipnik' => $n, 'fid_periode' => $periode_id]);
	}

	public function list_bulan($year=null)
	{
		$this->db->select('*');
		$this->db->from('skm');
		$this->db->where('tahun', $year);
		// $this->db->order_by("created_at", 'desc');	
		$this->db->group_by("DATE_FORMAT(created_at,'%m')");
		$q = $this->db->get();
		return $q;
	}

	public function jml_list_bulan($year=null, $month=null)
	{
		$this->db->select('*');
		$this->db->from('skm');
		$this->db->where('tahun', $year);
		if(!empty($month)) {
			$this->db->where("DATE_FORMAT(created_at,'%m')", $month);
		}
		$q = $this->db->get();
		return $q;
	}

	public function list_year($year=null)
	{
		$this->db->select('tahun');
		$this->db->from('skm');
		if(!empty($year)) {
			$this->db->where('tahun', $year);
		} else {
			$this->db->group_by('tahun');
		}
		$q = $this->db->get();
		return $q;
	}

	public function get_pertanyaan($tbl)
	{
		return $this->db->get($tbl, 4,0);
	}
	public function get_jawaban($id)
	{
		return $this->db->get_where('skm_jawaban', ['fid_pertanyaan' => $id]);
	}
	public function predikat($ikm) {
        if($ikm >= '1.00' && $ikm <= '2.5996'):
            $c = 'danger';
            $x = 'D';
            $y = 'TIDAK BAIK';
        elseif($ikm >= '2.60' && $ikm <= '3.064'):
            $c = 'warning';
            $x = 'C';
            $y = 'KURANG BAIK';
        elseif($ikm >= '3.0644' && $ikm <= '3.532'):
            $c = 'info';
            $x = 'B';
            $y = 'BAIK';
        elseif($ikm >= '3.5324' && $ikm <= '4.00'):
            $c = 'success';
            $x = 'A';
            $y = 'SANGAT BAIK';
        else:
            $c = 'muted';
            $x = '~';
            $y = 'Tidak Terdefinisi';
        endif;
        return ['x' => $x, 'y' => $y, 'c' => $c];   
    }

    public function nilai_predikat($ikm)
    {
        if($ikm >= '25.00' && $ikm <= '64.99'):
            $c = 'danger';
            $x = 'D';
            $y = 'TIDAK BAIK';
        elseif($ikm >= '65.00' && $ikm <= '76.60'):
            $c = 'warning';
            $x = 'C';
            $y = 'KURANG BAIK';
        elseif($ikm >= '76.61' && $ikm <= '88.30'):
            $c = 'info';
            $x = 'B';
            $y = 'BAIK';
        elseif($ikm >= '88.31' && $ikm <= '100.00'):
            $c = 'success';
            $x = 'A';
            $y = 'SANGAT BAIK';
        else:
            $c = 'muted';
            $x = '~';
            $y = 'Tidak Terdefinisi';
        endif;
        return ['x' => $x, 'y' => $y, 'c' => $c];
    }

}