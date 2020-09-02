<!doctype html>
<html lang="en">
  <?php $title = 'Last Month Report'; ?>
  <?php $currentPage = 'reports'; ?>
  <?php $debug = 0; ?>
  <?php $pagestarttime = microtime(true); ?>
  <?php include('../includes/head.php'); ?>
<body>
  <?php
    $last_month_start = date("Y-m-d", mktime(0, 0, 0, date("m", strtotime("-1 month")), 1, date("Y", strtotime("-1 month"))));
    $last_month_end = date("Y-m-d", mktime(0, 0, 0, date("m", strtotime("-1 month")), date("t", strtotime("-1 month")), date("Y", strtotime("-1 month"))));
    if(isset($_GET["limit"])) {$result_limit = $_GET["limit"];} else { $result_limit= 10;}
  ?>
  <div class="container">
    <h1>functions\report_LastMonthUsage.php</h1>
    <p>Pulls last month usage, sorted by highest cost, with a max results of 10. Use <code>?limit=</code> in the url to change default limit.</p>
    <p><strong>Result Criteria:</strong> Starting on <kbd><?php echo $last_month_start; ?></kbd> and ending on <kbd><?php echo $last_month_end; ?></kbd>. Limiting to <kbd><?php echo $result_limit; ?></kbd> results.</p>
    <p><a href="../index.php">Return to Dashboard</a>.
    <hr>
    <?php
      require_once  'db_connect.php';
      $sql = "SELECT customer_usage.*, customers.name
              FROM customer_usage
              INNER JOIN customers ON customer_usage.customerID = customers.ID
              WHERE customer_usage.usageDate >= '$last_month_start'
              AND customer_usage.usageDate <= '$last_month_end' ORDER BY customer_usage.cost DESC
              LIMIT $result_limit";
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
        print    '<th></th>';
        print  '</tr>';
        print '</thead>';
        print '<tbody>';
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>$" . number_format($row["cost"], 2, '.', ''). "</td><td>" . $row["data_use"]. " bytes</td><td>View more</td></tr>";
        }
        print '</tbody>';
        print '</table>';
      } else {
        echo "0 results";
      }
    ?>
  </div>
</body>
