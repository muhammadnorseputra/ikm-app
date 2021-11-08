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

    public function Content($dataset) {

        #MultiCell(w, h, txt, border = 0, align = 'J', fill = 0, ln = 1, x = '', y = '', reseth = true, stretch = 0, ishtml = false, autopadding = true, maxh = 0)
        $total_responden = '
            <small>Total Responden</small>
        ';
        $this->MultiCell(40,20,$total_responden,1,'J',0,0, 10, 35, false, 0, true, false, 0);

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
$pdf->tahun = $tahun;
$pdf->periode = $periode;
$pdf->SetTitle($title);
$pdf->SetMargins(10,25,10);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->AddPage();
$pdf->Content($dataset);
$pdf->Output('cetaklaporan.pdf', 'I'); 
?>