<?php

if (file_exists('../model/att_count.txt')) {
	$file = fopen('../model/att_count.txt', 'r') or die ('Ошибка чтения файла');
	if ($file) {
		flock($file, LOCK_SH);
		$count = fread($file, 1024);
		flock($file, LOCK_UN);
		fclose($file);
	}
}
$count++;
if (file_exists('../model/att_count.txt')) {
	$file = fopen('../model/att_count.txt', 'w') or die ('Ошибка записи файла');
	if ($file) {
		flock($file, LOCK_EX);
		fwrite($file, $count);
		flock($file, LOCK_UN);
		fclose($file);
	}
}
header ('Content-Type: image/png');
$img = imagecreatetruecolor(91, 26);
$white = imagecolorallocate($img, 255, 255, 255);
$grey = imagecolorallocate($img, 128, 128, 128);
$font = realpath('../fonts/SourceSansPro-Regular.ttf');
imagefilledrectangle($img, 0, 0, 90, 25, $grey);
imagettftext($img, 20, 0, 5, 21, $white, $font, $count);
imagepng($img);
imagedestroy($img);