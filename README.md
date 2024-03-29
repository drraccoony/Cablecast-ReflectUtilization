# Cablecast-ReflectUtilization
Internal backend for ultiization reports, alerts and interface for Cablecast Reflect Customers.

For this, I am using PHP alongside the AWS PHP SDK w/ "home directory" [Credential Profile](https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_profiles.html) & MySQL for housing data locally for histroical reporting.

![DataModel](resources/DataModel.png)

## Getting the data
Running AWS CLI command ```aws ce get-cost-and-usage --time-period Start=2020-05-01,End=2020-06-01 --granularity MONTHLY --metrics "BlendedCost" --group-by Type=TAG,Key=NetsuiteID``` returns all customers with the "NetsuiteID" tag. This can be adapted to the PHP SDK for AWS by running:
```php
  $startdate = date("Y-m-j", strtotime( '-2 days' ));
  $enddate = date("Y-m-j", strtotime( '-1 days' ));
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
  ```
  More information on the syntax and parameters [here](https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ce-2017-10-25.html#getcostandusage).
  
## Installing / Getting started
Can't imagine this'll be useful for anyone outside our org. But just incase:
1. Clone repo to a webserver of your choice with MySQL and php extensions
2. Create database called `reflect_usage` and import `customer_usage.sql`
3. Rename `db_connect.php.default` to `db_connect.php`
4. Define db username and password in `db_connect.php`
5. Setup [AWS Credentials](https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_profiles.html).

# Tasks / Objectives
- [x] Create project & setup AWS PHP SDK
- [x] Setup credendial storage for AWS SDK
- [x] Use proper function to pull costUsage
   - [x] Write costUsage json to database
   - [ ] Setup `get_usage.php` to be a 4am CRON job
- [x] Create "Customers" table
   - [x] Tie customers to UsageReports
- [x] (Partially) Generate reports
- [ ] Generate email alerts

## Links
* AWS for PHP SDK Version 3 https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html
* XAMPP https://www.apachefriends.org/
* Bootstrap CSS 3.4 CDN - https://getbootstrap.com/docs/3.4/css/
* Font Awesome CDN - https://fontawesome.com/ 
