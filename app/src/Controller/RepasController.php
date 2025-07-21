<?php

namespace App\Controller;

use App\Entity\Repas;
use App\Entity\Animal;
use App\Form\RepasType;
use App\Repository\AnimalRepository;
use App\Repository\RepasRepository;
use App\Repository\SoinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepasController extends AbstractController
{
    #[Route('/employe/animaux', name: 'employe_dashboard')]
    public function index(AnimalRepository $animalRepository): Response
    {
        $animaux = $animalRepository->findAll(); // Tu peux filtrer par rôle/employé ici
        return $this->render('main/employe/listAnimal.html.twig', [
            'animaux' => $animaux,
        ]);
}

    #[Route('/employe/animal/{id}', name: 'employe_animal_detail')]
    public function show(
        Animal $animal,
        Request $request,
        EntityManagerInterface $em,
        RepasRepository $repasRepository,
        SoinRepository $soinRepository // si tu as une entité Fiche de soin
): Response {
        $repas = new Repas();
        $repas->setAnimal($animal);
        $repas->setUser($this->getUser());
        $repas->setCreatedAt(new \DateTime());

        $form = $this->createForm(RepasType::class, $repas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($repas);
            $em->flush();

            $this->addFlash('success', 'Repas enregistré avec succès');
            return $this->redirectToRoute('employe_animal_detail', ['id' => $animal->getId()]);
}

        $historique = $repasRepository->findBy(['animal' => $animal], ['dateRepas' => 'DESC']);
        $soins = $soinRepository->findBy(['animal' => $animal]); // fiche vétérinaire

        return $this->render('main/employe/animalRepas.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
            'historique' => $historique,
            'soins' => $soins,
        ]);
}
}
