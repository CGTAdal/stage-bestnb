<?php
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
   
   var $image;
   var $image_type;
 
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   }    
   
   
}

  

function MergeImage($backgroundfilename,$memberfilename,$x,$y,$width,$height) 
{
		// This function takes the $main image and then merges the $sec image onto it at the position $x,$y
	// with a transaparency of $transparency
	imagecopy($backgroundfilename, $memberfilename, $x, $y, 0, 0, $width, $height);
	//imagecopymerge($main,$sec,$x,$y,0,0,imagesx($sec),imagesy($sec),$transparency);
	 return $backgroundfilename;
}


function WriteTextOnImage($img,$x,$y,$text,$font,$size,$red,$green,$blue) 
{
	// This function writes $text onto the image at $x,$y in the font $font with a $size
	$colour = imagecolorallocate($img, $red, $green, $blue);
	imagettftext($img,$size,0,$x,$y,$colour,$font,$text);
	return $img;
}

function SaveImage($imgs,$newfilename,$type) {
	// This function either saves the image to $newfilename, or if $newfilename is blank, then sends it to the browser
	// $type can be PNG, GIF, WBMP, JPEG
	if (trim($newfilename)=='') {
		// Output the header type to the browser
		switch (strtoupper($type)) {
			case 'PNG':
				header("Content-type: " . image_type_to_mime_type(IMAGETYPE_PNG));
				imagepng($imgs);
				break;
			case 'GIF':
				header("Content-type: " . image_type_to_mime_type(IMAGETYPE_GIF));
				imagegif($imgs);
				break;
			case 'WBMP':
				header("Content-type: " . image_type_to_mime_type(IMAGETYPE_WBMP));
				imagewbmp($imgs);
				break;
			case 'JPEG':
				header("Content-type: " . image_type_to_mime_type(IMAGETYPE_JPEG));
				imagejpeg($imgs);
				break;
			default:
				print '<p>Invalid image type passed to SaveImage</p>';
				die();
		}
	}
	else {
		// We need to put it to a file
		switch (strtoupper($type)) {
			case 'PNG':
				imagepng($imgs,$newfilename);
				break;
			case 'GIF':
				imagegif($imgs,$newfilename);
				break;
			case 'WBMP':
				imagewbmp($imgs,$newfilename);
				break;
			case 'JPEG':
				imagejpeg($imgs,$newfilename);
				break;
			default:
				print '<p>Invalid image type passed to SaveImage</p>';
				die();
		}
	}
}

function LoadImage($filename) {
	$imgtype = '';
	switch (exif_imagetype($filename)) {
		case IMAGETYPE_GIF:
			$imgtype='GIF';
			break;
		case IMAGETYPE_JPEG:
			$imgtype='JPG';
			break;
		case IMAGETYPE_PNG:
			$imgtype='PNG';
			break;
		case IMAGETYPE_WBMP:
			$imgtype='WBMP';
			break;
		default:
			break;
	}
	
	if ($imgtype=='') {
		print '<p>Invalid image file passed to LoadImage</p>';
		die(); 
	}

	switch ($imgtype) {
		case 'GIF':
			$img  = imagecreatefromgif($filename);
			break;
		case 'JPG':
			$img  = imagecreatefromjpeg($filename);
			break;
		case 'PNG':
			$img  = imagecreatefrompng($filename);
			break;
		case 'WBMP':
			$img  = imagecreatefromwbmp($filename);
			break;
		default:
			print '<p>Invalid image type passed to LoadImage</p>';
			die(); 
			break;
	}

	return  $img;
	imagedestroy($img);
}
?>