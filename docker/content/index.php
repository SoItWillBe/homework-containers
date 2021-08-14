<?php

$host = 'db'; // container name
$db   = 'laravel';
$user = 'root';
$pass = 'super_secret_password'; // from .env
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

$preapare = $pdo->prepare('CREATE TABLE IF NOT EXISTS users( 
    id          INT AUTO_INCREMENT,
    first_name  VARCHAR(100) NOT NULL, 
    last_name   VARCHAR(100) NULL,
    hobbie      VARCHAR(255) NULL,
    PRIMARY KEY(id)
  );');

$preapare->execute();

$query = $pdo->prepare('SHOW TABLES;');
$query->execute();
$tables = $query->fetchAll();

$data = [
    'INSERT INTO users (first_name, hobbie) VALUES ("Nick", "Engineer");',
    'INSERT INTO users (first_name, last_name) VALUES ("John", "Doe");',
    'INSERT INTO users (first_name) VALUES ("Steven");',
    'INSERT INTO users (first_name, last_name) VALUES ("Michael", "Kors");',
    'INSERT INTO users (first_name, last_name, hobbie) VALUES ("Stephen", "King" ,"Writer");',
    'INSERT INTO users (first_name) VALUES ("Mark");',
    'INSERT INTO users (first_name, last_name) VALUES ("Pavel", "Racer");',
];

shuffle($data);

foreach($data as $key => $datum) {
    try {
        $createData = $pdo->prepare($datum);
        $createData->execute();
    } catch (PDOException $e) {
        die('Не удалось внести данные: ' . $e->getMessage());
    }
}

$payload = $pdo->prepare('SELECT * FROM users;');
$payload->execute();
$payload = $payload->fetchAll();


$destroy = $pdo->prepare('DROP TABLE users;');
$destroy->execute();

echo '<pre>';

var_dump($tables[0]);

echo '<br><br>';

var_dump($payload);