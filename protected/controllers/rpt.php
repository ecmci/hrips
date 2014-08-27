<?php

$pdfname=date('YmdHis');
		require_once('/../extensions/tcpdf/tcpdf.php');
		$outputPdf = new TCPDF();
       	$outputPdf->setCreator('Eva Care Management Consultancy Inc');
	    $outputPdf->setAuthor('ECMCI');
	    $outputPdf->setTitle('Manila Action List');
        $outputPdf->setSubject('Action List');
	    $outputPdf->setKeywords('');
        $outputPdf->setHeaderData('', 0, 'Manila Action List', '');
	    $outputPdf->setHeaderFont(array('helvetica', '', 9));
        $outputPdf->setFooterFont(array('helvetica', '', 6));
	    $outputPdf->setMargins(15, 18, 15);
        $outputPdf->setHeaderMargin(5);
	    $outputPdf->setFooterMargin(10);
        //$outputPdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);
	    $outputPdf->setFont('helvetica', '', 8);
		$outputPdf->setPageOrientation('L');
		
		$styling='<style type="text/css">
				table { page-break-inside:auto }
				tr    { page-break-inside:avoid; page-break-after:auto }
				thead { display:table-header-group }
				tfoot { display:table-footer-group }
				</style>';
		
		/* $htmlOutput='helloooo';
		$htmlOutput=$htmlOutput.' hiiii';
		 */
		$htmlOutput=$_POST['myForm']['chkEmpID'];
		$outputPdf->AddPage();
		$outputPdf->writeHTML($htmlOutput, true, false, true, false, '');
		$outputPdf->Output(trim('owen') . '.pdf', 'I');


?>