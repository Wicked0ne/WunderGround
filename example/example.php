<?php
/**
 * WunderGround
 * Authored by: Mike
 * Date: 1/24/14
 * Time: 4:29 PM
 */

//run php example.php

//we need this to get the weather
require_once('../classes/class.WunderGround.php');

//location...duh
$location = "02127";
//$location = "boston, ma";
//$location = "42.338562,-71.03538";

//get Wunderground object
$wunderground = new WunderGround();

//populate wunderground object with weather data
$weather = $wunderground->getForcstFromZipCode($location);
//$weather = $wunderground->getForcstFromCityState($location);
//$weather = $wunderground->getForcastFromLatLong($location);


//just an example of how to get some data
echo "Temp in F: " . $weather->getTemp_F() . "\r\n";

//full object dump
print_r($weather);
