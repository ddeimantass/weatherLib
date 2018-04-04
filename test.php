<?php

require_once "vendor/autoload.php";

use Nfq\Weather\Location;
use Nfq\Weather\YahooWeatherProvider;
use Nfq\Weather\WeatherProviderInterface;
use Nfq\Weather\OpenWeatherMapWeatherProvider;
use Nfq\Weather\DelegatingWeatherProvider;

class test{
    public static function temp(WeatherProviderInterface $provider)
    {
        $cities = array("Vilnius", "Klaipėda", "London", "Rome");
        foreach ($cities as $city){
            $location = new Location($city);
            $weather = $provider->fetch($location);
            echo "Temperatūra (".$city.") yra: ".$weather->getTemp()." laipsnių Celsijaus".PHP_EOL;
        }

    }
}


$yahoo = new YahooWeatherProvider;
$owm = new OpenWeatherMapWeatherProvider;
$delegate = new DelegatingWeatherProvider(array($yahoo, $owm));
test::temp($delegate);

