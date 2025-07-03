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
            $imageFile->move($this->getParameter('animals'), $newFilename);
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


    #[Route('/admin/animal', name: 'animal_admin')]
  public function sqlavancee(EntityManagerInterface $em): Response
    {
        $listAnimals = $em->getRepository(Animal::class)->findAll();

        return $this->render('main/admin/animal.html.twig', [
            "animals" => $listAnimals
        ]);
    }

    public function editContact(Request $request, EntityManagerInterface $em, int $paramId)
    {
    // Récupération de l'objet à modifier
    $item = $em->getRepository(Animal::class)->find($paramId);

    if (!$item) {
        throw $this->createNotFoundException('Animal non trouvé');
    }

    // Appeler le formulaire pour remplir l'objet $item
    $form = $this->createForm(AnimalForm::class, $item);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Mise à jour de la BD
        $em->flush();

        // Pour le message de modification
        $this->addFlash('success', 'Contact modifié avec succès');

        // Redirection vers la page des contacts
        return $this->redirectToRoute("animal_admin");
    }

    return $this->render('main/admin/editAnimal.html.twig', [
        'formAdd' => $form,
    ]);
}

    #[Route('/supp/{paramId}', name: 'supp')]
    public function supp(EntityManagerInterface $em, $paramId)
    {
        $contactSupp = $em->getRepository(Animal::class)->find($paramId);
        $em->remove($contactSupp);
        $em->flush();

        return $this->redirectToRoute('contact');

    }

}
