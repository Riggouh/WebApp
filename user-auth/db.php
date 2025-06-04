<?php
$host = 'localhost';
$db   = 'users_db';
$user = 'users_admin';
$pass = 'R7otZjq9o#gP1jg*';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;port=3306;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    exit('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
}
?>