<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 14-Mar-19
 * Time: 20:37
 */

namespace components;


class GetContent
{
    public static function getPage( $params )
    {
        if ( is_array( $params ) ) {
            if ( !empty( $params[ 'url' ] ) ) {
                $url = !empty( $params[ 'url' ] ) ? $params[ 'url' ] : false;
                $useragent = !empty( $params[ 'useragent' ] ) ? $params[ 'useragent' ] : false;
                $timeout = !empty( $params[ 'timeout' ] ) ? $params[ 'timeout' ] : false;
                $connecttimeout = !empty( $params[ 'connecttimeout' ] ) ? $params[ 'connecttimeout' ] : false;
                $head = !empty( $params[ 'head' ] ) ? $params[ 'head' ] : false;
                $cookie_file = !empty( $params[ 'cookie' ][ 'file' ] ) ? $params[ 'cookie' ][ 'file' ] : false;
                $cookie_session = !empty( $params[ 'cookie' ][ 'session' ] ) ? $params[ 'cookie' ][ 'session' ] : false;
                $proxy_ip = !empty( $params[ 'proxy' ][ 'ip' ] ) ? $params[ 'proxy' ][ 'ip' ] : false;
                $proxy_port = !empty( $params[ 'proxy' ][ 'port' ] ) ? $params[ 'proxy' ][ 'port' ] : false;
                $proxy_type = !empty( $params[ 'proxy' ][ 'type' ] ) ? $params[ 'proxy' ][ 'type' ] : false;
                $headers = !empty( $params[ 'headers' ] ) ? $params[ 'headers' ] : false;
                $post = !empty( $params[ 'post' ] ) ? $params[ 'post' ] : false;


                @ $ch = curl_init();
                if ( !curl_error( $ch ) ) {
                    curl_setopt( $ch, CURLOPT_URL, $url );
                    curl_setopt( $ch, CURLOPT_USERAGENT, $useragent );
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
                    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch, CURLINFO_HEADER_OUT, true );
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    //curl_setopt($ch, CURLOPT_POST, true);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

                    $content = curl_exec( $ch );
                    //var_dump($info = curl_getinfo($ch));
                    curl_close( $ch );
                    return $content;
                } else {
                    echo 'Произошла ошибка ' . curl_errno( $ch ) . ': ' . curl_error( $ch );
                }

            }
        }
        return false;
    }
}
