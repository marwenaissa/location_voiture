<?php
namespace App\Tests\Controller;
use App\Entity\Modele;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VoitureControllerTest extends WebTestCase
{
    public function testListeVoiture()
    {
        // Créer un client HTTP pour faire des requêtes à notre application Symfony
        $client = static::createClient();

        // Aller à la route '/voiture'
        $client->request('GET', '/voiture');

        // Vérifier que la page a bien répondu avec un code HTTP 200 (OK)
        $this->assertResponseStatusCodeSame(200);

         // Vérifier que la page contient un élément de la liste de voitures
         /* $this->assertSelectorExists('.voiture-item'); */  // Assurez-vous d'utiliser un sélecteur qui correspond à votre HTML
      
    }

    public function testFormulaireAjoutVoiture()
    {
        // Créer un client HTTP pour faire des requêtes à notre application Symfony
        $client = static::createClient();
    
        // Récupérer l'EntityManager à partir du conteneur de services Symfony
        $entityManager = self::getContainer()->get('doctrine')->getManager();
    
        // Créer et persister un modèle 'testmodele1'
        $modele = new Modele();
        $modele->setLibelle('testmodele1');
        $modele->setPays('Tunisie');  // Assurez-vous que 'setPays' est la méthode correcte
        $entityManager->persist($modele);
        $entityManager->flush();
    
        // Vérifier que le modèle a bien été persisté
        $this->assertNotNull($modele->getId(), 'Le modèle n\'a pas été persisté correctement.');
    
        // Accéder à la page d'ajout de voiture
        $crawler = $client->request('GET', '/addVoiture');
    
        // Vérifier que la page contient bien le formulaire avant de tenter de l'interagir
        $this->assertSelectorExists('form', 'Le formulaire n\'a pas été trouvé sur la page.');
    
       
        // Soumettre le formulaire avec des données fictives, y compris l'ID du modèle
        $form = $crawler->selectButton('Save')->form([
            'voiture[serie]' => 'Test Série',
            'voiture[dateMM]' => '2024-11-10',
            'voiture[prixJour]' => 100,
            'voiture[modele]' => $modele->getId()  // Ajout de l'ID du modèle
        ]);
    
        // Soumettre le formulaire
        $client->submit($form);
    
        // Vérifier que la redirection vers la page des voitures est bien effectuée
        $client->followRedirect();
    
        // Vérifier que la page contient le texte attendu (par exemple, "Liste des voitures")
        $this->assertSelectorTextContains('h1', 'Liste des voitures');
    
        // Vérifier que la voiture a bien été ajoutée dans la base de données
        // Cela suppose que vous avez une méthode pour récupérer la voiture par série (ici "Test Série")
        $voitureRepository = self::getContainer()->get('doctrine')->getRepository(Voiture::class);
        $voiture = $voitureRepository->findOneBy(['serie' => 'Test Série']);
        
        $this->assertNotNull($voiture, 'La voiture n\'a pas été ajoutée correctement.');
        $this->assertEquals('Test Série', $voiture->getSerie(), 'La série de la voiture n\'est pas correcte.');
        $this->assertEquals(100, $voiture->getPrixJour(), 'Le prix par jour de la voiture n\'est pas correct.');
        $this->assertEquals($modele->getId(), $voiture->getModele()->getId(), 'Le modèle de la voiture n\'est pas correct.');
    }
    



   /*  public function testSearchVoiture()
    {
        $client = static::createClient();

        // Soumettre une requête de recherche avec la série
        $crawler = $client->request('GET', '/searchVoiture');

        // Soumettre le formulaire de recherche
        $form = $crawler->selectButton('Rechercher')->form([
            'input_serie' => 'Test Série'
        ]);
        $client->submit($form);

        // Vérifier que la recherche a renvoyé des résultats
        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorExists('table.styled-table tbody tr');
    } */

   /*  public function testDeleteVoiture()
    {
        $client = static::createClient();

        // Créer une voiture pour la suppression
        $client->request('GET', '/addVoiture');
        $crawler = $client->request('GET', '/addVoiture');
        $form = $crawler->selectButton('Ajouter')->form([
            'voiture[serie]' => 'Voiture à supprimer',
            'voiture[dateMM]' => '2024-11-01',
            'voiture[prixJour]' => 50
        ]);
        $client->submit($form);
        
        // Récupérer l'id de la voiture ajoutée
        $voitureId = $client->getCrawler()->filter('table.styled-table tbody tr:last-child td:first-child')->text();

        // Supprimer la voiture
        $client->request('GET', '/voiture/' . $voitureId);

        // Vérifier la redirection après suppression
        $this->assertResponseRedirects('/voiture');
    } */

    /* public function testSearchVoitureModele()
    {
        $client = static::createClient();

        // Soumettre une requête de recherche avec le libellé du modèle
        $crawler = $client->request('GET', '/searchVoitureModele');

        // Soumettre le formulaire de recherche
        $form = $crawler->selectButton('Rechercher')->form([
            'input_libelle' => 'Test Modèle'
        ]);
        $client->submit($form);

        // Vérifier que la recherche a renvoyé des résultats
        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorExists('table.styled-table tbody tr');
    } */
}
