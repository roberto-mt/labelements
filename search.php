<?php

// Database connection
$host = 'localhost';
$dbname = 'lab_elem_v2';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get search term from AJAX request
    $search = json_decode(file_get_contents('php://input'), true)['search'];

    // Query database
    $stmt = $conn->prepare("SELECT product_entity.product_name, product_entity.unit_id, 
    product_entity_decimal.value
    FROM product_entity 
    INNER JOIN product_entity_decimal
    ON product_entity.entity_id=product_entity_decimal.entity_id
    WHERE product_entity.product_name 
    LIKE :search 
    AND product_entity.is_active = 1
    AND product_entity_decimal.is_active = 1
    AND product_entity_decimal.attribute_id = 77");

    $stmt->execute(['search' => "%$search%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return results as JSON
    echo json_encode($results);
    $pdo = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// SELECT product_name, unit_id 
// FROM product_entity 
// WHERE product_name 
// LIKE '%pyrex%'
// AND is_active = 1;