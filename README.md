# sensor-website
This is a weather station frontend based on PHP that creates a webpage and graphs from the sensor data, stored in Google Cloud Datastore.

See [https://github.com/comp500/sensor-reporter](https://github.com/comp500/sensor-reporter) for more information about how this works.

## Setup
Currently this is made to run on Google App Engine, but should work on other PHP installations (e.g. Apache + PHP) as well. You may need to write a .htaccess file (or equivalent for Nginx etc.) to map the URLs to PHP files, as stated in app.yaml.

## Requirements
- PHP-GDS v3 (installable using Composer)
- Smarty v3.1 (installable using Composer)
