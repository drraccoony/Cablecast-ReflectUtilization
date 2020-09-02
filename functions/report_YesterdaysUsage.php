<?php include('../includes/head.php'); ?>

<?php $targetdate = date("Y-m-j", strtotime( '-1 days' )); ?>
<div class="container">
  <h1>functions\report_YesterdaysUsage.php</h1>
  <p>Pulls yesterdays usage, sorted by highest cost.</p>
  <p><a href="../index.php">Return to Dashboard</a>.
  <hr>
  <?php
    require_once  'db_connect.php';
    $sql = "SELECT * FROM customer_usage WHERE usageDate='$targetdate' ORDER BY `cost` DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      print  '<table class="table table-striped">';
      print  '<thead>';
      print  '<tr>';
      print    '<th>Customer Tag</th>';
      print    '<th>Customer Name</th>';
      print    '<th>Cost</th>';
      print    '<th>Usage (Bytes)</th>';
      print  '</tr>';
      print '</thead>';
      print '<tbody>';
      while($row = $result->fetch_assoc()) {
        //$sql2 = "SELECT * FROM customers WHERE id = $row[id]";
        //$result2 = $conn->query($sql2);
        //$row2 = $result2->fetch_assoc();

        //echo "<tr><td>" . $row["id"]. "</td><td>". $row2["Name"]."</td><td>$" . $row["cost"]. "</td><td>" . $row["data_use"]. " bytes</td></tr>";
        echo "<tr><td>" . $row["id"]. "</td><td></td><td>$" . $row["cost"]. "</td><td>" . $row["data_use"]. " bytes</td></tr>";
      }
      print '</tbody>';
      print '</table>';
    } else {
      echo "0 results";
    }
  ?>
</div>
