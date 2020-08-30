<h1>Header</h1>
<?php
require 'aws_sdk/aws-autoloader.php';
use Aws\CostExplorer\CostExplorerClient;
$debug = true;
require_once  'functions/db_connect.php';

// Instantiate a client with credentials
$client = new CostExplorerClient([
    'profile' => 'default',
    'region'  => 'us-east-1',
    'version' => 'latest'
]);
$startdate = date("Y-m-j", strtotime( '-2 days' ));
$enddate = date("Y-m-j", strtotime( '-1 days' ));

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
        $useage = $value['Metrics']['UsageQuantity']['Amount'];
        echo $cost." | ".$useage. ".<br/>";
      }
    }
  }


  ?>

<p>Done?</p>
