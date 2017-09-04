<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 04.09.17
 * Time: 16:58
 */

namespace Processor;

use \BoardingCards\AbstractVehicleBoardingCard;

class Sorter
{
    /**
     * @var array of BoardingCards
     */
    private $cards = [];

    public function addBoardingCard(AbstractVehicleBoardingCard $card)
    {
        $this->cards[] = $card;
    }

    /**
     * Sort cards into $cards property of this class
     */
    public function sort()
    {
        $cards = $this->cards;
        $output = [];

        /** @var AbstractVehicleBoardingCard $current */
        while (($current = array_shift($cards)) !== null) {

        }

    }

    public function getSortedCards()
    {
        return $this->cards;
    }
}
