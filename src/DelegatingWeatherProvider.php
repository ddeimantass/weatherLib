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
            } catch (\Exception $e) {
            }
        }
        throw new \Exception('Nepavyko gauti DelegatingWeatherProvider orų');

	}

}