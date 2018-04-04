<?php

namespace Nfq\Weather;

class Location
{

    private $city;

	public function __construct(string $city)
    {
        $this->city = $city;
    }

    public function getCity(){
	    return $this->city;
    }


}