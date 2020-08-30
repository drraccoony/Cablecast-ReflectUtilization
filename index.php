<!doctype html>
<html lang="en">
  <?php $title = 'Dashboard'; ?>
  <?php $currentPage = 'index'; ?>
  <?php $debug = 0; ?>
  <?php $pagestarttime = microtime(true); ?>
  <?php include('includes/head.php'); ?>
  <?php include('includes/navbar.php'); ?>
  <?php require_once  'functions/db_connect.php'; ?>
  <body>
    <div class="container">
      <h1>Dashboard Overview</h1>

      <div class="row">
        <div class="col-md-6">
          <h2>Yesterdays Cost</h4>
          <table class="table table-striped">
            <tr>
              <th>Metric</th>
              <th>Cost (USD)</th>
            </tr>
            <tr>
              <td><i class="fas fa-tag" style="color:Tomato"></i> Untagged</td>
              <td></td>
            </tr>
            <tr>
              <td><i class="far fa-tags"></i> Tagged</td>
              <td></td>
            </tr>
            <tr>
              <td>Total</td>
              <td></td>
            </tr>
            <tr>
              <td><i class="fas fa-trophy-alt"></i> Highest</td>
              <td></td>
            </tr>
          </table>
          <small>Dig deeper: <a href="#">Yesterdays breakdown</a> | <a href="#">All reports</a> | <a href="#">Highest Previous Usage</a></small>
        </div>
        <div class="col-md-6">
          <?php include('functions/func_countCustomerRows.php'); ?>
          <?php include('functions/func_countUsageRows.php'); ?>
          <h2>Quick Stats</h2>
          <table class="table table-striped">
            <tr>
              <td>Total Customers in DB</td>
              <td><?php echo $totalcustomerrows ?></td>
            </tr>
            <tr>
              <td>Total Usage Entries in DB</td>
              <td><?php echo $totalusagerows ?></td>
            </tr>
            <tr>
              <td>Lifetime Cost</td>
              <td></td>
            </tr>
          </table>
          <h2>Manual Function Runs</h2>
          <ul>
            <li><a href="functions/func_get_usage.php" class="text-danger">Manually pull yesterdays usage into DB</a></li>
          </ul>
        </div>
      </div>





    </div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <?php include('includes/footer.php'); ?>
  </body>
</html>
