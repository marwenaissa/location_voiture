<?php

namespace App\Tests\Entity;

use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class ModeleTest extends TestCase
{
    public function testModeleEntity()
    {
        $modele = new Modele();

        // Test `id` (par défaut null, car généré automatiquement)
        $this->assertNull($modele->getId());

        // Test `libelle`
        $libelle = 'SUV';
        $modele->setLibelle($libelle);
        $this->assertEquals($libelle, $modele->getLibelle());

        // Test `pays`
        $pays = 'France';
        $modele->setPays($pays);
        $this->assertEquals($pays, $modele->getPays());

        // Test relation avec `Voiture`
        $voiture1 = new Voiture();
        $voiture2 = new Voiture();

        $modele->addVoiture($voiture1);
        $this->assertCount(1, $modele->getVoitures());
        $this->assertTrue($modele->getVoitures()->contains($voiture1));
        $this->assertEquals($modele, $voiture1->getModele());

        $modele->addVoiture($voiture2);
        $this->assertCount(2, $modele->getVoitures());

        $modele->removeVoiture($voiture1);
        $this->assertCount(1, $modele->getVoitures());
        $this->assertFalse($modele->getVoitures()->contains($voiture1));
        $this->assertNull($voiture1->getModele());
    }
}
