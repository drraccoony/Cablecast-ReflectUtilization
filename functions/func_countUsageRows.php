<?php
  $sql = "SELECT count(*) as total from customer_usage";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $totalusagerows = $row['total'];
  }
    unset($sql, $result, $row);
?>
