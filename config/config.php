<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 14-Mar-19
 * Time: 21:16
 */

//$params['url'] = 'https://market.yandex.ru/search?text=Samsung%20Galaxy%20S10e';
//$params['url'] = 'https://market.yandex.ru/search?text=Samsung%20Galaxy%20S10e&cvredirect=0&track=redirbarup&local-offers-first=1';
$params['url'] = 'https://market.yandex.ru/search?text=Samsung%20Galaxy%20S10e&local-offers-first=1';
$params['useragent'] = 'Mozilla/5.0 (Windows NT 6.3) Gecko/20100101 Firefox/65.0';
$params['timeout'] = 5;
$params['connecttimeout'] = 5;
$params['head'] = false;
$params['cookie']['file'] = false;
$params['cookie']['session'] = false;
$params['proxy']['ip'] = false;
$params['proxy']['port'] = false;
$params['proxy']['type'] = false;
$params['headers'] = false;
$params['post'] = 'text=SamsungGalaxyS10e';

return $params;
