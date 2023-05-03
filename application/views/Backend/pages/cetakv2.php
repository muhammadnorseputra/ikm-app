<?php  
// Extend the TCPDF class to create custom Header and Footer
class PDF extends TCPDF {

    //Page header
    public function Header() {
        
        $CI =& get_instance();
        
        $this->SetFillColor(255,255,255);
        $this->SetXY(10,0);
        $this->SetFont('helvetica', 'N', 8);
        $this->Cell(0, 15, 'Lampiran I Tahun '.date('Y'), 0, 0, 'L', 1);
        
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0,15,'Dicetak Oleh '.ucwords($CI->session->userdata('nama')) .' pada '.longdate_indo(date('Y-m-d')), 0, 1,'R', 1);
        $this->SetY(10);
        $this->Line(10,$this->GetY(),320,$this->GetY());

        $this->Image('assets/images/logo.png', 10, 16, '15', '15', 'png');
        $this->SetFont('dejavusans', 'B', 11);
        
        $this->SetXY(26, 18);
        $this->Cell(0, 15, 'HASIL OLAH DATA DAN RENCANA TIDAK LANJUT SKM', 0, false, 'L', 0, '', 0, false, 'M', 'M');

        $this->ln();
        $this->SetXY(26, 23);
        $this->Cell(0, 15, 'BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA', 0, false, 'L', 0, '', 0, false, 'M', 'M');

