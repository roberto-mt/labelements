<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn1.php';

    $stmt = $pdo->prepare("SELECT product_category_main.id, product_category_main.category_name 
    FROM product_category_main
    WHERE product_category_main.is_active = 1
    ORDER BY category_name ASC");

    $stmt->execute();

    $mainCategory = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($mainCategory)) {
    foreach ($mainCategory as $category) {
    echo '<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
    }
} else {
    echo 'No navigation items found.';
}
$pdo = null;
?>