<?php

namespace Nfq\Weather;

class OpenWeatherMapWeatherProvider implements WeatherProviderInterface
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function fetch(Location $location) : Weather
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=".urlencode($location->getCity())."&units=metric&appid=".$this->apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        if(!isset($obj->main->temp)){
            throw new WeatherProviderException('Failed to get OpenWeatherMapWeatherProvider weather');
        }

        $weather = new Weather();
        $weather->setTemp($obj->main->temp);
        return $weather;
    }

}