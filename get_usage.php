<?php
  require 'aws_sdk/aws-autoloader.php';
  use Aws\CostExplorer\CostExplorerClient;
  require_once  'db_connect.php';

  // Instantiate a client with credentials
  $client = new CostExplorerClient([
      'profile' => 'default',
      'region'  => 'us-east-1',
      'version' => 'latest'
  ]);
?>
<h1>Get usage</h1>
<?php
/* Tracking how long this takes to fire.*/
$starttime = microtime(true);

/* I dont want to hard code the dates, so I am going to define them here */
$startdate = date("Y-m-j", strtotime( '-2 days' ));
$enddate = date("Y-m-j", strtotime( '-1 days' ));

/* Lets use the getCostAndUsage function from the library */
$data = $client->getCostAndUsage([
    'TimePeriod' => [
        'End' => $enddate,
        'Start' => $startdate,
      ],
    'Granularity' => 'MONTHLY',
    'Metrics' => ['BlendedCost'],
    'GroupBy' => [
      [
      'Type' => 'TAG',
      'Key' => 'NetsuiteID']
    ]
  ]);
$endtime = microtime(true);
/* Show time to run script for informational purposes. */
printf("Reflect usage pulled from AWS in %f seconds", $endtime - $starttime );

//Check if data is existing
if(isset($data['ResultsByTime'][0]['Groups'])){
  //Loop through each item
  foreach ($data['ResultsByTime'][0]['Groups'] as $key => $value) {

    //Check if the netsuiteID exists, and is not blank
    if(isset($value['Keys'])){
      $customer_id = substr($value['Keys'][0], 11);

      //If no id exists, loop past it.
      if($customer_id == ""){
        continue;
      }

      echo $customer_id.":";
    }

    //Check if cost exists
    if(isset($value['Metrics']['BlendedCost']['Amount'])){
      $cost = $value['Metrics']['BlendedCost']['Amount'];
      echo $cost."<br/>";
    }

    //Check the values are populated, if so, add them to the db
    if($cost && $customer_id){
      $sql = "INSERT INTO `customer_usage` (`customerID`, `date`, `cost`) VALUES ('" . $customer_id . "', CURRENT_DATE() , '" . $cost . "')";
      $conn->query($sql);
    }
  }
}
?>