        $this->SetFont('dejavusans', 'N', 10);
        $this->ln();
        $this->SetXY(26, 28);
        $this->Cell(0, 15, 'Hasil Indeks Tahun '.$this->tahun .' Periode '.$CI->report->getPeriodeBulan($this->periode), 0, false, 'L', 0, '', 0, false, 'M', 'M');
    }

    public function Content($responden) {
        
        $CI =& get_instance();
        // $sampel = $CI->skm->skm_target_periode($this->periode)->target;
        $total_responden = $responden->num_rows();

        // Responden Gender
        $responden_laki = $CI->laporan->responden_by_gender($this->tahun,$this->periode,'L');
        $persentase_laki = number_format($responden_laki/$total_responden*100, 1);
        $responden_bini = $CI->laporan->responden_by_gender($this->tahun,$this->periode,'P');
        $persentase_bini = number_format($responden_bini/$total_responden*100, 1);

        #MultiCell(w, h, txt, border = 0, align = 'J', fill = 0, ln = 1, x = '', y = '', reseth = true, stretch = 0, ishtml = false, autopadding = true, maxh = 0)
        $total_responden = "<small>Total Responden</small><br>".$total_responden."</b> / ".number_format(($total_responden/$this->sampel) * 100, 2)."%";
        $total_sampel = "<small>Total Sampel / Populasi</small><br>".$this->sampel." / ".$this->populasi;
        $nilai_ikm = "<small>Nilai IKM</small><br>".number_format($this->ikm['data']['nilai_ikm'], 2)." - ".$this->ikm['data']['nilai_konversi']['x']." (".$this->ikm['data']['nilai_konversi']['y'].")";
        $total_responden_pria = "L : ". $responden_laki ." / ". $persentase_laki."%";
        $total_responden_wanita = "P : ". $responden_bini . " / ". $persentase_bini."%";

        $this->SetFont('dejavusans', 'B', 14);
        $this->MultiCell(60,15,$total_responden,1,'C', 0, 0, 10, 35, true, 0, true, false, 1);
        $this->MultiCell(50,15,$total_sampel,1,'C', 0, 0, 70, 35, true, 0, true, false, 1);
        $this->MultiCell(85,15,$nilai_ikm,1,'C', 0, 0, 120, 35, true, 0, true, false, 1);
        
        $this->SetFont('dejavusans', 'N', 10);
        #Cell(w, h = 0, txt = '', border = 0, ln = 0, align = '', fill = 0, link = nil, stretch = 0, ignore_min_height = false, calign = 'T', valign = 'M')
        $this->Ln();
        $this->Cell(30,8,$total_responden_pria,1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(30,8,$total_responden_wanita,1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(135,8,'',1,'C');
        
        // Thead
        $this->Ln(10);
        $this->Cell(10,16,'NO',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(10,16,'JK',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(15,16,'USIA',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(30,16,'PENDIDIKAN',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(30,16,'PEKERJAAN',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->SetFont('dejavusans', 'B', 9);
        $this->SetFillColor(200,249,249);
        $this->Cell(165,8,'Nilai Aktual Kepuasan Masyarakat Per Unsur Pelayanan',1,0,'C', 1, false, 0, false, 'T', 'M');
        $this->SetFont('dejavusans', 'N', 10);
        $this->Cell(50,16,'JENIS LAYANAN',1,1,'C', 0, false, 0, false, 'T', 'M');

        $unsur = $CI->skm->skm_unsur_layanan();
        $total_unsur = $unsur->num_rows();

        $this->SetXY(105,68); //geser col
        $setWidth = 165/$total_unsur;
        foreach($unsur->result() as $k => $v):
            $n = $k == 0 ? 1 : $k+1;
            $this->SetFillColor(200,249,249);
            $this->SetFont('dejavusans', 'B', 9);
            $this->Cell($setWidth,8,"U{$n}",1,0,'C', 1, false, 0, false, 'T', 'M');
        endforeach;
        $this->SetFont('dejavusans', 'N', 10);
        $this->Ln();

        // Tbody
        $no=1;
        $y = 76;
        $x = 10;
        $maxline = 1;
        $limit = 24;
        foreach($responden->result() as $k => $v):
        $total_responden_sum = $responden->num_rows();
            $maxline = $maxline % $limit;
            if($maxline == 0) {
                $y1 = 30;
                $y = 54;
                $limit = 29;
                $this->AddPage();
                $this->SetY($y1);
                $this->Ln(8);
                $this->Cell(10,16,'NO',1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(10,16,'JK',1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(15,16,'USIA',1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(30,16,'PENDIDIKAN',1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(30,16,'PEKERJAAN',1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->SetFillColor(200,249,249);
                $this->Cell(165,8,'Nilai Aktual Kepuasan Masyarakat Per Unsur Pelayanan',1,0,'C', 1, false, 0, false, 'T', 'M');
                $this->Cell(50,16,'JENIS LAYANAN',1,1,'C', 0, false, 0, false, 'T', 'M');

                $this->SetXY($x + 95,46);
                $setWidth = 165/$total_unsur;
                foreach($unsur->result() as $un => $ur):
                    $n = $un == 0 ? 1 : $un+1;
                    $this->SetFillColor(200,249,249);
                    $this->Cell($setWidth,8,"U{$n}",1,0,'C', 1, false, 0, false, 'T', 'M');
                endforeach;
                $this->Ln();
                $maxline++;
            }

            $jawaban = $CI->skm->_get_jawaban_responden($v->id);
            $poin = [];
            foreach($jawaban as $j):
                $poin[] = $CI->skm->_get_poin_responden_per_unsur($j);
            endforeach;
            $u[] = array_merge([], $poin);

                $this->MultiCell(10,5,$no,1,'C', 0, 0, $x, $y, true, 0, true, false, 1);
                $inX = $x + 95; //geser col
                $this->Cell(10,5,$v->jns_kelamin,1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(15,5,$v->umur,1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(30,5,$v->tingkat_pendidikan,1,0,'C', 0, false, 0, false, 'T', 'M');
                $this->Cell(30,5,$v->jenis_pekerjaan,1,0,'L', 0, false, 0, false, 'T', 'M');
                foreach ($poin as $key => $value):
                    $poin_unsur = isset($poin[$key]) ? $poin[$key] : 0;
                    $this->MultiCell($setWidth,5, $poin_unsur,1,'C', 0, 0, $inX, $y, true, 0, true, false, 1);
                $inX = $inX + 18.33;
                endforeach;
                
                // if($no == ($total_responden_sum + 2)) {
                //     $this->MultiCell(20,5,'','B','C', 0, 0, $inX, $y, true, 0, true, false, 1);
                // } 
                // if($maxline == ($limit-1)) {
                //     $this->MultiCell(20,5,'','B','C', 0, 0, $inX, $y, true, 0, true, false, 1);
                // }
                // $this->MultiCell(20,5,'','R','C', 0, 0, $inX, $y, true, 0, true, false, 1);

                // row jenis layanan
                $nama_jenis_layanan = strlen($v->nama_jenis_layanan);
                if($nama_jenis_layanan <= 30) {
                    $this->SetFont('dejavusans', 'N', 10);
                    $col_jenis_layanan = $v->nama_jenis_layanan;
                } elseif(($nama_jenis_layanan > 30) && ($nama_jenis_layanan <= 150)) {
                    $this->SetFont('dejavusans', 'N', 7);
                    $col_jenis_layanan = $v->nama_jenis_layanan;
                }
                $this->MultiCell(50,5,ucwords($col_jenis_layanan),1,'L', 0, 0, $inX, $y, true, 0, true, false, 1);
                $this->SetFont('dejavusans', 'N', 10);
        $y = $y + 5;
        $maxline++;
        $no++;
        endforeach;

        // Tfooter
        $this->Ln();
        $acc = array_shift($u);
        foreach ($u as $val) {
            foreach ($val as $key => $val) {
                $acc[$key] += $val;
            }
        }
        // width col
        $width = 95;
        // Bobot
        $bobot = $CI->skm->skm_bobot_nilai();
        // Nilai / Unsur
        $this->Cell($width,10,'Nilai Unsur',1,0,'C', 0, false, 0, false, 'T', 'M');
        foreach($unsur->result() as $k => $r): 
        $valid = !empty($acc[$k]) ? $acc[$k] : 0;
        $cari_nrr[] = !empty($acc[$k]) ? $acc[$k] : 0;
        $this->Cell($setWidth,10,$valid,1,0,'C', 0, false, 0, false, 'T', 'M');
        endforeach;
        $this->Cell(50,10,'','R',1,'C', 0, false, 0, false, 'T', 'M');

        // Nilai Rata-Rata / Unsur
        $this->Cell($width,10,'Nilai Rata-Rata',1,0,'C', 0, false, 0, false, 'T', 'M');
        foreach ($cari_nrr as $key => $value):
            $nrr = number_format($value/$responden->num_rows(), 3);
            $cari_nrr_t[] = $value/$responden->num_rows();
        $this->Cell($setWidth,10,$nrr,1,0,'C', 0, false, 0, false, 'T', 'M');
        endforeach;
        $this->Cell(50,10,'','RB',1,'C', 0, false, 0, false, 'T', 'M');

        // Nilai Rata-Rata Tertimbang / Unsur
        $this->Cell($width,10,'Nilai Rata-Rata Tertimbang',1,0,'C', 0, false, 0, false, 'T', 'M');
        foreach ($cari_nrr_t as $key => $value):
            $nrr_t = number_format($value*$bobot, 2);
            $nrr_t_total[] = $value*$bobot;
        $this->Cell($setWidth,10,$nrr_t,1,0,'C', 0, false, 0, false, 'T', 'M');
        endforeach;
        $nrr_total = decimal(array_sum($nrr_t_total), 3);
        $this->Cell(50,10,"*) ".$nrr_total,1,1,'R', 0, false, 0, false, 'T', 'M');

        // Nilai IKM
        $this->Cell($width,10,'SKM Unit Layanan',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(160,10,'','BL',0,'C', 0, false, 0, false, 'T', 'M');
        // $this->Cell(25,10,"**) ".number_format($nrr_total*25,2),'RB',1,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(55,10,"**) ".number_format($this->ikm['data']['nilai_ikm'], 2),'RB',1,'R', 0, false, 0, false, 'T', 'M');
        
        $this->AddPage();
        $this->SetFont('dejavusans', 'N', 9);
        $y = 35;
        $this->setXY(0,$y);
        // Tabel Keterangan
        $this->Ln(5);
        $this->SetFont('dejavusans', 'B', 9);
        $this->Cell(135,5,'Tabel Nilai Interval (NI)',1,1,'C', 0, false, 0, false, 'M', 'M');
        $this->SetFont('dejavusans', 'N', 9);
        $this->Cell(65,5,'Mutu Unit Pelayanan',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'NI',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'NIK',1,1,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(65,5,'A (Sangat Baik)',1,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'3,5324 – 4,00',1,0,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'83,31 - 100,00',1,1,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(65,5,'B (Baik)',1,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'3,0644 – 3,532',1,0,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'76,61 - 88,30',1,1,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(65,5,'C (Kurang Baik)',1,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'2,60 – 3,064',1,0,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'65,00 - 76,60',1,1,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(65,5,'D (Tidak Baik)',1,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'1,00 – 2,5996',1,0,'R', 0, false, 0, false, 'T', 'M');
        $this->Cell(35,5,'25,00 - 64,99',1,1,'R', 0, false, 0, false, 'T', 'M');
        
        // Keterangan
        $this->Ln(5);
        $this->SetFont('dejavusans', 'B', 9);
        $this->Cell(25,5,'Keterangan',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->SetFont('dejavusans', 'N', 9);
        $this->Cell(25,5,'NO',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Nomor Urut',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'JK',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Jenis Kelamin',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'L',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Laki - Laki',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'P',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Perempuan',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'N',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Nilai/Unsur',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'NRR',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Jumlah nilai per unsur dibagi jumlah kuesioner yang terisi',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'NRRT',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'NRR per unsur x '.$bobot.' per unsur',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'IKM',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Indeks Kepuasan Masyarakat',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'*)',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Jumlah NRR IKM Tertimbang',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'**)',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Jumlah NRR IKM Tertimbang x 25',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'NI',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Nilai Interval',0,1,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'NIK',0,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(5,5,':',0,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(25,5,'Nilai Interval Konversi',0,1,'L', 0, false, 0, false, 'T', 'M');
        

        // Nilai Rata-Rata Per Unsur
        $x = 155;
        $this->setXY($x,$y+3);
        $this->Cell(10,10,'NO',1,0,'C', 0, false, 0, false, 'T', 'M');
        $this->Cell(80,10,'Unsur Layanan',1,0,'L', 0, false, 0, false, 'T', 'M');
        $this->Cell(20,10,'NRR',1,1,'C', 0, false, 0, false, 'T', 'M');
        $no=1;
        foreach($unsur->result() as $k => $u) {
            $n = $k == 0 ? 1 : $k+1;
            $this->SetFont('dejavusans', 'N', 8);
            $this->SetXY($x,$y+13);
            $this->Cell(10,10,"U{$n}",1,0,'C', 0, false, 0, false, 'T', 'M');
            $nrr = decimal($cari_nrr_t[$k], 3);
            $this->Cell(80,10,$u->jdl_unsur,1,0,'L', 0, false, 0, false, 'T', 'M');
            $this->SetFont('dejavusans', 'N', 8);
            $this->Cell(20,10,$nrr,1,1,'C', 0, false, 0, false, 'T', 'M');
        $no++;
        $y = $y+10;
        }

    }   

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->Line(10, $this->GetY(), 320, $this->GetY());
        $this->SetFont('helvetica', 'N', 8);
        // Page Number
        $this->Cell(0,10,'e-Survei ::: Copyright BKPSDM Kabupaten Balangan '.date('Y'), 0, 0, 'L');
        $this->Cell(12, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


$pdf = new PDF('L', 'mm', ['215', '330']);

// Properti
$pdf->tahun = $tahun;
$pdf->periode = $periode;
$pdf->sampel = $sampel;
$pdf->populasi = $populasi;
$pdf->ikm = $ikm;

$pdf->SetTitle($title);
$pdf->SetMargins(10,25,10);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->AddPage();
$pdf->Content($responden);
$pdf->Output('cetaklaporan.pdf', 'I'); 
?>