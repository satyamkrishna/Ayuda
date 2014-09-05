<?php

//$obj = new createImage();
//$obj->createCertificateImage('Rajul Bhatnagar', '1234',time().'.jpg');

class createImage
{
	private $timestampVal;
	public $filename;
	// Constructor
	public function __construct() {

	}
	
	public function createCertificateImage($name,$regno,$filename,$font_name="../../../resources/fonts/times.ttf",$font_size_name=14,$font_reg="../../../resources/fonts/timesi.ttf",$font_size_reg=16)
	{
		//PHP's GD class functions can create a variety of output image
		//types, this example creates a jpeg
		//header("Content-Type: image/jpeg");
		
		
		//open up the image you want to put text over
		$im = imagecreatefromjpeg("../../../resources/images/common/AyudaCertificate.jpg"); 
		
		
		//The numbers are the RGB values of the color you want to use
		$black = ImageColorAllocate($im, 0, 0, 0);
		
		//The canvas's (0,0) position is the upper left corner
		//So this is how far down and to the right the text should start
		$start_x_name = 442;
		$start_y_name = 282;
		$start_x_reg = 146;
		$start_y_reg = 90;
		
		//This writes your text on the image in 12 point using verdana.ttf
		//For the type of effects you quoted, you'll want to use a truetype font
		//And not one of GD's built in fonts. Just upload the ttf file from your
		//c: windows fonts directory to your web server to use it.
		Imagettftext($im, $font_size_reg, 0, $start_x_name, $start_y_name, $black, $font_reg, $name);
		Imagettftext($im, $font_size_reg, 0, $start_x_reg, $start_y_reg, $black, $font_reg, $regno);
		
		//$this->$timestampVal=time();
		//$this->$filename = $this->$timestampVal.'.jpg';
		//Creates the jpeg image and sends it to the browser
		//100 is the jpeg quality percentage
		Imagejpeg($im, $filename, 100);
		echo 'Done';
		ImageDestroy($im); 
	}
	
	
}


?> 