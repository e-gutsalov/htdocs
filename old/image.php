<?php

$im = imagecreatetruecolor(200, 200);
$white = imagecolorallocate($im, 255, 255, 255);
$blue = imagecolorallocate($im, 0, 0, 255);
imagefill($im, 0,0, $blue);
imageline($im, 0, 0, 200, 200, $white);
imagestring($im, 4, 50, 150, 'Sales', $white);
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
