<?php
require_once 'controller/conn/config.php';
// php call came from /sections

    $sql = "SELECT product_name FROM product_entity ORDER BY product_name ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $options = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Using htmlspecialchars to prevent XSS
        $options .= "<option>" . htmlspecialchars($row['product_name']) . "</option>";
    }

    echo $options;
?>