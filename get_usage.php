<?php
  require 'aws_sdk/aws-autoloader.php';
  use Aws\CostExplorer\CostExplorerClient;

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
$result = $client->getCostAndUsage([
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
printf("Data pulled from AWS in %f seconds", $endtime - $starttime );
?>
