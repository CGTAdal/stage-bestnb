<?php
// This file contains several functions used to manipulate images
function imageCreateTransparent($x, $y) { 
    $imageOut = imagecreate($x, $y);
    $colourBlack = imagecolorallocate($imageOut, 0, 0, 0);
    imagecolortransparent($imageOut, $colourBlack);
    return $imageOut;
} 

function LoadImage($filename,$width,$height) {
	// This function loads an image and returns it to the caller. It is a wrapper for the GD class,
	// and first determines what file type it is, and then uses the correct load image function.
	// This script only supports GIF, JPG, PNG and WBMP
	// if either $width and $height are 0, then no resizing is done, otherwise, the image is resized
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
	// If $imgtype is still blank, then we do not have a valid image file to work with
	// so we will must die at this point
	if ($imgtype=='') {
		print '<p>Invalid image file passed to LoadImage</p>';
		die(); 
	}
	// Now we can create the image using the correct function for the image type
	switch ($imgtype) {
		case 'GIF':
			$img  = @imagecreatefromgif($filename);
			break;
		case 'JPG':
			$img  = @imagecreatefromjpeg($filename);
			break;
		case 'PNG':
			@header('Content-Type: image/png');
			$img  = @imagecreatefrompng($filename);
			break;
		case 'WBMP':
			$img  = @imagecreatefromwbmp($filename);
			break;
		default:
			print '<p>Invalid image type passed to LoadImage</p>';
			die(); 
			break;
	}
	// Now lets see if we must resize the image
	if ($width > 0 and $height>0) {
		// We need to resize the image. This is done proportionally
 		// Get new dimensions
		list($width_orig, $height_orig) = getimagesize($filename);
		if ($width && ($width_orig < $height_orig)) {
    	$width = ($height / $height_orig) * $width_orig;
		} 
		else {
    	$height = ($width / $width_orig) * $height_orig;
		}
		// Resample
		$image_p = ImageCreateTrueColor($width, $height);
		$image_p = imageCreateTransparent($width, $height);
		
		// for test
		//$new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
	   
		/*$arr = split("\.",$filename);
		$ext = $arr[count($arr)-1];
		if($ext=="png") {
			imagealphablending($new_img, false);
			$colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);
			imagefill($new_img, 0, 0, $colorTransparent);
			imagesavealpha($new_img, true);
		} elseif($ext=="gif") {
			$trnprt_indx = imagecolortransparent($img);
			if ($trnprt_indx >= 0) {
				//its transparent
				$trnprt_color = imagecolorsforindex($img, $trnprt_indx);
				$trnprt_indx = imagecolorallocate($new_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				imagefill($new_img, 0, 0, $trnprt_indx);
				imagecolortransparent($new_img, $trnprt_indx);
			}
		}
		*/
		
		//
		
		
		imagecopyresampled($image_p, $img, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

		imagedestroy($img);
		$img = $image_p;
	}
	// So now we have loaded the image into memory, so return it back to the caller
	return  $img;
	imagedestroy($image_p);
	imagedestroy($img);
}
function MergeImage ($main,$sec,$x,$y,$width, $height) {
	// This function takes the $main image and then merges the $sec image onto it at the position $x,$y
	// with a transaparency of $transparency
	imagecopy($main, $sec, $x, $y, 0, 0, $width, $height);
	//imagecopymerge($main,$sec,$x,$y,0,0,imagesx($sec),imagesy($sec),$transparency);
	return $main;
}

function watermark($sourcefile, $watermarkfile, $x, $y, $h, $w) {
  
    #
    # $sourcefile = Filename of the picture to be watermarked.
    # $watermarkfile = Filename of the 24-bit PNG watermark file.
    #
    
    //Get the resource ids of the pictures
	$fileType1 = strtolower(substr($watermarkfile, strlen($watermarkfile)-3));

    //$watermarkfile_id = imagecreatefrompng($watermarkfile);
   
    switch($fileType1) {
        case('gif'):
            $watermarkfile_id = imagecreatefromgif($watermarkfile);
			$watermarkfile_width=imageSX($watermarkfile_id);
  			$watermarkfile_height=imageSY($watermarkfile_id);
			$tempimage = imagecreatetruecolor($watermarkfile_width,$watermarkfile_height);
        
        	// copy the 8-bit gif into the truecolor image
      		imagecopy($tempimage, $watermarkfile_id, 0, 0, 0, 0, $watermarkfile_width, $watermarkfile_height);
        
        	// copy the source_id int
       		$watermarkfile_id = $tempimage;
            break;
            
        case('png'):
            $watermarkfile_id = imagecreatefrompng($watermarkfile);
            break;
            
        default:
            $watermarkfile_id = imagecreatefromjpeg($watermarkfile);
    }
	
    imageAlphaBlending($watermarkfile_id, false);
    imageSaveAlpha($watermarkfile_id, true);

    $fileType = strtolower(substr($sourcefile, strlen($sourcefile)-3));

    switch($fileType) {
        case('gif'):
            $sourcefile_id = imagecreatefromgif($sourcefile);
            break;
            
        case('png'):
            $sourcefile_id = imagecreatefrompng($sourcefile);
            break;
            
        default:
            $sourcefile_id = imagecreatefromjpeg($sourcefile);
    }

    //Get the sizes of both pix   
  $sourcefile_width=imageSX($sourcefile_id);
  $sourcefile_height=imageSY($sourcefile_id);
  $watermarkfile_width=imageSX($watermarkfile_id);
  $watermarkfile_height=imageSY($watermarkfile_id);
  

    $dest_x = $x;
    $dest_y = $y;
    
   
	list($width_orig, $height_orig) = getimagesize($watermarkfile);
	
	if ($w && ($width_orig < $height_orig)) {
    	$w = ($h / $height_orig) * $width_orig;
	} else {
    	$h = ($w / $width_orig) * $height_orig;
	}
	//$watermark = imagecreatetruecolor($w, $h);
	//imageAlphaBlending($watermark, false);
    //imageSaveAlpha($watermark, true);
	imagecopyresampled($watermarkfile_id, $watermarkfile_id, $dest_x, $dest_y, 0, 0, $w, $h, $watermarkfile_width, $watermarkfile_height);
	$date = getdate();
	srand ((double) microtime( )*1000000);
	$random_number = rand(1000000000,9999999999);
	
	 switch($fileType1) {
        case('gif'):
			$memberfilename = "../logos/".$date[0].$random_number."TEMP.gif";
            imagegif($watermarkfile_id,$memberfilename);
			$img2  = imagecreatefromgif($memberfilename);
			//$watermark = imagecreatetruecolor($w, $h);
			MergeImage($sourcefile_id,$img2,$dest_x,$dest_y,100);
            break;
            
        case('png'):
            $memberfilename = "../logos/".$date[0].$random_number."TEMP.png";
            imagepng($watermarkfile_id,$memberfilename);
			$img2  = imagecreatefrompng($memberfilename);
			imagecopy($sourcefile_id, $img2, $dest_x, $dest_y, 0, 0, 166, 122);
            break;
            
        default:
            $memberfilename = "../logos/".$date[0].$random_number."TEMP.jpg";
            imagejpeg($watermarkfile_id,$memberfilename);
			$img2  = imagecreatefromjpeg($memberfilename);
			MergeImage($sourcefile_id,$img2,$dest_x,$dest_y,100);
    }
	
	
	
	//imagecopy($sourcefile_id, $img2, $dest_x, $dest_y, 0, 0, 166, 122);
	//imagecopymerge($sourcefile_id,$img2,$dest_x,$dest_y,0,0,imagesx($img2),imagesy($img2),100);
	//unlink($memberfilename);
	return $sourcefile_id;
  
    imagedestroy($sourcefile_id);
    imagedestroy($watermarkfile_id);
	imagedestroy($watermark);
	imagedestroy($img2);
    
}
function html2rgb($color)
{    
	if ($color[0] == '#')        
		$color = substr($color, 1);    
	
	if (strlen($color) == 6)        
		list($r, $g, $b) = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);   
	elseif (strlen($color) == 3) 
       list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
	else        
		return false;    
		$r = hexdec($r); 
		$g = hexdec($g); 
		$b = hexdec($b);    
		return array($r, $g, $b);
}


function WriteTextOnImage($img,$x,$y,$text,$font,$size,$red,$green,$blue) {
	// This function writes $text onto the image at $x,$y in the font $font with a $size
	list($red, $green, $blue) = html2rgb($red);
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
?>