<?php

namespace Nfq\Weather;

interface WeatherProviderInterface
{
	public function fetch(Location $location) : Weather;

}