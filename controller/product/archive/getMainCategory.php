<?php
require_once '../conn/config.php';

$sql = "SELECT product_category_main.id, product_category_main.category_name
        FROM product_category_main
        WHERE product_category_main.is_active = 1
        ORDER BY category_name ASC";

$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    echo "<table>
          <tr>
          <th>Product Category</th>
          </tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>
              <td>" . htmlspecialchars($row['category_name']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$pdo = null;
exit();
?>