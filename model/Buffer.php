<?php

// buffer

class Buffer {

	public
        $buffer,
        $filename;

	public function __construct($filename)
    {
		$this->buffer = "";
		$this->filename = $filename;
		if (!empty($this->filename))
		{
			$this->sendFile();
		}
	}
	public function sendFile()
    {
		if (file_exists($this->filename))
		{
			$this->buffer = implode('', file($this->filename));
		}
	}
	public function parse()
    {
		foreach ($GLOBALS as $key => $value)
		{
			if (is_string($value) or is_int($value)){
			$this->buffer = str_replace('{'.$key.'}', $value, $this->buffer);
			}
		}
	}
	public function clear()
    {
		$this->buffer = "";
	}
	public function read()
    {
		$tmp = $this->buffer;
		$this->clear();
		return($tmp);
	}
	public function show()
    {
		print($this->read());
	}
}