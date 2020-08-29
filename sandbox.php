<?php
  require 'aws_sdk/aws-autoloader.php';
  //Create a S3Client
  $s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => 'us-east-2'
  ]);
?>

<p>Hello</p>

<?php echo $s3 ?>
