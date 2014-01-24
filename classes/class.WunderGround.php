<?php
/**
 * WunderGround
 * Authored by: Mike
 * Date: 1/24/14
 * Time: 4:26 PM
 */

require_once(dirname(__FILE__) . '/../config/config.php');
require_once('class.WeatherForcast.php');

//wunderground api key APIKEY

class WunderGround
{
    //empty construct for now.
    public function __construct()
    {
    }

    /**
     * @param $json The retrived json string from wunderground's web servers via file_get_contents
     * @return WeatherForcast The WeatherForcast object that contains all the get* methods.
     */
    private function getWeather($json)
    {
        $weather = new WeatherForcast();
        $parsed_json = json_decode($json);

        //switch over all the sets to use this....some simple testing showed this was faster.
        $current_ob = $parsed_json->{'current_observation'};
        $todays_forcast = $parsed_json->forecast->simpleforecast->forecastday[0];
        //lets get and set all the values.

        $weather->setWundergroundIcon($current_ob->{'image'}->{'url'});
        $weather->setErrorType($parsed_json->{'response'}->{'error'}->{'type'});
        $weather->setErrorDescription($parsed_json->{'response'}->{'error'}->{'description'});

        //lookup values i.e the user input 02360(plymouth ma) so this is the info for plymouth ma...not the actual station(which could be in like kingston)
        $weather->setCity($current_ob->{'display_location'}->{'city'});
        $weather->setState($current_ob->{'display_location'}->{'state'});
        $weather->setCountry($current_ob->{'display_location'}->{'country'});
        $weather->setZip($current_ob->{'display_location'}->{'zip'});
        $weather->setLatitude($current_ob->{'display_location'}->{'latitude'});
        $weather->setLongitude($current_ob->{'display_location'}->{'longitude'});
        $weather->setElevation($current_ob->{'display_location'}->{'elevation'});

        //observation station values
        $weather->setStationID($current_ob->{'station_id'});
        $weather->setObCity($current_ob->{'observation_location'}->{'city'});
        $weather->setObState($current_ob->{'observation_location'}->{'state'});
        $weather->setObCountry($current_ob->{'observation_location'}->{'country'});
        $weather->setObLatitude($current_ob->{'observation_location'}->{'latitude'});
        $weather->setObLongitude($current_ob->{'observation_location'}->{'longitude'});
        $weather->setObElevation($current_ob->{'observation_location'}->{'elevation'});
        $weather->setObservationTime($current_ob->{'observation_time'});
        $weather->setObservationEpoch($current_ob->{'observation_epoch'});
        $weather->setLocalTime_rfc822($current_ob->{'local_time_rfc822'});
        $weather->setLocalEpoch($current_ob->{'local_epoch'});

        //current weather values
        $weather->setWeatherIcon($current_ob->{'icon'});
        $weather->setWeatherIconURL($current_ob->{'icon_url'});
        $weather->setTemp_F($current_ob->{'temp_f'});
        $weather->setTemp_C($current_ob->{'temp_c'});
        $weather->setTempStr($current_ob->{'temperature_string'});
        $weather->setWeather($current_ob->{'weather'});
        $weather->setWindchill_F($current_ob->{'windchill_f'});
        $weather->setWindchill_C($current_ob->{'windchill_c'});
        $weather->setWindchill_Str($current_ob->{'windchill_string'});
        $weather->setWind_MPH($current_ob->{'wind_mph'});
        $weather->setWind_KPH($current_ob->{'wind_kph'});
        $weather->setWindStr($current_ob->{'wind_string'});
        $weather->setWindDir($current_ob->{'wind_dir'});
        $weather->setWindDegrees($current_ob->{'wind_degrees'});
        $weather->setWind_Gust_MPH($current_ob->{'wind_gust_mph'});
        $weather->setWind_Gust_KPH($current_ob->{'wind_gust_kph'});
        $weather->setVisibility_MI($current_ob->{'visibility_mi'});
        $weather->setVisibility_KM($current_ob->{'visibility_km'});
        $weather->setPrecip_1hr_Str($current_ob->{'precip_1hr_string'});
        $weather->setPrecip_1hr_IN($current_ob->{'precip_1hr_in'});
        $weather->setPrecip_1hr_Metric($current_ob->{'precip_1hr_metric'});
        $weather->setPrecipToday_Str($current_ob->{'precip_today_string'});
        $weather->setPrecipToday_IN($current_ob->{'precip_today_in'});
        $weather->setPrecipToday_Metric($current_ob->{'precip_today_metric'});
        $weather->setFeelsLike_F($current_ob->{'feelslike_f'});
        $weather->setFeelsLike_C($current_ob->{'feelslike_c'});
        $weather->setFeelsLike_Str($current_ob->{'feelslike_string'});
        $weather->setRelativeHumidity($current_ob->{'relative_humidity'});

        //forecast weather values
        $weather->setTodaysHigh_F($todays_forcast->{'high'}->{'fahrenheit'});
        $weather->setTodaysLow_F($todays_forcast->{'low'}->{'fahrenheit'});
        $weather->setTodaysHigh_C($todays_forcast->{'high'}->{'celsius'});
        $weather->setTodaysLow_C($todays_forcast->{'low'}->{'celsius'});
        $weather->setTodaysWeather($todays_forcast->{'conditions'});
        $weather->setTodaysWind_MPH($todays_forcast->{'avewind'}->{'mph'});
        $weather->setTodaysWind_KPH($todays_forcast->{'avewind'}->{'kph'});

        return $weather;
    }//end getWeather()

