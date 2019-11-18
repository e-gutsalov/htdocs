<?php

/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 28-Feb-19
 * Time: 21:40
 */

namespace components;

class Buffer {

	private $buffer;
    private $filename;

	public function __construct($filename)
    {
		$this->buffer = '';
		$this->filename = $filename;
		if (!empty($this->filename))
		{
			$this->sendFile();
		}
	}

	public function sendFile()
    {
        foreach ($this->filename as $key => $value)
        {
            if (file_exists("templates/$value.html"))
            {
                $this->buffer .= file_get_contents("templates/$value.html");
            }
        }
	}

	public function view()
    {
        return $this->buffer;
    }
}
