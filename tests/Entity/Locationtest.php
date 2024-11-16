<?php

namespace App\Tests\Entity;

use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Voiture;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testLocationEntity()
    {
        $location = new Location();

        // Test `id` (par défaut null, car généré automatiquement)
        $this->assertNull($location->getId());

        // Test `dateD`
        $dateD = new \DateTime('2024-01-01');
        $location->setDateD($dateD);
        $this->assertEquals($dateD, $location->getDateD());

        // Test `dateA`
        $dateA = new \DateTime('2024-01-10');
        $location->setDateA($dateA);
        $this->assertEquals($dateA, $location->getDateA());

        // Test `prix`
        $prix = 150.75;
        $location->setPrix($prix);
        $this->assertEquals($prix, $location->getPrix());

        // Test relation avec `Client`
        $client = new Client();
        $location->setClient($client);
        $this->assertEquals($client, $location->getClient());

        // Test relation avec `Voiture`
        $voiture = new Voiture();
        $location->setVoiture($voiture);
        $this->assertEquals($voiture, $location->getVoiture());
    }
}
