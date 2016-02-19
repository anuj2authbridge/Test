$imgSrc = base64_decode($sourcePath);
				$image = imagecreatefromstring($imgSrc);
				$new_image = imagecreatetruecolor(imagesx($image), imagesy($image));
				imagecopy($new_image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
				switch($FileExt)
				{
					case 'png':
							imagepng($new_image,$path,100);
							imagedestroy($image);
							imagedestroy($new_image);
							$upldflag = true;
					break;
					case 'jpg':
					case 'jpeg':
							imagejpeg($new_image,$path,100);
							imagedestroy($image);
							imagedestroy($new_image);
							$upldflag = true;
					break;
					case 'gif':
							imagegif($new_image,$path,100);
							imagedestroy($image);
							imagedestroy($new_image);
							$upldflag = true;
					break;
					default:
						$upldflag = false;
					break;
				}
