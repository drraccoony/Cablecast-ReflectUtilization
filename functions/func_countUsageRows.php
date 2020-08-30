<?php
  $sql = "SELECT count(*) as total from Customers";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $totalcustomerrows = $row['total'];
}
?>
