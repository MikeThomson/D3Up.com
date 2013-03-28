<?php

class D3Up_Signature {
	private $_build = null;
	public function __construct(D3Up_Build $build) {
		$this->_build = $build;
		// Set the Background Image, currently defaults to whatever your class is. This can be customized and more can be added.
		$this->setBackground($build->class);
		// Generate the Build Name
		$this->addText($build->name, 30, 5, 29, "#000");	// Simulated Shadow
		$this->addText($build->name, 30, 6, 31, "#000");	// Simulated Shadow
		$this->addText($build->name, 30, 7, 32, "#000");	// Simulated Shadow
		$this->addText($build->name, 30, 5, 30, "#70B1D5");	// Insert Build Name
		// Add the Level Information
		$levelText = "Level: ".$build->level;
		if($build->paragon) {
			$levelText = "Paragon: ".$build->paragon;
		}
		$this->addShadowText($levelText, 12, 15, 55, "#fff", 'sans');	// Insert Build Name
		imagefilledrectangle($this->_image, 0, 65, 450, 450, imagecolorallocatealpha($this->_image, 0, 0, 0, 50));
		// Add Skill Icons
		if($build->actives) {
			foreach($build->actives as $idx => $skill) {
				$icon = explode("~", $skill)[0];
				$image = imagecreatefrompng(path('app').'../public/img/icons/'.$build->class.'-'.$icon.'.png');
				// Copy and merge
				imagecopyresized($this->_image, $image, (10 + (30 * $idx)), 68, 0, 0, 28, 28, 64, 64);
			}			
		}
		if($build->passives) {
			foreach($build->passives as $idx => $skill) {
				$icon = explode("~", $skill)[0];
				$image = imagecreatefrompng(path('app').'../public/img/icons/'.$build->class.'-'.$icon.'.png');
				// Copy and merge
				imagecopyresized($this->_image, $image, (200 + (30 * $idx)), 68, 0, 0, 28, 28, 64, 64);
			}			
		}
		if(isset($build->stats['dps'])) {
			$this->addShadowText("DPS: ".HTML::prettyStat($build->stats['dps'],2), 10, 370, 80, "#fff", 'sans');	// Insert Build Name			
		}
		if(isset($build->stats['ehp'])) {
			$this->addShadowText("EHP: ".HTML::prettyStat($build->stats['ehp'],2), 10, 370, 94, "#fff", 'sans');	// Insert Build Name			
		}
		$this->addShadowText("d3up.com", 10, 385, 14, "#fff", 'sans', 'right');
		// Sample Generate for Debugging
		header("Content-type: image/png");
		ob_start();
		imagejpeg($this->_image, null, 80);
		$image_data = ob_get_contents();
		ob_end_clean();
		S3::put_object($image_data, 'sigs.d3up.com', 'b/'.$build->id.'.jpg', S3::ACL_PUBLIC_READ);		
		imagedestroy($this->_image);
	}
	
	public function addShadowText($text, $size, $x, $y, $hex = "#fff", $font = "d3", $align = null) {
		$this->addText($text, $size, $x-1, $y-1, "#000", $font, $align);
		$this->addText($text, $size, $x+1, $y+1, "#000", $font, $align);
		$this->addText($text, $size, $x+2, $y+2, "#000", $font, $align);
		$this->addText($text, $size, $x, $y, $hex, $font, $align);
	}
	 
	public function addText($text, $size, $x, $y, $hex = "#fff", $font = "d3", $align = null) {
		$color = $this->hex2rgb($hex);
		if($align == 'right') {
			$dimensions = imagettfbbox($size, 0, path('app') . "signatures/fonts/".$font.".ttf", $text);
			$textWidth = abs($dimensions[4] - $dimensions[0]);
			$x = imagesx($this->_image) - $textWidth - 10;			
			// var_dump($x, $textWidth, imagesx($this->_image)); exit;
		}
		
		imagettftext(
			$this->_image, 
			$size, 
			0, 
			$x, 
			$y, 
			imagecolorallocate($this->_image, $color[0], $color[1], $color[2]),
			path('app') . "signatures/fonts/".$font.".ttf",
			$text
		);
	}

	private $_image = null;
	public function setBackground($filename) {
		$this->_image = imagecreatefromjpeg(path('app') . "signatures/".$filename.".jpeg");
	}
	
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}

// $string = $build->name;
// $im     = imagecreatefromjpeg(path('app') . "signatures/wizard.jpeg");
// $orange = imagecolorallocate($im, 220, 210, 60);
// $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
