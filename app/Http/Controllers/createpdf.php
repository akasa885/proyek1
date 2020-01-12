<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Facades\Fpdf;

use App\akun;
use App\jobs;
use App\tipe_narkoba;
use App\agama;
use App\suku;
use App\rehab_publik;
use App\rehab_tat;
use App\skhpn;
use App\klinikrehab;


class createpdf extends Controller
{
    protected $pdf;
    protected $reg_num;
    protected $date_pdf;
    function __construct(\App\Pdf $pdf)
    {
      $this->pdf = $pdf;
    }

    function publikbuatPDF($pbl_num)
    {
      $narkoba ='';
      $data_find = rehab_publik::where('kode_registrasi','=',$pbl_num)->get();
      $this->reg_num = $pbl_num;
      $this->pdf->AliasNbPages();
      $this->pdf->AddPage();
      $this->pdf->Image('assets/images/logo-bnn-terbaru.png',88,5,35,35);
      $this->pdf->SetAlpha(0.3);
      $this->pdf->Image('assets/images/logo-bnn-terbaru.png',46,85,120);
      $this->pdf->SetAlpha(1);
      // Arial bold 15
      $this->pdf->SetFont('Arial','B',12);
      //Enter
      $this->pdf->Ln(2);
      // Move to the right
      $this->pdf->Cell(80);
      // Title
      $this->pdf->Cell(30,65,'E-REGISTRASI KLIEN REHABILITASI RAWAT JALAN DI KLINIK PRATAMA',0,1,'C');
      $this->pdf->Cell(80);
      $this->pdf->Cell(30,-53,'BNN KABUPATEN SIDOARJO',0,1,'C');
      // Line break
      $this->pdf->Ln(40);
      $this->pdf->Line(15,55.1,200,55.1);
      $this->pdf->SetLineWidth(1);
      $this->pdf->SetFont('arial','',12);
      $this->pdf->Ln(3);
      foreach ($data_find as $row) {
        $this->pdf->Cell(35,10,'TGL. KEDATANGAN',0,0,'C');
        $this->pdf->SetXY(75,66);
        $this->pdf->MultiCell(100,10,':     '.$this->date_penerjemah($row->tgl_kedatangan),0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(30,10,'NAMA LENGKAP',0,0,'C');
        $this->pdf->SetXY(75,77);
        $this->pdf->MultiCell(100,10,':     '.$row->nama_lengkap,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(31,10,'JENIS KELAMAIN',0,0,'C');
        $this->pdf->SetXY(75,88);
        $this->pdf->MultiCell(100,10,':     '.$row->gender,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(30,10,'TANGGAL LAHIR',0,0,'C');
        $this->pdf->SetXY(75,99);
        $this->pdf->MultiCell(100,10,':     '.$this->date_penerjemah($row->birth_date),0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(9,10,'UMUR',0,0,'C');
        $this->pdf->SetXY(75,110);
        $this->pdf->MultiCell(100,10,':     '.$row->umur.' Tahun',0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(20,10,'No.KTP/NIK',0,0,'C');
        $this->pdf->SetXY(75,122);
        $this->pdf->MultiCell(100,10,':     '.$row->nik_ktp,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(25,10,'AGAMA/SUKU',0,0,'C');
        $this->pdf->SetXY(75,133);
        $this->pdf->MultiCell(100,10,':     '.$row->agama.' / '.$row->suku,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(48,10,'JENIS YANG DIGUNAKAN',0,0,'C');
        $this->pdf->SetXY(75,144);
        $nampung = '';
        $narkoba = explode(',',$row->narkoba);
        for ($i=0; $i < count($narkoba) ; $i++) {
          $nampung .= $narkoba[$i];
          if (!$i == (count($narkoba)-1)) {
            $nampung = $nampung." | ";
          }
        }
        $this->pdf->MultiCell(100,10,':     '.$nampung,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(13,10,'STATUS',0,0,'C');
        $this->pdf->SetXY(75,155);
        $this->pdf->MultiCell(100,10,':     '.$row->status,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(17,10,'NAMA IBU',0,0,'C');
        $this->pdf->SetXY(75,166);
        $this->pdf->MultiCell(100,10,':     '.$row->nama_ibu,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(22,10,'NAMA AYAH',0,0,'C');
        $this->pdf->SetXY(75,177);
        $this->pdf->MultiCell(100,10,':     '.$row->nama_ayah,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(31,10,'ALAMAT RUMAH',0,0,'C');
        $this->pdf->SetXY(75,188);
        $this->pdf->MultiCell(130,10,':     '.$row->alamat,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->SetXY(10,208);
        $this->pdf->Cell(20,10,'NOMOR HP',0,0,'C');
        $this->pdf->SetXY(75,208);
        $this->pdf->MultiCell(100,10,':     '.$row->no_hp,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(44,10,'NOMOR HP KELUARGA',0,0,'C');
        $this->pdf->SetXY(75,219);
        $this->pdf->MultiCell(100,10,':     '.$row->no_hp_keluarga,0,'L',False);
      }
      $this->pdf->Ln(2);
      $this->pdf->Cell(185,10,'Sidoarjo, .............................................]',0,1,'R');
      $this->pdf->Cell(185,8,'Klien Rehabilitasi Reguler Di Klinik Pratama',0,1,'R');
      $this->pdf->Cell(167,8,'BNN Kabupaten Sidoarjo',0,1,'R');
      $this->pdf->SetY(249);
      $this->pdf->Cell(80,8,'Petugas',0,1,'C');
      $this->pdf->Ln(8);
      $this->pdf->Cell(80,5,'..........................................',0,1,'C');
      $this->pdf->Cell(80,5,'(                                      )',0,1,'C');
      $this->pdf->SetXY(112,265);
      $this->pdf->Cell(80,5,'..........................................',0,1,'C');
      $this->pdf->SetX(112);
      $this->pdf->Cell(80,5,'(                                      )',0,1,'C');

      $dir_regist = "Documents/Rehab/Publik/".$this->reg_num;
      if (!file_exists($dir_regist)) {
        mkdir($dir_regist,777,true);
      }
      $this->date_pdf = date('d-m-Y');
      $path_file = $dir_regist."/".$this->date_pdf.'_'.$this->reg_num.".pdf";
      if(file_exists($path_file))
      {
        $return_data['STATUS_CODE']='00';
        $return_data['MESSAGE']='File exist';
        unlink(public_path().'/'.$path_file);
      }else
      {
        $return_data['STATUS_CODE']='01';
        $return_data['MESSAGE']='File not found, Please tryagain';
      }
      $this->pdf->Output($dir_regist."/".$this->date_pdf.'_'.$this->reg_num.".pdf",'F');
      $path_fix = public_path().'/'.$path_file;
      return response()->file(public_path().'/'.$path_file);
      // echo "<iframe src=\"../../../$path_file\" width=\"100%\" style=\"height:30%\"></iframe>";
    }

    function tatbuatPDF($tat_num)
    {
      $data_find = rehab_tat::where('kode_registrasi','=',$tat_num)->get();
      $this->reg_num = $tat_num;
      $narkoba = ['Ganja', 'Sabu-Sabu', 'Nikotin','Ecstasy','Tembakau Gorila','Pil Koplo/LL'];
      $berat = array();
      $this->pdf->AliasNbPages();
      $this->pdf->AddPage();
      $this->pdf->Image('assets/images/logo-bnn-terbaru.png',88,5,35,35);
      $this->pdf->SetAlpha(0.3);
      $this->pdf->Image('assets/images/logo-bnn-terbaru.png',46,85,120);
      $this->pdf->SetAlpha(1);
      // Arial bold 15
      $this->pdf->SetFont('Arial','B',12);
      //Enter
      $this->pdf->Ln(2);
      // Move to the right
      $this->pdf->Cell(80);
      // Title
      $this->pdf->Cell(30,65,'E-REGISTRASI KLIEN REHABILITASI RAWAT JALAN DI KLINIK PRATAMA',0,1,'C');
      $this->pdf->Cell(80);
      $this->pdf->Cell(30,-53,'BNN KABUPATEN SIDOARJO',0,1,'C');
      // Line break
      $this->pdf->Ln(40);
      $this->pdf->Line(15,55.1,200,55.1);
      $this->pdf->SetLineWidth(1);
      $this->pdf->SetFont('arial','',12);
      $this->pdf->Ln(3);
      // $this->pdf->SetXY(15,93);
      foreach ($data_find as $row) {
        $this->pdf->Cell(40,10,'INSTANSI PEMOHON',0,0,'C');
        $this->pdf->SetXY(75,66);
        $this->pdf->MultiCell(100,10,':     '.$row->instansi_pengaju,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(37,10,'NAMA TERSANGKA',0,0,'C');
        $this->pdf->SetXY(75,77);
        $this->pdf->MultiCell(100,10,':     '.$row->nama_tersangka,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(20,10,'No.KTP/NIK',0,0,'C');
        $this->pdf->SetXY(75,88);
        $this->pdf->MultiCell(100,10,':     '.$row->nik_ktp,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(31,10,'ALAMAT RUMAH',0,0,'C');
        $this->pdf->SetXY(75,99);
        $this->pdf->MultiCell(130,10,':     '.$row->alamat,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->SetXY(10,119);
        $this->pdf->Cell(51,10,'TANGGAL PENANGKAPAN',0,0,'C');
        $this->pdf->SetXY(75,119);
        $this->pdf->MultiCell(100,10,':     '.$this->date_penerjemah($row->tgl_penangkapan),0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(43,10,'TANGGAL SPRIN KAP.',0,0,'C');
        $this->pdf->SetXY(75,130);
        $this->pdf->MultiCell(100,10,':     '.$this->date_penerjemah($row->tgl_sprin_tangkap),0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(42,10,'TANGGAL SPRIN HAN',0,0,'C');
        $this->pdf->SetXY(75,141);
        $this->pdf->MultiCell(100,10,':     '.$this->date_penerjemah($row->tgl_sprin_tahan),0,'L',False);
        $this->pdf->Cell(28,6,'BARANG BUKTI',0,1,'C');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('Arial','B',9);
        $this->pdf->SetLineWidth(0.5);
        // $this->pdf->Cell();
        // $this->pdf->SetXY(75,152);
        $last = count($narkoba);
        $count = 0;
        $name_narkot = $row->barang_bukti;
        $name_narkot=explode(',',$name_narkot);
        $weight_narkot = $row->berat;
        $weight_narkot = explode(',',$weight_narkot);
        for ($i=0; $i < $last; $i++) {
          for ($j=0; $j < count($name_narkot) ; $j++) {
            if ($narkoba[$i] == $name_narkot[$j]) {
            $berat[]=$weight_narkot[$j];
            break;
          }else{
              if ($j == (count($name_narkot)-1)) {
                $berat[]='-';
              }
            }
          }
          if ($i == ($last-1)) {
            $this->pdf->Cell(0.1);
            $this->pdf->Cell(30,6,$narkoba[$i],1,1,'C');
          }else{
            $this->pdf->Cell(0.1);
            $this->pdf->Cell(30,6,$narkoba[$i],1,0,'C');
          }
        }
        $lberat = count($berat);
        $this->pdf->SetLineWidth(0.2);
        $this->pdf->SetFont('Arial','',9);
        for ($i=0; $i < $lberat; $i++) {
          if($i == ($lberat-1)){
            $this->pdf->Cell(0.1);
            $this->pdf->Cell(30,6,$berat[$i].' gram',1,1,'C');
          }else{
            $this->pdf->Cell(0.1);
            $this->pdf->Cell(30,6,$berat[$i].' gram',1,0,'C');}
        }
        $this->pdf->SetLineWidth(1);
        $this->pdf->SetFont('arial','',12);
        $this->pdf->Cell(32,10,'NAMA PENYIDIK',0,0,'C');
        $this->pdf->SetXY(75,171);
        $this->pdf->MultiCell(100,10,':     '.$row->nama_penyidik,0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->Cell(33,10,'NO HP PENYIDIK',0,0,'C');
        $this->pdf->SetXY(75,182);
        $this->pdf->MultiCell(100,10,':     '.$row->no_hp_penyidik,0,'L',False);
      }
      $this->pdf->Ln(8);
      $this->pdf->Cell(185,10,'Sidoarjo, .............................................]',0,1,'R');
      $this->pdf->Cell(185,8,'Klien Rehabilitasi Reguler Di Klinik Pratama',0,1,'R');
      $this->pdf->Cell(167,8,'BNN Kabupaten Sidoarjo',0,1,'R');
      $this->pdf->SetY(218);
      $this->pdf->Cell(80,8,'Petugas',0,1,'C');
      $this->pdf->Ln(10);
      $this->pdf->Cell(80,5,'..........................................',0,1,'C');
      $this->pdf->Cell(80,5,'(                                      )',0,1,'C');
      $this->pdf->SetXY(112,236);
      $this->pdf->Cell(80,5,'..........................................',0,1,'C');
      $this->pdf->SetX(112);
      $this->pdf->Cell(80,5,'(                                      )',0,1,'C');

      $dir_regist = "Documents/Rehab/TAT/".$this->reg_num;
      if (!file_exists($dir_regist)) {
        mkdir($dir_regist,777,true);
      }
      $this->date_pdf = date('d-m-Y');
      $path_file = $dir_regist."/".$this->date_pdf.'_'.$this->reg_num.".pdf";
      if(file_exists($path_file))
      {
        $return_data['STATUS_CODE']='00';
        $return_data['MESSAGE']='File exist';
        //unlink(public_path().'/'.$path_file);
        unlink($path_file);
      }else
      {
        $return_data['STATUS_CODE']='01';
        $return_data['MESSAGE']='File not found, Please tryagain';
      }
      $this->pdf->Output($dir_regist."/".$this->date_pdf.'_'.$this->reg_num.".pdf",'F');
      $path_fix = public_path().'/'.$path_file;
      return response()->file($path_file);
      // return $berat;
    }

    function skhpnPDF($reg)
    {
      $hari = '................';
      $tempat = '................';
      $data_find = klinikrehab::join('skhpn','skhpn.kode_registrasi','klinikrehab.kode_registrasi')->select('klinikrehab.*','skhpn.nama_lengkap','skhpn.gender','skhpn.alamat','skhpn.pekerjaan','skhpn.tanggal_lahir','skhpn.keperluan')->where('klinikrehab.kode_registrasi','=',$reg)->get();
      $this->reg_num = $reg;
      $this->pdf->AliasNbPages();
      $this->pdf->AddPage();
      $this->pdf->Image('assets/images/logo-bnn-terbaru.png',20,10,35,35);
      $this->pdf->SetAlpha(0.3);
      $this->pdf->Image('assets/images/logo-bnn-terbaru.png',30,85,150);
      $this->pdf->SetAlpha(1);
      // Arial bold 15
      $this->pdf->SetFont('Arial','B',16);
      //Enter
      $this->pdf->Ln(2);
      // Move to the right
      $this->pdf->Cell(80);
      // Title
      $this->pdf->SetXY(107,6);
      $this->pdf->Cell(30,19,'BADAN NARKOTIKA NASIONAL',0,0,'C');
      $this->pdf->SetXY(107,11);
      $this->pdf->Cell(30,19,'KABUPATEN SIDOARJO',0,0,'C');
      $this->pdf->SetFont('Arial','',12);
      $this->pdf->SetXY(107,18);
      $this->pdf->Cell(30,19,'Kantor : Jl.Perum Taman Pinang Blok AA 8 No.1A Sidoarjo',0,0,'C');
      $this->pdf->SetXY(107,23);
      $this->pdf->Cell(30,19,'Kode Pos 61213',0,0,'C');
      $this->pdf->SetXY(107,28);
      $this->pdf->Cell(30,19,'Telepon : 031-807972, Fax 51517765',0,0,'C');
      $this->pdf->SetXY(107,33);
      $this->pdf->Cell(30,19,'Email : bnnksidoarjo@yahoo.co.id Website :bnnsidoarjo.com',0,1,'C');

      // Line break
      $this->pdf->Ln(20);
      $this->pdf->SetLineWidth(1.5);
      $this->pdf->Line(15,48,200,48);
      $this->pdf->SetLineWidth(1);
      $this->pdf->SetFont('Arial','BU',12);
      $this->pdf->Ln(1);
      $this->pdf->SetXY(92,43);
      $this->pdf->Cell(30,19,'SURAT KETERANGAN HASIL PEMERIKASAAN NARKOTIKA',0,0,'C');
      $this->pdf->SetFont('Arial','U',12);
      foreach ($data_find as $row) {
        $hari = $row->medicalDate;
        $hari = $this->day_penerjemah($hari);
        $this->pdf->SetFont('Arial','',12);
        $this->pdf->SetXY(92,48);
        $this->pdf->Cell(30,20,$row->no_id,0,1,'C');
        $this->pdf->SetXY(10,63);
        $this->pdf->MultiCell(190,7,'Yang bertanda tangan dibawah ini menerangkan bahwa, pada hari '.$hari.' '.$row->medicalDate.' bertempat pada '.$row->medicalLocation.' atas dasar permintaan pribadi telah dilakukan pemeriksaan terhadap :',0,'L',False);
        $this->pdf->Ln(1);
        $this->pdf->SetXY(10,85);
        $this->pdf->Cell(36,6,'Nama Lengkap',0,0,'L');
        $this->pdf->Cell(15,6,':',0,0,'R');
        $this->pdf->SetXY(66,85);
        $this->pdf->Cell(100,6,$row->nama_lengkap,0,1,'L');
        $this->pdf->Cell(36,6,'Umur',0,0,'L');
        $this->pdf->Cell(15,6,':',0,0,'R');
        $this->pdf->SetXY(66,91);
        $this->pdf->Cell(80,6,$this->ageCount($row->tanggal_lahir).' Tahun',0,1,'L');
        $this->pdf->Cell(36,6,'Alamat',0,0,'L');
        $this->pdf->Cell(15,6,':',0,0,'R');
        $this->pdf->SetXY(66,97);
        $this->pdf->MultiCell(140,6,$row->alamat,0,'L',false);
        $this->pdf->Ln(1);
        $this->pdf->SetXY(10,109);
        $this->pdf->Cell(36,6,'Pekerjaan',0,0,'L');
        $this->pdf->Cell(15,6,':',0,0,'R');
        $this->pdf->SetXY(66,109);
        $this->pdf->Cell(80,6,$row->pekerjaan,0,1,'L');
        $this->pdf->Ln(2.5);
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(80,6,'A.	Hasil Wawancara Dan Pemeriksaan Fisik :',0,1,'L');
        $this->pdf->SetFont('Arial','',12);
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'1. Kesadaran',0,0,'L');
        $this->pdf->Cell(10,6,':',0,0,'R');
        $this->pdf->SetXY(66,124);
        if ($row->kesadaran == '1') {
          $chg = 'Baik';
        }else {
          $chg = 'Terganggu';
        }
        $this->pdf->Cell(80,6,$chg,0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'2.	Keadaan Umum',0,0,'L');
        $this->pdf->Cell(10,6,':',0,0,'R');
        $this->pdf->SetXY(66,130);
        if ($row->keadaan_umum == '1') {
          $chg = 'Baik';
        }else if($row->keadaan_umum == '2'){
          $chg = 'Cukup';
        }else {
          $chg = 'Kurang';
        }
        $this->pdf->Cell(80,6,$chg,0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'3.	Tekanan Darah',0,0,'L');
        $this->pdf->Cell(10,6,':',0,0,'R');
        $this->pdf->SetXY(66,136);
        $this->pdf->Cell(80,6,$row->tekananDarah.' mmHg',0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'4.	Nadi',0,0,'L');
        $this->pdf->Cell(10,6,':',0,0,'R');
        $this->pdf->SetXY(66,142);
        $this->pdf->Cell(80,6,$row->nadi.' x/menit',0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'5.	Pernafasan',0,0,'L');
        $this->pdf->Cell(10,6,':',0,0,'R');
        $this->pdf->SetXY(66,148);
        $this->pdf->Cell(80,6,$row->breath.' x/menit',0,1,'L');
        $this->pdf->Ln(2.5);
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(80,6,'B.	Riwayat Penggunaan Obat-obatan dalam seminggu terakhir:',0,1,'L');
        $this->pdf->SetFont('Arial','',12);
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'1.	Penggunaan Obat-obatan dalam seminggu ini :',0,0,'L');
        $this->pdf->SetXY(110,163);
        if ($row->medicineUse == '1') {
          $drugs = 'Ada';
          $jenis = $row->medicineType;
          $lastD = $row->lastDrink;
          if ($row->medicineFrom == '1') {
            $recipe = 'Resep Dokter';
          }else {
            $recipe = 'Jual Bebas';
          }
        }else {
          $drugs = 'Tidak Ada';
          $jenis = '-';
          $recipe = '-';
          $lastD = '....';
        }
        $this->pdf->Cell(80,6,$drugs,0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'2.	Jenis Obat yang digunakan :',0,0,'L');
        $this->pdf->SetXY(76,169);
        $this->pdf->Cell(80,6,$jenis,0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'3.	Asal Obat :',0,0,'L');
        $this->pdf->SetXY(45,175);
        $this->pdf->Cell(80,6,$recipe,0,1,'L');
        $this->pdf->SetX(15);
        $this->pdf->Cell(36,6,'4.	Terakhir minum :',0,0,'L');
        $this->pdf->SetXY(54,181);
        $this->pdf->Cell(80,6,$lastD.' hari yang lalu',0,1,'L');
        $this->pdf->Ln(2.5);
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(80,8,'C.	Pemerikasaan Urin dengan metode : Rapid Test (**)',0,1,'L');
        $this->pdf->SetFont('Arial','B',9);
        $this->pdf->SetLineWidth(0.7);
        $this->pdf->SetX(10);
        $this->pdf->Cell(32,6,'Amphetamine',1,0,'C');
        $this->pdf->Cell(32,6,'Methaphetamine',1,0,'C');
        $this->pdf->Cell(32,6,'Marijuana',1,0,'C');
        $this->pdf->Cell(32,6,'Morphin',1,0,'C');
        $this->pdf->Cell(32,6,'Benzodiazepine',1,0,'C');
        $this->pdf->Cell(32,6,'Cocaine',1,1,'C');
        $this->pdf->SetX(10);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->SetLineWidth(0.4);
        if ($row->rAmphetamine == '1' || $row->rMethaphetamine == '1' || $row->rTHC == '1' ||$row->rMorphin == '1' || $row->rBenzodiazepine == '1' || $row->rCocaine == '1') {
          $amp = 'Positif';$met = 'Positif';$thc = 'Positif';
          $mor = 'Positif';$ben = 'Positif';$coc = 'Positif';
        }else {
          $amp = 'Negatif';$met = 'Negatif';$thc = 'Negatif';
          $mor = 'Negatif';$ben = 'Negatif';$coc = 'Negatif';
        }
        $this->pdf->Cell(32,6,$amp,1,0,'C');
        $this->pdf->Cell(32,6,$met,1,0,'C');
        $this->pdf->Cell(32,6,$thc,1,0,'C');
        $this->pdf->Cell(32,6,$mor,1,0,'C');
        $this->pdf->Cell(32,6,$ben,1,0,'C');
        $this->pdf->Cell(32,6,$coc,1,1,'C');
        $this->pdf->SetFont('Arial','',12);
        $this->pdf->SetLineWidth(1);
        $this->pdf->Ln(3);
        if ($row->medicalResult == '1') {
          $result = 'Terindikasi';
        }else {
          $result = 'Tidak Terindikasi';
        }
        $this->pdf->SetX(10);
        $this->pdf->MultiCell(190,6,'Dapat disimpulkan bahwa yang terperiksa tersebut diatas '.$result.' mengkonsumsi Narkotika (**)',0,'L',false);
        $this->pdf->Ln(3);
        $this->pdf->SetX(10);
        $this->pdf->Cell(190,6,'Demikian Surat Keterangan Pemeriksaan Narkotika ini dibuat guna keperluan :',0,1,'L');
        $this->pdf->SetX(10);
        $this->pdf->Cell(190,6,$row->keperluan,0,1,'L');
      }


      $dir_regist = "Documents/tes urine/skhpn/".$this->reg_num;
      if (!file_exists($dir_regist)) {
        mkdir($dir_regist,777,true);
      }
      $this->date_pdf = date('d-m-Y');
      $path_file = $dir_regist."/".$this->date_pdf.'_'.$this->reg_num.".pdf";
      if(file_exists($path_file))
      {
        $return_data['STATUS_CODE']='00';
        $return_data['MESSAGE']='File exist';
        unlink(public_path().'/'.$path_file);
      }else
      {
        $return_data['STATUS_CODE']='01';
        $return_data['MESSAGE']='File not found, Please tryagain';
      }
      $this->pdf->Output($dir_regist."/".$this->date_pdf.'_'.$this->reg_num.".pdf",'F');
      $path_fix = public_path().'/'.$path_file;
      return response()->file(public_path().'/'.$path_file);
    }

    function ageCount($date)
    {
      //date in mm/dd/yyyy format; or it can be in other formats as well
      $birthDate = "12/17/1983";
      //explode the date to get month, day and year
      $birthDate = explode("-", $date);
      //get age from date or birthdate
      $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));
      return $age;
    }

    function day_penerjemah($day)
    {
      $temp = '';
      $datetime = strtotime($day);
      $temp = date('D', $datetime);
      if ($temp == 'Sun') {
        $day = 'Minggu';
      }elseif ($temp == 'Mon') {
        $day = 'Senin';
      }elseif ($temp == 'Tue') {
        $day = 'Selasa';
      }elseif ($temp == 'Wed') {
        $day = 'Rabu';
      }elseif ($temp == 'Thu') {
        $day = 'Kamis';
      }elseif ($temp == 'Fri') {
        $day = 'Jumat';
      }elseif ($temp == 'Sat') {
        $day = 'Sabtu';
      }
      return $day;
    }

    function date_penerjemah($tgl)
    {
      $tgl_fix = '';
      $bulan = '';
      $tgl = explode('-',$tgl);
      $tgl_fix = $tgl[0];
      if ($tgl[1] == 1) {
        $tgl_fix .= ' Januari';
      }elseif ($tgl[1] == 2) {
        $tgl_fix .= ' Februari';
      }elseif ($tgl[1] == 3) {
        $tgl_fix .= ' Maret';
      }elseif ($tgl[1] == 4) {
        $tgl_fix .= ' April';
      }elseif ($tgl[1] == 5) {
        $tgl_fix .= ' Mei';
      }elseif ($tgl[1] == 6) {
        $tgl_fix .= ' Juni';
      }elseif ($tgl[1] == 7) {
        $tgl_fix .= ' Juli';
      }elseif ($tgl[1] == 8) {
        $tgl_fix .= ' Agustus';
      }elseif ($tgl[1] == 9) {
        $tgl_fix .= ' September';
      }elseif ($tgl[1] == 10) {
        $tgl_fix .= ' Oktober';
      }elseif ($tgl[1] == 11) {
        $tgl_fix .= ' November';
      }elseif ($tgl[1] == 12) {
        $tgl_fix .= ' Desember';
      }
      $tgl_fix .= ' '.$tgl[2];
      return $tgl_fix;
    }

    function view()
    {
      $file = 'coba_rehab.pdf';
      $filename = 'coba_rehab.pdf';
      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="'.$filename.'"');
      header('Content-Transfer-Encoding: binary');
      header('Accept-Ranges:bytes');
      readfile($file);
    }
}
