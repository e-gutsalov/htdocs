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
    //private string $page;
    private array $filename;
    private array $param;
    private string $output = '';
    //private string $item = '';
    //private string $itemsMenu = '';
    //private string $itemsProducts = '';

    public function __construct( array $filename, array $param )
    {
        $this->filename = $filename;
        $this->param = $param;
    }
/*
    public function parseMenu()
    {
        $this->page = $this->pages[$this->param['page']['catalog_menu']];
        $button = explode(PHP_EOL, $this->page );

        if ( $this->param['categoriesList'][0] )
        {
            foreach ( $this->param['categoriesList'] as $key => $value )
            {
                if ( is_object( $value ) )
                {
                    $this->item = $button[$this->param['page']['strButton']];
                    foreach ( $value as $objKey => $objValue )
                    {
                        $this->item = str_replace('{' . $objKey . '}', $objValue, $this->item );
                    }
                }
                $this->itemsMenu .= $this->item;
            }
        }
        else
        {
            $this->itemsMenu = $button[$this->param['page']['strButton']];
        }
        $button[$this->param['page']['strButton']] = $this->itemsMenu;
        $this->page = implode( $button );
        $this->pages[$this->param['page']['catalog_menu']] = $this->page;
    }

    public function parseProduct()
    {
        $this->page = $this->pages[$this->param['page']['product']];

        if ( $this->param['latestProducts'][0] )
        {
            foreach ( $this->param['latestProducts'] as $key => $value )
            {
                if ( is_object( $value ) )
                {
                    $this->item = $this->page;
                    foreach ( $value as $objKey => $objValue )
                    {
                        $this->item = str_replace('{' . $objKey . '}', $objValue, $this->item );
                    }
                }
                $this->itemsProducts .= $this->item;
            }
        }
        else
        {
            $this->items = $button[$this->param['catalog_menu']['strButton']];
        }
        $this->pages[$this->param['page']['product']] = $this->itemsProducts;
    }

    public function parseProductDetails()
    {
        $this->page = $this->pages[$this->param['product_details']['page']];

        if ( $this->param['productDetails'][0] )
        {
            foreach ( $this->param['productDetails'] as $key => $value )
            {
                if ( is_object( $value ) )
                {
                    $this->item = $this->page;
                    foreach ( $value as $objKey => $objValue )
                    {
                        $this->item = str_replace('{' . $objKey . '}', $objValue, $this->item );
                    }
                }
                $this->itemsProducts .= $this->item;
            }
        }
        else
        {
            $this->items = $button[$this->param['catalog_menu']['strButton']];
        }
        $this->pages[$this->param['product_details']['page']] = $this->itemsProducts;
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
*/
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
