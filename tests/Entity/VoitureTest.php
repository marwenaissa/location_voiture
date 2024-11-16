<?php

namespace App\Tests\Entity;

use App\Entity\Location;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class VoitureTest extends TestCase
{
    public function testVoitureEntity()
    {
        $voiture = new Voiture();

        // Test `id` (par défaut null, car généré automatiquement)
        $this->assertNull($voiture->getId());

        // Test `serie`
        $serie = '123ABC456';
        $voiture->setSerie($serie);
        $this->assertEquals($serie, $voiture->getSerie());

        // Test `dateMM`
        $dateMM = new \DateTime('2024-01-01');
        $voiture->setDateMM($dateMM);
        $this->assertEquals($dateMM, $voiture->getDateMM());

        // Test `prixJour`
        $prixJour = 75.50;
        $voiture->setPrixJour($prixJour);
        $this->assertEquals($prixJour, $voiture->getPrixJour());

        // Test relation avec `Location`
        $location1 = new Location();
        $location2 = new Location();

        $voiture->addLocation($location1);
        $this->assertCount(1, $voiture->getLocations());
        $this->assertTrue($voiture->getLocations()->contains($location1));
        $this->assertEquals($voiture, $location1->getVoiture());

        $voiture->addLocation($location2);
        $this->assertCount(2, $voiture->getLocations());

        $voiture->removeLocation($location1);
        $this->assertCount(1, $voiture->getLocations());
        $this->assertFalse($voiture->getLocations()->contains($location1));
        $this->assertNull($location1->getVoiture());

        // Test relation avec `Modele`
        $modele = new Modele();
        $voiture->setModele($modele);
        $this->assertEquals($modele, $voiture->getModele());
    }
}
