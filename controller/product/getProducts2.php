<?php
if (isset($_GET['id'])) {
    require_once '../conn/config.php';

    $selectedSecondaryOptionId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT product_entity.entity_id, product_entity.product_name, product_entity.unit_id, 
    product_entity_decimal.value
    FROM product_entity
    INNER JOIN product_entity_decimal
    ON product_entity.entity_id=product_entity_decimal.entity_id
    INNER JOIN product_category_entityMainSub
    ON product_category_entityMainSub.product_entity_id=product_entity.entity_id
    WHERE product_category_entityMainSub.category_sub_id = :secondaryOptionId
    AND product_entity.is_active = 1
    AND product_entity_decimal.is_active = 1
    AND product_entity_decimal.attribute_id = 77
    ORDER BY product_name ASC");

    $stmt->bindParam(':secondaryOptionId', $selectedSecondaryOptionId);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        echo '<tr>';
        echo '<td>' . $product['entity_id'] . '</td>';
        echo '<td>' . $product['product_name'] . '</td>';
        echo '<td>' . $product['unit_id'] . '</td>';
        echo '<td>' . '₱' . number_format($product['value'], 2) . '</td>';
        echo '<td class="action_column"><button class="rfq-button" id="addToRFQ"
        data-entity-id="' . $product['entity_id'] . '" 
        data-product-name="' . $product['product_name'] . '" 
        data-unit-id="' . $product['unit_id'] . '" 
        data-value="' . $product['value'] . '">
        RFQ</button></td>';
        echo '</tr>';
    }    

} else {
    echo '<tr><td colspan="3">No products found</td></tr>';
}
$pdo = null;
?>