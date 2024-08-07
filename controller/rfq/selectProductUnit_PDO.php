<?php
require_once 'controller/conn/config.php';

    $sql = "SELECT unit_name FROM product_unit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $options = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Using htmlspecialchars to prevent XSS
        $options .= "<option>" . htmlspecialchars($row['unit_name']) . "</option>";
    }
    
    echo $options;
    $pdo = null;
?>
