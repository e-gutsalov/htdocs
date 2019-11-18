<?php

namespace model;

class Captcha
{
    private
        $randstr,
        $img,
        $bgcolor,
        $txtcolor;

    public function Paint()
    {
        session_start();
        $this->randstr = md5(time());
        $this->randstr = substr($this->randstr, 0, 7);
        $_SESSION['cap_code'] = $this->randstr;
        header('Content-type: image/png');
        $this->img = imagecreate(100, 25);
        $this->bgcolor = imagecolorallocate($this->img, 255, 255, 255);
        $this->txtcolor = imagecolorallocate($this->img, 0, 0, 0);
        imagestring($this->img, 5, 20, 5, $this->randstr, $this->txtcolor);
        imagepng($this->img);
        imagedestroy($this->img);
    }
}

$captcha = new Captcha();
$captcha->Paint();