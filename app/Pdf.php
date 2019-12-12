<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use App\Pdftable;

class Pdf extends Pdftable
{
  // function PDF()
  // {
  //   $this->AddFont('vni_times');
  //   $this->SetAuthor('Badan Narkotika Nasional');
  // }
  // function setStyle($style='normal'){
  // 	switch ($style){
  // 		case 'title':
  // 			$this->SetFont('vni_times','',19);
  // 			break;
  // 		case 'small':
  // 			$this->SetFont('vni_times','',8);
  // 			break;
  // 		case 'normal':
  // 		default:
  // 			$this->SetFont('vni_times','',12);
  // 	}
  // }
  function Header () {
    // Logo
    // $this->Image('assets/images/logo-bnn-terbaru.png',88,10,35,35);
    // // Arial bold 15
    // $this->SetFont('Arial','B',12);
    // //Enter
    // $this->Ln(9);
    // // Move to the right
    // $this->Cell(80);
    // // Title
    // $this->Cell(30,70,'E-REGISTRASI KLIEN REHABILITASI RAWAT JALAN DI KLINIK PRATAMA',0,0,'C');
    // // Line break
    // $this->Ln(20);
  }

  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }

  protected $extgstates = array();

   // alpha: real value from 0 (transparent) to 1 (opaque)
   // bm:    blend mode, one of the following:
   //          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
   //          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
   function SetAlpha($alpha, $bm='Normal')
   {
       // set alpha for stroking (CA) and non-stroking (ca) operations
       $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
       $this->SetExtGState($gs);
   }

   function AddExtGState($parms)
   {
       $n = count($this->extgstates)+1;
       $this->extgstates[$n]['parms'] = $parms;
       return $n;
   }

   function SetExtGState($gs)
   {
       $this->_out(sprintf('/GS%d gs', $gs));
   }

   function _enddoc()
   {
       if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
           $this->PDFVersion='1.4';
       parent::_enddoc();
   }

   function _putextgstates()
   {
       for ($i = 1; $i <= count($this->extgstates); $i++)
       {
           $this->_newobj();
           $this->extgstates[$i]['n'] = $this->n;
           $this->_put('<</Type /ExtGState');
           $parms = $this->extgstates[$i]['parms'];
           $this->_put(sprintf('/ca %.3F', $parms['ca']));
           $this->_put(sprintf('/CA %.3F', $parms['CA']));
           $this->_put('/BM '.$parms['BM']);
           $this->_put('>>');
           $this->_put('endobj');
       }
   }

   function _putresourcedict()
   {
       parent::_putresourcedict();
       $this->_put('/ExtGState <<');
       foreach($this->extgstates as $k=>$extgstate)
           $this->_put('/GS'.$k.' '.$extgstate['n'].' 0 R');
       $this->_put('>>');
   }

   function _putresources()
   {
       $this->_putextgstates();
       parent::_putresources();
   }
}
