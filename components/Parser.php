<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 14-Mar-19
 * Time: 20:55
 */

namespace components;

require 'GetContent.php';

class Parser
{
    public function parseIt()
    {
        $content = GetContent::getPage( require '../config/config.php' );

        $html = new \DOMDocument();
        $html->preserveWhiteSpace = true;
        $html->validateOnParse = true;
        $html->substituteEntities = true;

        $content = mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' );
        $html->loadHTML( $content, LIBXML_NOERROR );

        //var_dump( $html->getElementsByTagName('a')->item(0)->getAttribute('href') );

        $xpath = new \DOMXpath( $html );
        //$elementsDom = $xpath->query( '//*[@class="layout__col i-bem layout__col_search-results_normal"]' );
        $elementsDom = $xpath->query( '//*[@class="n-filter-applied-results__content preloadable"]' );

        /*foreach ( $elementsDom as $value )
        {
            var_dump( $value );
        }*/
        //var_dump( $elementsDom->item(0)->attributes->item(3) );

        $elements = '';
        for ( $i = 0; $i < $elementsDom->length; $i++ ) {
            $elements .= $elementsDom->item( $i )->nodeValue . '<br>';
        }
        echo $elements;
    }
}

$parser = new Parser();
$parser->parseIt();

