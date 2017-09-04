<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 04.09.17
 * Time: 17:45
 */
namespace Tests\Processor;

require __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Processor\Sorter;
use BoardingCards\AbstractVehicleBoardingCard;
use BoardingCards\Train;
use BoardingCards\Bus;
use BoardingCards\Flight;

class SorterTest extends TestCase
{
    /** @var  Sorter */
    private $service;

    private $expected = '[{"departure":"Madrid","arrival":"Barcelona"},{"departure":"Barcelona","arrival":"Georgia"},{"departure":"Georgia","arrival":"Stockholm"},{"departure":"Stockholm","arrival":"New York JFK"}]';

    public function setUp()
    {
        $this->service = new Sorter();
    }

    public function testSort()
    {
        $this->service->addBoardingCard(new Train('Madrid', 'Barcelona', '78A seat 4B'));
        $this->service->addBoardingCard(new Bus('Barcelona', 'Georgia', 'no seat specified'));
        $this->service->addBoardingCard(new Flight('Georgia', 'Stockholm', 'Gate 45B, seat 3A. Baggage drop at ticket counter 344.'));
        $this->service->addBoardingCard(new Flight('Stockholm', 'New York JFK', 'Gate 22, seat 7B.Baggage will we automatically transferred from your last leg.'));

        $this->service->sort();

        $actual = $this->service->getSortedCards();

        $this->assertEquals($this->expected, json_encode($actual));
    }
}