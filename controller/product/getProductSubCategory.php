<?php
if (isset($_GET['id'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn1.php';
    
    $selectedPrimaryOptionId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM product_category_sub WHERE product_category_sub.category_main_id = :primaryOptionId
    AND product_category_sub.is_active = 1");

    $stmt->bindParam(':primaryOptionId', $selectedPrimaryOptionId);
    $stmt->execute();

    $secondaryOptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($secondaryOptions as $option) {
        echo '<option value="' . $option['id'] . '">' . $option['subcategory_name'] . '</option>';
    }
} else {
    echo '<option value="">Select...</option>';
}
$pdo = null;
?>