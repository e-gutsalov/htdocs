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
    private string $page;
    private array $pages;
    private array $param;
    private string $output = '';
    private string $item;
    private string $items = '';

    public function __construct( array $pages, array $param )
    {
        $this->pages = $pages;
        $this->param = $param;
    }

    public function parseMenu()
    {
        $this->page = $this->pages[$this->param['catalog_menu']['page']];
        $button = explode(PHP_EOL, $this->page );

        if ( is_array( $this->param['categoriesList'] ) )
        {
            foreach ( $this->param['categoriesList'] as $key => $value )
            {
                if ( is_object( $value ) )
                {
                    $this->item = $button[$this->param['catalog_menu']['strButton']];
                    foreach ( $value as $objKey => $objValue )
                    {
                        $this->item = str_replace('{' . $objKey . '}', $objValue, $this->item );
                    }
                }
                $this->items .= $this->item;
            }

            $button[$this->param['catalog_menu']['strButton']] = $this->items;
            $this->page = implode( $button );
            $this->pages[$this->param['catalog_menu']['page']] = $this->page;

        }
        else
        {
            $this->pages[$this->param['catalog_menu']['page']] = 'Каталог сейчас недоступен!';
        }

    }

    public function parse()
    {
        foreach ( $this->pages as $kPage => $vPage )
        {
            foreach ( $this->param as $key => $value )
            {
                if ( is_string( $value ) or is_int( $value ) )
                {
                    $vPage = str_replace('{' . $key . '}', $value, $vPage );
                }
            }
            $this->output .= $vPage;
        }
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
