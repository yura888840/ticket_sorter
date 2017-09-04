<?php

namespace BoardingCards;

/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 04.09.17
 * Time: 16:51
 */
abstract class AbstractVehicleBoardingCard
{
    public $departure;

    public $arrival;

    protected $boardingData;

    public function __construct(string $from, string $to, string $boardingData)
    {
        $this->departure    = $from;
        $this->arrival      = $to;
        $this->boardingData = $boardingData;
    }

    public function getBoardingData()
    {
        return $this->boardingData;
    }
}
