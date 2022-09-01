<?php
/* 
* Author: onlinecode.org  
* start Pdf.php file 
* Location: ./application/libraries/Pdf.php 
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

    //Page header
    public function Header() {
        // Logo
        $image_file = 'http://localhost/brainsparkApi/public/uploads/institute1.png';
        $st_image ='http://localhost/brainsparkApi/public/uploads/230_aadharcard_1594376092.jpg';
        $content = '<h1>St. Xaviers Collegiate School</h1><p>30, Park St, Mullick Bazar, Park Street area, Kolkata, West Bengal 700016</p>
          <p>Phone: 033 987654321 , 033 321654987</p>
          <p>Email: school@schoolname.com</p>
          <p>Website: schoolname.com</p>';
        $this->Image($image_file, 15, 10, 30, '', 'PNG', '', 'T', false, 400, '', false, false, 0, false, false, false);
        //$this->writeHTML($content, true, false, true, false, 'J');

        // Set font
        //$this->SetFont('helvetica', 'B', 20);
        // Title
        $this->SetLeftMargin(50);
        $this->writeHTML($content, true, false, true, false, 'J');
        //$this->SetFont('helvetica', 'P', 13);
        //$this->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
        $this->Image($st_image, 170, 15, 25, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);

    }

     public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        // Setting Date ( I have set the date here )
        $tDate=date('l \t\h\e jS');
        $this->Cell(0, 10, 'Date : '.$tDate, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function changeTheDefault($tcpdflink) {
            $this->tcpdflink = $tcpdflink;
          }
}


/* end Pdf.php file */