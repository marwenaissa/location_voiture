<?php

namespace App\Tests\Entity;

use App\Entity\Client;
use App\Entity\Location;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientEntity()
    {
        $client = new Client();

        // Test de l'ID (par défaut null, car généré automatiquement)
        $this->assertNull($client->getId());

        // Test des propriétés `nom`, `prenom`, `adresse`, `cin`
        $client->setNom('Doe');
        $this->assertEquals('Doe', $client->getNom());

        $client->setPrenom('John');
        $this->assertEquals('John', $client->getPrenom());

        $client->setAdresse('123 rue Exemple');
        $this->assertEquals('123 rue Exemple', $client->getAdresse());

        $client->setCin('AB123456');
        $this->assertEquals('AB123456', $client->getCin());

        // Test de la relation OneToMany avec Location
        $location1 = new Location();
        $location2 = new Location();

        // Ajout d'une Location au client
        $client->addLocation($location1);
        $this->assertCount(1, $client->getLocations());
        $this->assertTrue($client->getLocations()->contains($location1));
        $this->assertEquals($client, $location1->getClient());

        // Ajout d'une autre Location
        $client->addLocation($location2);
        $this->assertCount(2, $client->getLocations());

        // Suppression d'une Location du client
        $client->removeLocation($location1);
        $this->assertCount(1, $client->getLocations());
        $this->assertFalse($client->getLocations()->contains($location1));
        $this->assertNull($location1->getClient());
    }
}
