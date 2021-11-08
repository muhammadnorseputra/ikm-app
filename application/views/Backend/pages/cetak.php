<?php  
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
        $CI =& get_instance();
        
        $this->SetFillColor(255,255,255);
        $this->SetXY(10,0);
        $this->SetFont('helvetica', 'N', 8);
        $this->Cell(0, 15, 'Lampiran Tahun '.date('Y'), 0, 0, 'L', 1);
        
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0,15,'Dicetak Oleh '.ucwords($CI->session->userdata('nama')) .' pada '.longdate_indo(date('Y-m-d')), 0, 1,'R', 1);
        $this->SetY(10);
        $this->Line(10,$this->GetY(),205,$this->GetY());

        $this->Image('assets/images/logo.png', 10, 16, '15', '15', 'png');
        $this->SetFont('dejavusans', 'B', 11);
        
        $this->SetXY(26, 18);
        $this->Cell(0, 15, 'REKAPITULASI INDEKS KEPUASAN MASYARAKAT', 0, false, 'L', 0, '', 0, false, 'M', 'M');

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
        $total_sampel = "<small>Total Sampel</small><br>".$this->sampel;
        $nilai_ikm = "<small>Nilai IKM</small><br>".$this->ikm['data']['nilai_ikm']." - ".$this->ikm['data']['nilai_konversi']['x']." (".$this->ikm['data']['nilai_konversi']['y'].")";
        $total_responden_pria = "L : ". $responden_laki ." / ". $persentase_laki."%";
        $total_responden_wanita = "P : ". $responden_bini . " / ". $persentase_bini."%";

        $this->SetCellPaddings(3);
        $this->SetFont('dejavusans', 'B', 14);
        $this->MultiCell(60,15,$total_responden,1,'C', 0, 0, 10, 35, true, 0, true, false, 1);
        $this->MultiCell(50,15,$total_sampel,1,'C', 0, 0, 70, 35, true, 0, true, false, 1);
        $this->MultiCell(85,15,$nilai_ikm,1,'C', 0, 0, 120, 35, true, 0, true, false, 1);
        $this->SetFont('dejavusans', 'N', 10);
        $this->MultiCell(30,6,$total_responden_pria,1,'L', 0, 0, 10, 50, true, 0, true, false, 0, 'M');
        $this->MultiCell(30,6,$total_responden_wanita,1,'L', 0, 0, 40, 50, true, 0, true, false, 0, 'M');
        $this->MultiCell(135,6,'',1,'C', 0, 0, 70, 50, true, 0, true, false, 0);
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->Line(10, $this->GetY(), 205, $this->GetY());
        $this->SetFont('helvetica', 'N', 8);
        // Page Number
        $this->Cell(0,10,'e-Survei ::: Copyright BKPSDM Kabupaten Balangan '.date('Y'), 0, 0, 'L');
        $this->Cell(12, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


$pdf = new MYPDF('P', 'mm', ['215', '330']);

// Properti
$pdf->tahun = $tahun;
$pdf->periode = $periode;
$pdf->sampel = $sampel;
$pdf->ikm = $ikm;

$pdf->SetTitle($title);
$pdf->SetMargins(10,25,10);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->AddPage();
$pdf->Content($responden);
$pdf->Output('cetaklaporan.pdf', 'I'); 
?>