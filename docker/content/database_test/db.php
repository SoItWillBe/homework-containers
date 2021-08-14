<?php

$connect = new PDO('mysql:dbname=laravel;host=localhost', 'root', 'super_secret_password');
$connect->setFetchMode(PDO::FETCH_OBJ);

$preapare = $connect->prepare('CREATE DATABASE user (id primary key auto increment, name varchar(255) )');
$preapare->execute();

$createData = $connect->prepare('INSERT INTO user VALUES ("Nick");');
$createData->execute();

$query = $connect->prepare('SELECT * FROM user;');
$result = $query->fetchAll();

var_dump($result);

$destroy = $connect->prepare('DROP TABLE user');
$destroy->execute();