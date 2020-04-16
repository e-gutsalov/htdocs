<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 28-Feb-19
 * Time: 21:40
 */

namespace components;


class Render
{
    private array $filename;
    private array $param;
    private string $output = '';

    public function __construct( array $filename, array $param )
    {
        $this->filename = $filename;
        $this->param = $param;
    }

    public function parse()
    {
        $buffer = new Buffer( $this->filename, $this->param );
        $this->output = $buffer->view();
    }

    public function clear()
    {
        $this->output = '';
    }

    public function read()
    {
        $tmp = $this->output;
        $this->clear();
        return $tmp;
    }

    public function show()
    {
        $this->parse();
        echo $this->read();
    }
}
