<?php
  require 'aws_sdk/aws-autoloader.php';
  use Aws\DynamoDb\DynamoDbClient;

  // Instantiate a client with credentials
  $client = new DynamoDbClient([
      'profile' => 'default',
      'region'  => 'us-east-1',
      'version' => 'latest'
  ]);
?>

<h1>Header</h1>
<p>Should test to ensure the credentials are actually working.</p>
