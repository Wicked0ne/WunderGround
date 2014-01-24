<?php
/**
 * WunderGround
 * Authored by: Mike
 * Date: 1/24/14
 * Time: 4:24 PM
 */
class WeatherForcast implements JsonSerializable
{

    //The vars
    private $wunderground_icon;

    private $errorType;
    private $errorDescription;

    //look up location vars
    private $city;
    private $state;
    private $country;
    private $zip;
    private $lat;
    private $long;
    private $elevation;

    //observation station vars
    private $station_id;
    private $ob_city;
    private $ob_state;
    private $ob_country;
    private $ob_lat;
    private $ob_long;
    private $ob_elevation;
    private $observation_time;
    private $observation_epoch;
    private $weather_icon;
    private $weather_icon_url;
    private $local_time_rfc822;
    private $local_epoch;

    //current weather vars
    private $temp_F;
    private $temp_C;
    private $tempStr;
    private $weather;
    private $windStr;
    private $wind_dir;
    private $wind_degrees;
    private $wind_MPH;
    private $wind_gust_MPH;
    private $wind_KPH;
    private $wind_gust_KPH;
    private $visibility_MI;
    private $visibility_KM;
    private $precip_1hr_Str;
    private $precip_1hr_IN;
    private $precip_1hr_Metric;
    private $precip_today_Str;
    private $precip_today_IN;
    private $precip_today_Metric;
    private $windchill_F;
    private $windchill_C;
    private $windchill_Str;
    private $feelsLike_F;
    private $feelsLike_C;
    private $feelsLike_Str;
    private $relativeHumidity;

    //forecast vars
    private $todaysHigh_F;
    private $todaysLow_F;
    private $todaysHigh_C;
    private $todaysLow_C;
    private $todaysWeather;
    private $todaysWind_MPH;
    private $todaysWind_KPH;

    //empty construct for now
    public function __construct()
    {
    }

    //we need this to be able to pass our object to javascript in json format.
    public function jsonSerialize()
    {
        return [

            'wunderground_icon' => $this->getWundergroundIcon(),
            'errorType' => $this->getErrorType(),
            'errorDescription' => $this->getErrorDescription(),
            'city' => $this->getCity(),
            'state' => $this->getState(),
            'country' => $this->getCountry(),
            'zip' => $this->getZip(),
            'lat' => $this->getLatitude(),
            'long' => $this->getLongitude(),
            'elevation' => $this->getElevation(),
            'station_id' => $this->getStationID(),
            'ob_city' => $this->getObCity(),
            'ob_state' => $this->getObState(),
            'ob_country' => $this->getObCountry(),
            'ob_lat' => $this->getObLatitude(),
            'ob_long' => $this->getObLongitude(),
            'ob_elevation' => $this->getObElevation(),
            'observation_time' => $this->getObservationTime(),
            'observation_epoch' => $this->getObservationEpoch(),
            'weather_icon' => $this->getWeatherIcon(),
            'weather_icon_url' => $this->getWeatherIconURL(),
            'local_time_rfc822' => $this->getLocalTime_rfc822(),
            'local_epoch' => $this->getLocalEpoch(),
            'temp_f' => $this->getTemp_F(),
            'temp_c' => $this->getTemp_C(),
            'tempStr' => $this->getTempStr(),
            'weather' => $this->getWeather(),
            'windStr' => $this->getWindStr(),
            'wind_dir' => $this->getWindDir(),
            'wind_degrees' => $this->getWindDegrees(),
            'wind_MPH' => $this->getWind_MPH(),
            'wind_gust_MPH' => $this->getWind_Gust_MPH(),
            'wind_KPH' => $this->getWind_KPH(),
            'wind_gust_KPH' => $this->getWind_Gust_KPH(),
            'visibility_MI' => $this->getVisibility_MI(),
            'visibility_KM' => $this->getVisibility_KM(),
            'precip_1hr_Str' => $this->getPrecip_1hr_Str(),
            'precip_1hr_IN' => $this->getPrecip_1hr_IN(),
            'precip_1hr_Metric' => $this->getPrecip_1hr_Metric(),
            'precip_today_Str' => $this->getPrecipToday_Str(),
            'precip_today_IN' => $this->getPrecipToday_IN(),
            'precip_today_Metric' => $this->getPrecipToday_Metric(),
            'windchill_F' => $this->getWindchill_F(),
            'windchill_C' => $this->getWindchill_C(),
            'windchill_Str' => $this->getWindchill_Str(),
            'feelsLike_F' => $this->getFeelsLike_F(),
            'feelsLike_C' => $this->getFeelsLike_C(),
            'feelsLike_Str' => $this->getFeelsLike_Str(),
            'relativeHumidity' => $this->getRelativeHumidity(),
            'todaysHigh_F' => $this->getTodaysHigh_F(),
            'todaysLow_F' => $this->getTodaysLow_F(),
            'todaysHigh_C' => $this->getTodaysHigh_C(),
            'todaysLow_C' => $this->getTodaysLow_C(),
            'todaysWeather' => $this->getTodaysWeather(),
            'todaysWind_MPH' => $this->getTodaysWind_MPH(),
            'todaysWind_KPH' => $this->getTodaysWind_KPH()
        ];
    }

