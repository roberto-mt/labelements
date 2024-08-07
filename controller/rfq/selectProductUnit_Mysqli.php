<?php
$conn = new mysqli('localhost', 'root', 'leverage.138', 'lab_elem_v1');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT unit_name
FROM product_unit
;";

$result = $conn->query($sql);
$options ="";

while($row = $result->fetch_assoc()) {
      $options = $options."<option>$row[unit_name]</option>";
  }

echo $options;
$conn = null;

?>