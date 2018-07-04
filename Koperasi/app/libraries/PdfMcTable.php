<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);

require_once 'fpdf.php';

class PdfMcTable extends FPDF
{
	var $widths;
	var $aligns;
	var $draft;
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data, $showBorder)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			if ($showBorder)
				$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}

	function Header()
	{
		
	}

//Page footer
	function Footer()
	{
		
	}
	
	
	//tambahan yusuf
	function writeRotie($x,$y,$txt,$text_angle,$font_angle = 0)
	{
		if ($x < 0) {
		$x += $this->w;
		}
		if ($y < 0) {
		$y += $this->h;
		}
		
		/* Escape text. */
		$text = $this->_escape($txt);
		
		$font_angle += 90 + $text_angle;
		$text_angle *= M_PI / 180;
		$font_angle *= M_PI / 180;
		
		$text_dx = cos($text_angle);
		$text_dy = sin($text_angle);
		$font_dx = cos($font_angle);
		$font_dy = sin($font_angle);
		
		$s= sprintf('BT %.2f %.2f %.2f %.2f %.2f %.2f Tm (%s) Tj ET', $text_dx, $text_dy, $font_dx, $font_dy,$x * $this->k, ($this->h-$y) * $this->k, $text);
		if($this->underline && $txt!='')
		$s.=' '.$this->_dounderline($x,$y,$txt);
		if($this->ColorFlag)
		$s='q '.$this->TextColor.' '.$s.' Q';
		$this->_out($s);
	}

}
?>
