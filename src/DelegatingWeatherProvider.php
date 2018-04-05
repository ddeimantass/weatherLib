<?php

namespace Nfq\Weather;

class DelegatingWeatherProvider implements WeatherProviderInterface
{
    private $providers = array();

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function fetch(Location $location) : Weather
	{
	    foreach ($this->providers as $provider){
            try {
                return $provider->fetch($location);
            } catch (WeatherProviderException $e) {
            }
        }
        throw new WeatherProviderException('Nepavyko gauti DelegatingWeatherProvider orų');

	}

}