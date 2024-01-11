<?php
const _HOST = 'localhost';
const _DB = 'my_db';
const _USER = 'root';
const _PASS = 'Password123#@!';
const _CHARSET = 'utf8';
try {
    if (class_exists('PDO')) {
        $dsn = 'mysql:dbname='._DB.';host='._HOST.';charset='._CHARSET;
        
        $conn = new PDO($dsn, _USER, _PASS);

    }
}
catch (Exception $exception) {
    echo $exception -> getMessage();
}