    /**
     * @param $zipcode string US Zipcode in format of 12345 or 12345-1234
     * @return array|WeatherForcast If zipcode is found it returns a WeatherForcast object else it returns an error array
     */
    public function getForcstFromZipCode($zipcode)
    {
        //this checks for zipcodes i the form of 12345 or 12345-1234
        if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", trim($zipcode))) {
            //get file contents
            $json_string = file_get_contents("http://api.wunderground.com/api/" . APIKEY . "/geolookup/conditions/forecast/q/" . trim($zipcode) . ".json");

            return $this->getWeather($json_string);
        } else {
            //no zipcode found
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }//end getForcstFromZipCode()

    /**
     * @param $cityState string Expects city and state in the following formats: city st, city,st, city, st
     * @return array|WeatherForcast If a city,st is found it returns a WeatherForcast object else it returns an error array
     */
    public function getForcstFromCityState($cityState)
    {
        $loc = $this->checkForCityState($cityState);

        if (!empty($loc)) { //expects city st
            //look up via city, st
            $json_string = file_get_contents("http://api.wunderground.com/api/" . APIKEY . "/geolookup/conditions/forecast/q/" . $loc['state'] . "/" . $loc['city'] . ".json");

            return $this->getWeather($json_string);
        } else { //nothing matched
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }//end getForcstFromCityState()

    /**
     * @param $lat string Latitude
     * @param $long string Longitude
     * @return array|WeatherForcast If both params are floats it returns a WeatherForcast object else it returns an error array
     */
    public function getForcastFromLatLong($lat, $long)
    {
        //this checks for zipcodes i the form of 12345 or 12345-1234
        if (is_float(floatval($lat)) and is_float(floatval($long))) {
            //do zipcode lookup
            $json_string = file_get_contents("http://api.wunderground.com/api/" . APIKEY . "/geolookup/conditions/forecast/q/" . trim($lat) . "," . trim($long) . ".json");

            return $this->getWeather($json_string);
        } else {
            //no zipcode found
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }//end getForcastFromLatLong()

    /* takes input like: city,st city, st city st
    parses out standard input in the format of: city st
    returns assoc array $loc['state'] $loc['city']
 */
    /* check for matches for: city,st ; city, st ; city st and returns an assoc array*/
    function checkForCityState($cityst)
    {
        //matches someplace,ma
        if (preg_match("/^([a-z]+),([a-z]{2})$/i", trim($cityst), $pmatch)) {
            return array(
                "city" => $pmatch[1], "state" => $pmatch[2],
            );
        } //matches someplace, ma
        elseif (preg_match("/^([a-z]+),\s+([a-z]{2})$/i", trim($cityst), $pmatch)) {
            return array(
                "city" => $pmatch[1], "state" => $pmatch[2],
            );
        } //matches someplace ma
        elseif (preg_match("/^([a-z]+)\s+([a-z]{2})$/i", trim($cityst), $pmatch)) {
            return array(
                "city" => $pmatch[1], "state" => $pmatch[2],
            );
        }
    }

}//end wunderground class