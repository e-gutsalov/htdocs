<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$url = 'http://alfashops.ru/scripts/test_task/api_sample.php';

@ $ch = curl_init();
if (!curl_error($ch)) {
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'method=get_api_key');
    $key = curl_exec($ch);

    if ($key) {
        $ip = $_SERVER['REMOTE_ADDR'];
        curl_setopt($ch, CURLOPT_POSTFIELDS, "method=send_lead&name=$name&phone=$phone&ip=$ip&key=");  // без ключа работает, с ключем нет
        $out = curl_exec($ch);
        curl_close($ch);
    }
    else {
        echo 'Произошла ошибка '.curl_errno($ch).': '. curl_error($ch);
    }
}
else {
    echo 'Произошла ошибка '.curl_errno($ch).': '. curl_error($ch);
}

echo $out;
