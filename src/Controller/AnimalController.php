<?php


namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalForm;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class AnimalController extends AbstractController
{
    #[Route('/admin/animal/new', name: 'animal_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
    $animal = new Animal();
    $form = $this->createForm(AnimalForm::class, $animal);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move($this->getParameter('habitats'), $newFilename);
            $animal->setImage($newFilename);
        }

        $animal->setCreatedAt(new \DateTime());
        $animal->setUpdatedAt(null);

        $em->persist($animal);
        $em->flush();


        $this->addFlash('success', 'Animal a bien été enregistré.');

        return $this->redirectToRoute('animal_new');
    }

    return $this->render('main/admin/addAnimal.html.twig', [
        'animalForm' => $form->createView(),
    ]);
    }

}
