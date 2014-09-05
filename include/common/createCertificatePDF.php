<?php

//$obj = new createPDF();
//$obj->createCertificatePDF('1363758635.jpg');


class createPDF
{
	public function __construct() {

	}
	
	public function createCertificatePDF($imagepath)
	{
		//$img = new createImage();
		//$img ->createCertificateImage($name,$regno,$font_name,$font_size_name,$font_reg,$font_size_reg);
		$html = "<img src='$imagepath'>";
		require_once('MPDF56/mpdf.php');
	 
		$mpdf = new mPDF();
		 
		$mpdf->WriteHTML($html);
	    $imagepathPDF = substr($imagepath,0,strpos($imagepath,'.jpg')).'.pdf'; 
		$mpdf->Output($imagepathPDF);
		unlink($imagepath);
		exit;
	}
}

?>

