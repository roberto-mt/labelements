<?php
$dsn = 'mysql:host=localhost;dbname=lab_elem_v2';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log errors and avoid exposing detailed messages to users
    error_log("Connection failed: " . $e->getMessage());
    die("Something went wrong.");
}
?>