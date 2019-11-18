<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 04-Mar-19
 * Time: 21:18
 */

spl_autoload_register(function ($className) {
    $classFile = ROOT . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($classFile)) {
        require $classFile;
    } else {
        throw new Exception("Невозможно загрузить $classFile.");
    }
});

//spl_autoload_register();
