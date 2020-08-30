<!doctype html>
<html lang="en">
  <?php $title = 'Dashboard'; ?>
  <?php $currentPage = 'index'; ?>
  <?php $debug = 0; ?>
  <?php $pagestarttime = microtime(true); ?>
  <?php include('includes/head.php'); ?>
  <?php include('includes/navbar.php'); ?>
  <?php require_once  'functions/db_connect.php'; ?>
  <?php include('functions/func_countCustomerRows.php'); ?>
  <body>
    <div class="container">
      <h1>Dashboard Overview</h1>

      <div class="row">
        <div class="col-md-6">
          <h2>Yesterdays Usage</h4>
        </div>
        <div class="col-md-6">
          <h2>Quick Stats</h4>
            <table class="table table-striped">
              <tr>
                <td>Total Customers</td>
                <td><?php echo $totalcustomerrows ?></td>
              </tr>
              <tr>
                <td>Lifetime Cost</td>
                <td></td>
              </tr>
            </table>
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
