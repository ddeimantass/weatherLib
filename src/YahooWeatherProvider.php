<?php

namespace Nfq\Weather;

class YahooWeatherProvider implements WeatherProviderInterface
{
    public function fetch(Location $location) : Weather
    {
        $where = "woeid in (select woeid from geo.places(1) where text='".$location->getCity()."') and u='c'";
        $yql = "select item.condition.temp from weather.forecast where ".$where;
        $url = "https://query.yahooapis.com/v1/public/yql?q=" . urlencode($yql) . "&format=json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        if(!isset($obj->query->results->channel->item->condition->temp)){
            throw new WeatherProviderException('Nepavyko gauti YahooWeatherProvider orų');
        }

        $weather = new Weather();
        $weather->setTemp($obj->query->results->channel->item->condition->temp);
        return $weather;

    }

}