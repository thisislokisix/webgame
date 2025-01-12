<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/db/config.php';
$dsn = "mysql:host={$config['host']};dbname={$config['db']}";
$dbh = new PDO($dsn, $config['username'], $config['password'], $config['options']);

//Example:
//$result = $dbh->query("SELECT * FROM user")->fetchAll();
//$dbh->prepare("INSERT INTO books (title, author) VALUES (?, ?)")->execute(array($author, $title));
