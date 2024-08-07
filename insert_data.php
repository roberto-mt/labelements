<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $entityId = $_POST['entityId'];
    $productName = $_POST['productName'];
    $unitId = $_POST['unitId'];
    $value = $_POST['value'];

    // Insert data into your database table
    // You should modify this part to fit your database structure
    // require_once 'controller/conn/config.php';

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

    $stmt = $pdo->prepare("INSERT INTO rfq_test (product_entity_id, product_name, unit_id, price) VALUES (:entityId, :productName, :unitId, :value)");
    $stmt->bindParam(':entityId', $entityId);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':unitId', $unitId);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
}
?>