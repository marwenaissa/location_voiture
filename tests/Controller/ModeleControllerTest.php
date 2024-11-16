<?php

namespace App\Tests\Controller;

use App\Entity\Modele;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ModeleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        // Créer un client HTTP pour faire des requêtes à notre application Symfony
        $client = static::createClient();

        // Accéder à la page d'index des modèles
        $client->request('GET', '/modele');

        // Vérifier que la réponse est correcte (code HTTP 200)
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Vérifier que la page contient un titre de modèle (ou autre élément spécifique à la page d'index)
        $this->assertSelectorTextContains('h1', 'Modele liste');
    }

    public function testNew()
    {
        $client = static::createClient();
    
        // Simulate visiting the page to add a new Modele
        $crawler = $client->request('GET', '/modele/new');
        $this->assertResponseIsSuccessful();
        
        // Fill in the form fields with some test data
        $form = $crawler->selectButton('Save')->form([
            'modele[libelle]' => 'New Modele',
            'modele[pays]' => 'Tunisie',
        ]);
    
        // Submit the form and follow the redirect
        $client->submit($form);
        
        // Check if the redirection happens after submitting the form
        $this->assertResponseRedirects('/modele');
        
        // Follow the redirection
        $client->followRedirect();
        
        // You can also add assertions here to verify the new mode is visible in the list
        $this->assertSelectorTextContains('h1', 'Modele liste');
    }
    

   

    

    
}
