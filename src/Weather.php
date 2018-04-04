<?php

namespace Nfq\Weather;

class Weather
{
	private $temp;

    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    public function getTemp() : int
    {
        return $this->temp;
    }
}