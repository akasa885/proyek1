<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;

define('FHR',0.58);
define('PDFTABLE_VERSION','1.95');
class Pdftable extends Fpdf
{
  var $left;			//Toa do le trai cua trang
  var $right;			//Toa do le phai cua trang
  var $top;			//Toa do le tren cua trang
  var $bottom;		//Toa do le duoi cua trang
  var $width;			//Width of writable zone of page
  var $height;		//Height of writable zone of page
  var $defaultFontFamily ;
  var $defaultFontStyle;
  var $defaultFontSize;
  var $isNotYetSetFont;
  var $headerTable, $footerTable;
  var $paddingCell = 1; //(mm)
  var $paddingCell2 = 2; //2*$paddingCell
  var $spacingLine = 0; //(mm)
  var $spacingParagraph = 0; //(mm)
  protected $B = 0;
  protected $I = 0;
  protected $U = 0;
  protected $HREF = '';

  private function _makePageSize(){
  	$this->left		= $this->lMargin;
  	$this->right	= $this->w - $this->rMargin;
  	$this->top		= $this->tMargin;
  	$this->bottom	= $this->h - $this->bMargin;
  	$this->width	= $this->right - $this->left;
  	$this->height	= $this->bottom - $this->tMargin;
  }
  
  function WriteHTML($html)
  {
  	// HTML parser
  	$html = str_replace("\n",' ',$html);
  	$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
  	foreach($a as $i=>$e)
  	{
  		if($i%2==0)
  		{
  			// Text
  			if($this->HREF)
  				$this->PutLink($this->HREF,$e);
  			else
  				$this->Write(5,$e);
  		}
  		else
  		{
  			// Tag
  			if($e[0]=='/')
  				$this->CloseTag(strtoupper(substr($e,1)));
  			else
  			{
  				// Extract attributes
  				$a2 = explode(' ',$e);
  				$tag = strtoupper(array_shift($a2));
  				$attr = array();
  				foreach($a2 as $v)
  				{
  					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
  						$attr[strtoupper($a3[1])] = $a3[2];
  				}
  				$this->OpenTag($tag,$attr);
  			}
  		}
  	}
  }
  function OpenTag($tag, $attr)
  {
  	// Opening tag
  	if($tag=='B' || $tag=='I' || $tag=='U')
  		$this->SetStyle($tag,true);
  	if($tag=='A')
  		$this->HREF = $attr['HREF'];
  	if($tag=='BR')
  		$this->Ln(5);
  }
  function CloseTag($tag)
  {
  	// Closing tag
  	if($tag=='B' || $tag=='I' || $tag=='U')
  		$this->SetStyle($tag,false);
  	if($tag=='A')
  		$this->HREF = '';
  }
  function SetStyle($tag, $enable)
  {
  	// Modify style and select corresponding font
  	$this->$tag += ($enable ? 1 : -1);
  	$style = '';
  	foreach(array('B', 'I', 'U') as $s)
  	{
  		if($this->$s>0)
  			$style .= $s;
  	}
  	$this->SetFont('',$style);
  }
  function PutLink($URL, $txt)
  {
  	// Put a hyperlink
  	$this->SetTextColor(0,0,255);
  	$this->SetStyle('U',true);
  	$this->Write(5,$txt,$URL);
  	$this->SetStyle('U',false);
  	$this->SetTextColor(0);
  }
}
