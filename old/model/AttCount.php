<?php

namespace model;

class AttCount
{
    private
        $file,
        $count,
        $img,
        $white,
        $grey,
        $font;

    public function readFile()
    {
        if (file_exists('../model/att_count.txt')) {
            $this->file = fopen('../model/att_count.txt', 'r') or die ('Ошибка чтения файла');
            if ($this->file) {
                flock($this->file, LOCK_SH);
                $this->count = fread($this->file, 1024);
                $this->count++;
                flock($this->file, LOCK_UN);
                fclose($this->file);
            }
        }
    }

    public function writeFile()
    {
        if (file_exists('../model/att_count.txt')) {
            $this->file = fopen('../model/att_count.txt', 'w') or die ('Ошибка записи файла');
            if ($this->file) {
                flock($this->file, LOCK_EX);
                fwrite($this->file, $this->count);
                flock($this->file, LOCK_UN);
                fclose($this->file);
            }
        }
    }

    public function Paint()
    {
        $this->readFile();
        $this->writeFile();
        header ('Content-Type: image/png');
        $this->img = imagecreatetruecolor(91, 26);
        $this->white = imagecolorallocate($this->img, 255, 255, 255);
        $this->grey = imagecolorallocate($this->img, 128, 128, 128);
        $this->font = realpath('../fonts/SourceSansPro-Regular.ttf');
        imagefilledrectangle($this->img, 0, 0, 90, 25, $this->grey);
        imagettftext($this->img, 20, 0, 5, 21, $this->white, $this->font, $this->count);
        imagepng($this->img);
        imagedestroy($this->img);
    }
}

$paint = new AttCount;
$paint->Paint();