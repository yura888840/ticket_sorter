<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 04.09.17
 * Time: 16:24
 */

require __DIR__ . '/vendor/autoload.php';

use BoardingCards\AbstractVehicleBoardingCard;
use BoardingCards\Train;
use BoardingCards\Bus;
use BoardingCards\Flight;
use Processor\Sorter;

$sorter = new Sorter();

try {
    $sorter->addBoardingCard(new Train('Madrid', 'Barcelona', '78A seat 4B'));
    $sorter->addBoardingCard(new Bus('Barcelona', 'Georgia', 'no seat specified'));
    $sorter->addBoardingCard(new Flight('Georgia', 'Stockholm', 'Gate 45B, seat 3A. Baggage drop at ticket counter 344.'));
    $sorter->addBoardingCard(new Flight('Stockholm', 'New York JFK', 'Gate 22, seat 7B.Baggage will we automatically transferred from your last leg.'));

    $sorter->sort();

    $result = $sorter->getSortedCards();

    /** @var AbstractVehicleBoardingCard $boardingCard */
    foreach ($result as $boardingCard) {
        $boardingCardType = get_class($boardingCard);
        $boardingCardType = substr($boardingCardType, strpos($boardingCardType, '\\') + 1);
        $boardingCardType = strtolower($boardingCardType);

        echo sprintf(
            "Take %s from %s to %s. %s\n",
            $boardingCardType,
            $boardingCard->departure,
            $boardingCard->arrival,
            $boardingCard->getBoardingData()
        );
    }
    echo "You have arrived at your final destination.\n";
} catch (Exception $e) {
    var_dump($e);
}
