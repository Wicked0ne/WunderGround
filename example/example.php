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
$zipcode = "02127";
//$citystate = "boston, ma";
//$lat = "42.338562";
//$long= "-71.03538";

//get Wunderground object
$wunderground = new WunderGround();

//populate wunderground object with weather data
$weather = $wunderground->getWeatherFromZipCode($zipcode);
//$weather = $wunderground->getWeatherFromCityState($citystate);
//$weather = $wunderground->getWeatherFromLatLong($lat, $long);


/*just an example of how to get some data. This is not ideal but will work for now. If we get an array back
 *that means there was a error.
 */
if (is_array($weather)) {
    //nothing found and we got a error
    echo $weather['error_msg'];
} else {
    echo "Temp in F: " . $weather->getTemp_F() . "\r\n";
}


//full object dump
print_r($weather);
