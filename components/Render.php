<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 28-Feb-19
 * Time: 21:40
 */

namespace components;

//use views\MainView;

class Render
{
    private $page;
    private $param;
    private $output;

    public function __construct($page, $param)
    {
        $this->page = $page;
        $this->param = $param;
    }

    public function parse()
    {
        foreach ($this->param as $key => $value)
        {
            if (is_string($value) or is_int($value)){
                $this->page = str_replace('{'.$key.'}', $value, $this->page);
            }
        }
        $this->output = $this->page;
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
