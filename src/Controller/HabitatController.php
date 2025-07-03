<?php


namespace App\Controller;

use App\Entity\Habitat;
use App\Form\HabitatForm;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class HabitatController extends AbstractController
{
    #[Route('/admin/habitat/new', name: 'habitat_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
    $habitat = new Habitat();
    $form = $this->createForm(HabitatForm::class, $habitat);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $newFilename = uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move($this->getParameter('habitats'), $newFilename);
            $habitat->setImage($newFilename);
        }

        $habitat->setCreatedAt(new \DateTime());
        $habitat->setUpdatedAt(null);

        $em->persist($habitat);
        $em->flush();


        $this->addFlash('success', 'Habitat a bien été enregistré.');

        return $this->redirectToRoute('habitat_new');
    }

    return $this->render('main/admin/addHabitat.html.twig', [
        'habitatForm' => $form->createView(),
    ]);
    }

}
