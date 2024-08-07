<?php
require_once '../conn/config.php';

$sql = "SELECT product_entity.product_name, product_entity.unit_id, 
        product_entity_decimal.value
        FROM product_entity
        INNER JOIN product_entity_decimal
        ON product_entity.entity_id=product_entity_decimal.entity_id
        INNER JOIN product_category_entityMainSub
        ON product_category_entityMainSub.product_entity_id=product_entity.entity_id
        WHERE product_entity.is_active = 1
        AND product_entity_decimal.is_active = 1
        AND product_entity_decimal.attribute_id = 77
        AND product_category_entityMainSub.category_sub_id = 21
        ORDER BY product_name ASC";

$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    echo "<table>
          <tr>
          <th>PRODUCT</th>
          <th>UNIT</th>
          <th>PRICE</th>
          </tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>
              <td>" . htmlspecialchars($row['product_name']) . "</td>
              <td>" . htmlspecialchars($row['unit_id']) . "</td>
              <td>" . htmlspecialchars($row['value']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$pdo = null;
exit();
?>