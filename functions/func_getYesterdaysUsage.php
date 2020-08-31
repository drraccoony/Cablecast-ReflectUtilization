<?php
  require_once  'db_connect.php';
  $targetdate = date("Y-m-j", strtotime( '-1 days' ));
  $sql = "SELECT * FROM customer_usage WHERE usageDate='$targetdate' ORDER BY `cost` DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Cost: " . $row["cost"]. " " . $row["data_use"]. "<br>";
    }
  } else {
    echo "0 results";
  }
?>
