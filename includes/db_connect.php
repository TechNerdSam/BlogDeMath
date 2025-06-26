<?php
// includes/db_connect.php

$host = 'localhost'; // Ou l'adresse de votre serveur MySQL
$db   = 'mathinsight_db'; // Le nom de votre base de données
$user = 'root'; // Votre nom d'utilisateur MySQL
$pass = ''; // Votre mot de passe MySQL (laissez vide si pas de mot de passe)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>