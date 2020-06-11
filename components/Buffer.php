<?php

/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 28-Feb-19
 * Time: 21:40
 */

namespace components;

class Buffer
{
    private string $buffer = '';
    private array $filename;
    private array $param;

    public function __construct( array $filename, array $param )
    {
        $this->filename = $filename;
        $this->param = $param;
    }

    public function sendFile()
    {
        ob_start();
        extract( $this->param );
        foreach ( $this->filename as $key => $value ) {
            if ( file_exists( "templates/$value.tpl.php" ) ) {
                require "templates/$value.tpl.php";
            }
        }
        $this->buffer = ob_get_contents();
        ob_end_clean();
    }

    public function view()
    {
        if ( !empty( $this->filename ) ) {
            $this->sendFile();
        }
        return $this->buffer;
    }
}
