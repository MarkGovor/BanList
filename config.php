<?php

$cfg = array(
     
    'dbhost' => 'localhost',
    
    'dbname' => '',
    
    'dbpassword' => '',
    
    'dbuser' => '',
    
    'dbtable' => 'banlist',
    
    'date_format' => 'G:i d.m.Y',
    
    'text_ban' => 'Навсегда',
    
    'text_reason_not' => 'Нарушение правил проекта',
    
    'page_output'      => 10, 
    
    'page_btn'        => 6, 
    
    'search_on' => 'true'
    
);

$db = mysqli_connect($cfg['dbhost'], $cfg['dbuser'], $cfg['dbpassword'], $cfg['dbname']);

if (!$db) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
