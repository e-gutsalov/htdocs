<?php

/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 28-Feb-19
 * Time: 21:40
 */

namespace components;

class Buffer {

	private array $buffer;
    private array $filename;

	public function __construct( $filename )
    {
		$this->filename = $filename;
	}

	public function sendFile()
    {
        foreach ( $this->filename as $key => $value )
        {
            if ( file_exists("templates/$value.html" ) )
            {
                $this->buffer[ $value ] = file_get_contents("templates/$value.html" );
            }
        }
	}

	public function view()
    {
        if ( !empty( $this->filename ) )
        {
            $this->sendFile();
        }
        return $this->buffer;
    }
}
