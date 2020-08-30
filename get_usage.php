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
$jsondata = $client->getCostAndUsage([
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

$formatted_data = json_decode($jsondata, true);
/*
I think this is wrong... commenting it out.
$customer_key = $formatted_data['ResultsByTime']['Groups']['Keys'];
$customer_cost = $formatted_data['ResultsByTime']['Groups']['Metrics']['BlendedCost'];*/

//print_r($customer_key);

/*foreach ($formatted_data as $row) {
    //$customer_key = $formatted_data['ResultsByTime']['Groups']['Keys']
    //$customer_cost = $formatted_data['ResultsByTime']['Groups']['Metrics']['BlendedCost']
    $sql = "INSERT INTO `customer_usage` (CityCode, Name) VALUES ('" . $row["customer_cost"] . "', '" . $row["Name"] . "')";
    $conn->query($sql);
}*/



/*$sql = "INSERT INTO `customer_usage` (`id`, `customerID`, `date`, `data_use`, `cost`) VALUES (NULL, '10', CURRENT_DATE(), '10', '10')";
$conn->query($sql);*/

?>
