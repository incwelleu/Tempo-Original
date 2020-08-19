<?php
require_once('fpdf/fpdf.php');
require_once('fpdi/fpdi.php');

//define('FPDF_FONTPATH', 'font/');

//function hex2dec
//returns an associative array (keys: R, G, B) from
//a hex html code (e.g. #3FE5AA)
function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['G']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter in 72 dpi
function px2mm($px){
    return $px*25.4/72;
}

function txtentities($html){
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}
////////////////////////////////////

class PDF extends FPDF
{
   //variables of html parser
   var $B;
   var $I;
   var $U;
   var $HREF;
   var $fontList;
   var $issetfont;
   var $issetcolor;

   function PDF($orientation = 'P', $unit = 'mm', $format = 'A4')
   {
      //Call parent constructor
      $this->FPDF($orientation, $unit, $format);
      //Initialization
      $this->B = 0;
      $this->I = 0;
      $this->U = 0;
      $this->HREF = '';
      $this->fontlist = array("arial", "times", "courier", "helvetica", "symbol");
      $this->issetfont = false;
      $this->issetcolor = false;
   }

   // Cabecera de página
   function Header()
   {
      // Logo
      $this->Cell(75);
      $this->Image('images/logo.png');

      // Arial bold 15
      $this->SetFont('Arial', 'I', 6);
      // Movernos a la derecha
	
      $this->Cell(40, 3, 'This document is for client use only.  Redistribution prohibited.', 0, 0, 'C');

      // Salto de línea
      $this->Ln(5);
   }

   // Pie de página
   function Footer()
   {
      /* ts 7-2016: remove footer
      // Posición: a 1,5 cm del final
      $this->SetY(-18);
      $this->SetDrawColor(79, 129, 189);
      $col = 20;
      $ln = $this->GetY();
      $this->Line($col, $ln, $col + 170, $ln);

      // Arial italic 8
      $this->SetY($ln + 3);
      $this->SetFont('Arial', '', 6);
      $this->SetTextColor(128, 128, 128);
      $this->MultiCell(65, 3, 'BARCELONA:', 0, 'C');
      $this->SetTextColor(79, 129, 189);
      $this->MultiCell(65, 3, 'Aribau 175, 3 2B', 0, 'C');
      $this->MultiCell(65, 3, '08006 Barcelona, Spain', 0, 'C');

      $this->SetXY($col + 50, $ln + 3);
      $this->SetTextColor(128, 128, 128);
      $this->MultiCell(65, 3, 'MADRID:', 0, 'C');
      $this->SetX($col + 50);
      $this->SetTextColor(79, 129, 189);
      $this->MultiCell(65, 3, 'General Perón 19, bajo', 0, 'C');
      $this->SetX($col + 50);
      $this->MultiCell(65, 3, '28020 Madrid, Spain', 0, 'C');

      $this->SetXY($col + 110, $ln + 3);
      $this->SetTextColor(128, 128, 128);
      $this->MultiCell(65, 3, 'TENERIFE:', 0, 'C');
      $this->SetX($col + 110);
      $this->SetTextColor(79, 129, 189);
      $this->MultiCell(65, 3, 'Plaza 25 de Julio 4, 1D', 0, 'C');
      $this->SetX($col + 110);
      $this->MultiCell(65, 3, '38004 Santa Cruz, Spain', 0, 'C');

      $this->Ln();
      $this->SetTextColor(0, 0, 0);
      // Número de página
      // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      */
   }


