<?php

namespace App\Controller;

use App\Entity\Soin;
use App\Entity\Animal;
use App\Form\SoinType;
use App\Repository\AnimalRepository;
use App\Repository\SoinRepository;
use App\Repository\RepasRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeterinaireController extends AbstractController
{
    #[Route('/vet', name: 'vet_dashboard')]
    public function index(EntityManagerInterface $em): Response
    {
        $animaux = $em->getRepository(Animal::class)->findAll();

        return $this->render('main/vet/listAnimal.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/vet/animal/{id}', name: 'veterinaire_animal')]
    public function showAnimal(
        Animal $animal,
        Request $request,
        EntityManagerInterface $em,
        SoinRepository $soinRepository,
        RepasRepository $repasRepository ): Response {
        $soin = new Soin();
        $soin->setAnimal($animal);
        $soin->setUser($this->getUser());
        $soin->setCreatedAt(new \DateTime());

        $form = $this->createForm(SoinType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($soin);
            $em->flush();

            $this->addFlash('successSoin', 'Soin ajouté avec succès.');
            return $this->redirectToRoute('veterinaire_animal', ['id' => $animal->getId()]);
        }

        // 🔽 Tri direct par ID décroissant
        $soins = $soinRepository->findBy(['animal' => $animal], ['id' => 'DESC']);
        $repas = $repasRepository->findBy(['animal' => $animal], ['id' => 'DESC']);

        return $this->render('main/vet/animalSoin.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
            'soins' => $soins,
            'repas' => $repas,
        ]);
    }
}
