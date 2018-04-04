<?php

namespace Nfq\Weather;

class OpenWeatherMapWeatherProvider implements WeatherProviderInterface
{
    public function fetch(Location $location) : Weather
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=".$location->getCity()."&units=metric&appid=0e3a7cd2e11b8085734baf04d0fabaaa";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        if(!isset($obj->main->temp)){
            throw new \Exception('Nepavyko gauti OpenWeatherMapWeatherProvider orų');
        }

        $weather = new Weather();
        $weather->setTemp($obj->main->temp);
        return $weather;

    }

}