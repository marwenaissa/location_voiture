<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Form\ModeleType;
use App\Repository\ModeleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/modele', name: 'app_modele_index')]
    public function index(ModeleRepository $modeleRepository): Response
    {
        return $this->render('modele/index.html.twig', [
            'modeles' => $modeleRepository->findAll(),
        ]);
    }

    #[Route('/modele/new', name: 'app_modele_new')]
    public function new(Request $request): Response
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Utilisation de l'EntityManager injecté
            $this->entityManager->persist($modele);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_modele_index');
        }

        return $this->render('modele/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modele/{id}/edit', name: 'app_modele_edit')]
    public function edit(Request $request, Modele $modele): Response
    {
        $form = $this->createForm(ModeleType::class, $modele);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin d'appeler persist, car l'entité existe déjà
            $this->entityManager->flush();

            return $this->redirectToRoute('app_modele_index');
        }

        return $this->render('modele/edit.html.twig', [
            'form' => $form->createView(),
            'modele' => $modele,
        ]);
    }

    #[Route('/modele/{id}', name: 'app_modele_delete', methods: ['POST'])]
    public function delete(Request $request, Modele $modele): Response
    {
        if ($this->isCsrfTokenValid('delete' . $modele->getId(), $request->request->get('_token'))) {
            // Utilisation de l'EntityManager injecté
            $this->entityManager->remove($modele);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_modele_index');
    }
}
    