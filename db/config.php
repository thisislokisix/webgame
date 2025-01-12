<?php
$config = array(
    'host' => 'localhost;port=3306',
    'db' => 'thietky_web',
    'username' => 'root',
    'password' => '1234',
    'options' => array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    )
);