   //////////////////////////////////////
   //html parser
   function WriteHTML($x, $y, $html)
   {
    	$this->SetXY($x, $y);
      $html = strip_tags($html, "<br><b><u><i><a><img><p><strong><em><font><tr><blockquote>");//remove all unsupported tags
      $html = str_replace("\n", ' ', $html);//replace carriage returns by spaces
      $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);//explodes the string
      foreach($a as $i=>$e)
      {
         if($i % 2 == 0)
         {
            //Text
            if($this->HREF)
               $this->PutLink($this->HREF, $e);
            else
               $this->Write(4, stripslashes(txtentities($e)));
         }
         else
         {
            //Tag
            if($e{0} == '/')
               $this->CloseTag(strtoupper(substr($e, 1)));
            else
            {
               //Extract attributes
               $a2 = explode(' ', $e);
               $tag = strtoupper(array_shift($a2));
               $attr = array();
               foreach($a2 as $v){
                  if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$', $v, $a3))
                     $attr[strtoupper($a3[1])] = $a3[2];
               }
               $this->OpenTag($tag, $attr);
            }
         }
      }
   }

   function OpenTag($tag, $attr)
   {
      //Opening tag
      switch($tag)
      {
         case 'STRONG':
            $this->SetStyle('B', true);
            break;
         case 'EM':
            $this->SetStyle('I', true);
            break;
         case 'B':
         case 'I':
         case 'U':
            $this->SetStyle($tag, true);
            break;
         case 'A':
            $this->HREF = $attr['HREF'];
            break;
         case 'IMG':
            if(isset($attr['SRC']) and (isset($attr['WIDTH']) or isset($attr['HEIGHT'])))
            {
               if( ! isset($attr['WIDTH']))
                  $attr['WIDTH'] = 0;
               if( ! isset($attr['HEIGHT']))
                  $attr['HEIGHT'] = 0;
               $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
            }
            break;
         case 'TR':
         case 'BLOCKQUOTE':
         case 'BR':
            $this->Ln(4);
            break;
         case 'P':
            $this->Ln(4);
            break;
         case 'FONT':
            if(isset($attr['COLOR']) and $attr['COLOR'] != '')
            {
               $coul = hex2dec($attr['COLOR']);
               $this->SetTextColor($coul['R'], $coul['G'], $coul['B']);
               $this->issetcolor = true;
            }
            if(isset($attr['FACE']) and in_array(strtolower($attr['FACE']), $this->fontlist))
            {
               $this->SetFont(strtolower($attr['FACE']));
               $this->issetfont = true;
            }
            break;
      }
   }

   function CloseTag($tag)
   {
      //Closing tag
      if($tag == 'STRONG')
         $tag = 'B';
      if($tag == 'EM')
         $tag = 'I';
      if($tag == 'B' or $tag == 'I' or $tag == 'U')
         $this->SetStyle($tag, false);
      if($tag == 'A')
         $this->HREF = '';
      if($tag == 'FONT')
      {
         if($this->issetcolor == true)
         {
            $this->SetTextColor(0);
         }
         if($this->issetfont)
         {
            $this->SetFont('arial');
            $this->issetfont = false;
         }
      }
   }

   function SetStyle($tag, $enable)
   {
      //Modify style and select corresponding font
      $this->$tag += ($enable? 1: -1);
      $style = '';
      foreach(array('B', 'I', 'U') as $s)
         if($this->$s > 0)
            $style .= $s;
      $this->SetFont('', $style);
   }

   function PutLink($URL, $txt)
   {
      //Put a hyperlink
      $this->SetTextColor(0, 0, 255);
      $this->SetStyle('U', true);
      $this->Write(5, $txt, $URL);
      $this->SetStyle('U', false);
      $this->SetTextColor(0);
   }


}//end of class

class concat_pdf extends FPDI {

  var $files = array();

  function setFiles($files) {
    $this->files = $files;
  }

  function concatFiles() {
    foreach($this->files AS $file) {
      $pagecount = $this->setSourceFile($file);
      for ($i = 1; $i <= $pagecount; $i++) {
        $tplidx = $this->ImportPage($i);
        $s = $this->getTemplatesize($tplidx);
        $this->AddPage('P', array($s['w'], $s['h']));
        $this->useTemplate($tplidx);
      }
    }
  }
}

?>