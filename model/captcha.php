<?php

session_start();
$randstr = md5(time());
$randstr = substr($randstr, 0, 7);
$_SESSION['cap_code'] = $randstr;
header('Content-type: image/png');
$img = imagecreate(100, 25);
$bgcolor = imagecolorallocate($img, 255, 255, 255);
$txtcolor = imagecolorallocate($img, 0, 0, 0);
imagestring($img, 5, 20, 5, $randstr, $txtcolor);
imagepng($img);
imagedestroy($img);