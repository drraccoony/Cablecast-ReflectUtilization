<?php include('../includes/head.php'); ?>

<?php
  require 'aws_sdk/aws-autoloader.php';
  use Aws\CostExplorer\CostExplorerClient;
  $debug = true;
  require_once  'db_connect.php';

  // Instantiate a client with credentials
  $client = new CostExplorerClient([
      'profile' => 'default',
      'region'  => 'us-east-1',
      'version' => 'latest'
  ]);
?>
<div class="container">
  <h1>functions\func_get_usage.php</h1>
  <p>This is a script that should be ran daily to get the previous days usage reporting via cron job. Typically this is not ran manually, unless for debugging purposes.</p>
  <p><a href="../index.php">Return to Dashboard</a>.
  <hr>
  <?php
  /* Tracking how long this takes to fire.*/
  $starttime = microtime(true);

  /* I dont want to hard code the dates, so I am going to define them here */
  /* Per the docs: The start date is inclusive, but the end date is exclusive.*/
  $startdate = date("Y-m-j", strtotime( '-1 days' ));
  $enddate = date("Y-m-j", strtotime( '0 days' ));

  echo "Pulling usage from <kbd>".$startdate."</kbd> until <kbd>".$enddate."</kbd>.<br>";

  /* Lets use the getCostAndUsage function from the library */
  $data = $client->getCostAndUsage([
      'TimePeriod' => [
          'End' => $enddate,
          'Start' => $startdate,
        ],
      'Granularity' => 'MONTHLY',
      'Metrics' => ['BlendedCost','UsageQuantity'],
      'GroupBy' => [
        [
        'Type' => 'TAG',
        'Key' => 'NetsuiteID']
      ]
    ]);
  $endtime = microtime(true);
  /* Show time to run script for informational purposes. */
  printf("Reflect usage pulled from AWS in <kbd>%f</kbd> seconds.<br><h2>Results</h2>", $endtime - $starttime );

  //Check if data is existing
  if(isset($data['ResultsByTime'][0]['Groups'])){
    //Loop through each item
    foreach ($data['ResultsByTime'][0]['Groups'] as $key => $value) {

      //Check if the netsuiteID exists, and is not blank
      if(isset($value['Keys'])){
        $customer_id = substr($value['Keys'][0], 11);

        //If no id exists, loop past it.
        /*if($customer_id == ""){
          continue;
        }*/

        echo "CUSTOMER TAG: <kbd>".$customer_id."</kbd>. ";
      }

      //Check if cost exists
      if(isset($value['Metrics']['BlendedCost']['Amount'])){
        $cost = $value['Metrics']['BlendedCost']['Amount'];
        $useage = $value['Metrics']['UsageQuantity']['Amount'];
        echo "COST: <kbd>" .$cost."</kbd> | USAGE: <kbd>".$useage. "</kbd>.<br/>";
      }

      //Check the values are populated, if so, add them to the db
      if($cost && $customer_id){
        $sql = "INSERT INTO `customer_usage` (`customerID`, `usageDate`, `cost`, `data_use`) VALUES ('" . $customer_id . "','" . $startdate . "', '" . $cost . "', '" . $useage . "')";
        $conn->query($sql);
      }
    }
  }
  ?>

</div>
