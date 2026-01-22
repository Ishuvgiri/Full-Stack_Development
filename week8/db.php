<?php
$host = 'localhost';
$db = 'aditya';
$user = 'root';
$pass = '';
try {
echo "Connected successfully";
$pdo = new PDO(
"mysql:host=$host;dbname=$db;charset=utf8",
$user,
$pass,
[
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]
);
} catch (PDOException $e) {
die("Database connection failed");
}