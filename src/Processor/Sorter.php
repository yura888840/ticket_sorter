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
        $found = false;
        $cards = $this->cards;

        $k = 0;
        while (!$found) {
            /** @var AbstractVehicleBoardingCard $current */
            $rootNode = array_shift($cards);

            $cardsProcessing = $this->cards;
            unset($cardsProcessing[$k]);

            $found = true;
            /** @var AbstractVehicleBoardingCard $card */
            foreach ($cardsProcessing as $card) {
                if ($card->arrival == $rootNode->departure) {
                    $found = false;
                    break;
                }
            }
            $k++;
        }

        $sorted     = [];
        $sorted[]   = $rootNode;
        $cards      = [];

        foreach ($this->cards as $value) {
            if ($value != $rootNode) {
                $cards[] = $value;
            }
        }

        while (!empty($cards)) {
            /** @var AbstractVehicleBoardingCard $value */
            foreach ($cards as $k => $value) {
                if ($rootNode->arrival == $value->departure) {
                    $sorted[] = $value;
                    unset($cards[$k]);

                    $rootNode = $value;
                    break;
                }
            }
        }

        $this->cards = $sorted;
    }

    public function getSortedCards()
    {
        return $this->cards;
    }
}