    //all the gets and sets.
    public function getWundergroundIcon()
    {
        return $this->wunderground_icon;
    }

    public function setWundergroundIcon($wunderground_icon)
    {
        $this->wunderground_icon = $wunderground_icon;
    }

    public function getErrorType()
    {
        return $this->errorType;
    }

    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;
    }

    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    public function setErrorDescription($errorDescription)
    {
        $this->errorDescription = $errorDescription;
    }


    //lookup location
    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getLatitude()
    {
        return $this->lat;
    }

    public function setLatitude($lat)
    {
        $this->lat = $lat;
    }

    public function getLongitude()
    {
        return $this->long;
    }

    public function setLongitude($long)
    {
        $this->long = $long;
    }

    public function getElevation()
    {
        return $this->elevation;
    }

    public function setElevation($elevation)
    {
        $this->elevation = $elevation;
    }

    //observation gets and sets
    public function getObCity()
    {
        return $this->ob_city;
    }

    public function setObCity($ob_city)
    {
        $this->ob_city = $ob_city;
    }

    public function getObState()
    {
        return $this->ob_state;
    }

    public function setObState($ob_state)
    {
        $this->ob_state = $ob_state;
    }

    public function getObCountry()
    {
        return $this->ob_country;
    }

    public function setObCountry($ob_country)
    {
        $this->ob_country = $ob_country;
    }

    public function getObLatitude()
    {
        return $this->ob_lat;
    }

    public function setObLatitude($ob_lat)
    {
        $this->ob_lat = $ob_lat;
    }

    public function getObLongitude()
    {
        return $this->ob_long;
    }

    public function setObLongitude($ob_long)
    {
        $this->ob_long = $ob_long;
    }

    public function getObElevation()
    {
        return $this->ob_elevation;
    }

    public function setObElevation($ob_elevation)
    {
        $this->ob_elevation = $ob_elevation;
    }

    public function getStationID()
    {
        return $this->station_id;
    }

    public function setStationID($station_id)
    {
        $this->station_id = $station_id;
    }

    public function getObservationTime()
    {
        return $this->observation_time;
    }

    public function setObservationTime($observation_time)
    {
        $this->observation_time = $observation_time;
    }

    public function getObservationEpoch()
    {
        return $this->observation_epoch;
    }

    public function setObservationEpoch($observation_epoch)
    {
        $this->observation_epoch = $observation_epoch;
    }

    public function getWeatherIcon()
    {
        return $this->weather_icon;
    }

    public function setWeatherIcon($weather_icon)
    {
        $this->weather_icon = $weather_icon;
    }

    public function getWeatherIconURL()
    {
        return $this->weather_icon_url;
    }

    public function setWeatherIconURL($weather_icon_url)
    {
        $this->weather_icon_url = $weather_icon_url;
    }

    public function getLocalTime_rfc822()
    {
        return $this->local_time_rfc822;
    }

    public function setLocalTime_rfc822($local_time_rfc822)
    {
        $this->local_time_rfc822 = $local_time_rfc822;
    }

    public function getLocalEpoch()
    {
        return $this->local_epoch;
    }

    public function setLocalEpoch($local_epoch)
    {
        $this->local_epoch = $local_epoch;
    }

    //current weather gets and sets
    public function getTemp_F()
    {
        return $this->temp_F;
    }

    public function setTemp_F($temp_F)
    {
        $this->temp_F = $temp_F;
    }

    public function getTemp_C()
    {
        return $this->temp_C;
    }

    public function setTemp_C($temp_C)
    {
        $this->temp_C = $temp_C;
    }

    public function getTempStr()
    {
        return $this->tempStr;
    }

    public function setTempStr($tempStr)
    {
        $this->tempStr = $tempStr;
    }

    public function getWeather()
    {
        return $this->weather;
    }

    public function setWeather($weather)
    {
        $this->weather = $weather;
    }

    public function getWindStr()
    {
        return $this->windStr;
    }

    public function setWindStr($windStr)
    {
        $this->windStr = $windStr;
    }

    public function getWindDir()
    {
        return $this->wind_dir;
    }

    public function setWindDir($wind_dir)
    {
        $this->wind_dir = $wind_dir;
    }

    public function getWindDegrees()
    {
        return $this->wind_degrees;
    }

    public function setWindDegrees($wind_degrees)
    {
        $this->wind_degrees = $wind_degrees;
    }

    public function getWind_MPH()
    {
        return $this->wind_MPH;
    }

    public function setWind_MPH($wind_MPH)
    {
        $this->wind_MPH = $wind_MPH;
    }

    public function getWind_Gust_MPH()
    {
        return $this->wind_gust_MPH;
    }

    public function setWind_Gust_MPH($wind_gust_MPH)
    {
        $this->wind_gust_MPH = $wind_gust_MPH;
    }

    public function getWind_KPH()
    {
        return $this->wind_KPH;
    }

    public function setWind_KPH($wind_KPH)
    {
        $this->wind_KPH = $wind_KPH;
    }

    public function getWind_Gust_KPH()
    {
        return $this->wind_gust_KPH;
    }

    public function setWind_Gust_KPH($wind_gust_KPH)
    {
        $this->wind_gust_KPH = $wind_gust_KPH;
    }

    public function getVisibility_MI()
    {
        return $this->visibility_MI;
    }

    public function setVisibility_MI($visibility_MI)
    {
        $this->visibility_MI = $visibility_MI;
    }

    public function getVisibility_KM()
    {
        return $this->visibility_KM;
    }

    public function setVisibility_KM($visibility_KM)
    {
        $this->visibility_KM = $visibility_KM;
    }

    public function getPrecip_1hr_Str()
    {
        return $this->precip_1hr_Str;
    }

    public function setPrecip_1hr_Str($precip_1hr_Str)
    {
        $this->precip_1hr_Str = $precip_1hr_Str;
    }

    public function getPrecip_1hr_IN()
    {
        return $this->precip_1hr_IN;
    }

    public function setPrecip_1hr_IN($precip_1hr_IN)
    {
        $this->precip_1hr_IN = $precip_1hr_IN;
    }

    public function getPrecip_1hr_Metric()
    {
        return $this->precip_1hr_Metric;
    }

    public function setPrecip_1hr_Metric($precip_1hr_Metric)
    {
        $this->precip_1hr_Metric = $precip_1hr_Metric;
    }

    public function getPrecipToday_Str()
    {
        return $this->precip_today_Str;
    }

    public function setPrecipToday_Str($precip_today_Str)
    {
        $this->precip_today_Str = $precip_today_Str;
    }

    public function getPrecipToday_IN()
    {
        return $this->precip_today_IN;
    }

    public function setPrecipToday_IN($precip_today_IN)
    {
        $this->precip_today_IN = $precip_today_IN;
    }

    public function getPrecipToday_Metric()
    {
        return $this->precip_today_Metric;
    }

    public function setPrecipToday_Metric($precip_today_Metric)
    {
        $this->precip_today_Metric = $precip_today_Metric;
    }

    public function getWindchill_F()
    {
        return $this->windchill_F;
    }

    public function setWindchill_F($windchill_F)
    {
        $this->windchill_F = $windchill_F;
    }

    public function getWindchill_C()
    {
        return $this->windchill_C;
    }

    public function setWindchill_C($windchill_C)
    {
        $this->windchill_C = $windchill_C;
    }

    public function getWindchill_Str()
    {
        return $this->windchill_Str;
    }

    public function setWindchill_Str($windchill_Str)
    {
        $this->windchill_Str = $windchill_Str;
    }

    public function getFeelsLike_F()
    {
        return $this->feelsLike_F;
    }

    public function setFeelsLike_F($feelsLike_F)
    {
        $this->feelsLike_F = $feelsLike_F;
    }

    public function getFeelsLike_C()
    {
        return $this->feelsLike_C;
    }

    public function setFeelsLike_C($feelsLike_C)
    {
        $this->feelsLike_C = $feelsLike_C;
    }

    public function getFeelsLike_Str()
    {
        return $this->feelsLike_Str;
    }

    public function setFeelsLike_Str($feelsLike_Str)
    {
        $this->feelsLike_Str = $feelsLike_Str;
    }

    public function getRelativeHumidity()
    {
        return $this->relativeHumidity;
    }

    public function setRelativeHumidity($relativeHumidity)
    {
        $this->relativeHumidity = $relativeHumidity;
    }

    //forcast for today
    public function getTodaysHigh_F()
    {
        return $this->todaysHigh_F;
    }

    public function setTodaysHigh_F($todaysHigh_F)
    {
        $this->todaysHigh_F = $todaysHigh_F;
    }

    public function getTodaysLow_F()
    {
        return $this->todaysLow_F;
    }

    public function setTodaysLow_F($todaysLow_F)
    {
        $this->todaysLow_F = $todaysLow_F;
    }

    public function getTodaysHigh_C()
    {
        return $this->todaysHigh_C;
    }

    public function setTodaysHigh_C($todaysHigh_C)
    {
        $this->todaysHigh_C = $todaysHigh_C;
    }

    public function getTodaysLow_C()
    {
        return $this->todaysLow_C;
    }

    public function setTodaysLow_C($todaysLow_C)
    {
        $this->todaysLow_C = $todaysLow_C;
    }

    public function getTodaysWeather()
    {
        return $this->todaysWeather;
    }

    public function setTodaysWeather($todaysWeather)
    {
        $this->todaysWeather = $todaysWeather;
    }

    public function getTodaysWind_MPH()
    {
        return $this->todaysWind_MPH;
    }

    public function setTodaysWind_MPH($todaysWind_MPH)
    {
        $this->todaysWind_MPH = $todaysWind_MPH;
    }

    public function getTodaysWind_KPH()
    {
        return $this->todaysWind_KPH;
    }

    public function setTodaysWind_KPH($todaysWind_KPH)
    {
        $this->todaysWind_KPH = $todaysWind_KPH;
    }

}
