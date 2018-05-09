<?php
// Загрузка контента
class LoadContent
{
	public $txt_link;
	public $files;
	
	public function GetContent($txt_link)
	{
		$this->txt_link = $txt_link;
		$this->files = file_get_contents($this->txt_link);
		$this->files = mb_convert_encoding($this->files, "utf-8", "windows-1251");
		return($this->files);
	}
}
?>