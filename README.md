# Cablecast-ReflectUlitization
Internal backend for ultiization reports, alerts and interface for Cablecast Reflect Customers.

For this, I am using the PHP SDK "home directory" Credential Profiles (https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_profiles.html).

## Getting the data
Running AWS CLI command ```aws ce get-cost-and-usage --time-period Start=2020-05-01,End=2020-06-01 --granularity MONTHLY --metrics "BlendedCost" --group-by Type=TAG,Key=NetsuiteID``` returns all customers with the "NetsuiteID" tag.

## Installing / Getting started
* Clone repo to a php enabled webserver of your choice with MySQL.
* test

## Configuration
TBD

## Links
* AWS for PHP SDK Version 3 https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html
* XAMPP https://www.apachefriends.org/
