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


    #[Route('/admin/habitat', name: 'habitat_admin')]
  public function sqlavancee(EntityManagerInterface $em): Response
    {
        $listHabitats = $em->getRepository(Habitat::class)->findAll();

        return $this->render('main/admin/habitat.html.twig', [
            "habitats" => $listHabitats
        ]);
    }

    #[Route('/admin/habitat/edit/{paramId}', name: 'edit_habitat')]
    public function editHabitat(Request $request, EntityManagerInterface $em, int $paramId)
    {
    // Récupération de l'objet à modifier
    $item = $em->getRepository(Habitat::class)->find($paramId);

    if (!$item) {
        throw $this->createNotFoundException('Habitat non trouvé');
    }

    // Appeler le formulaire pour remplir l'objet $item
    $form = $this->createForm(HabitatForm::class, $item);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Mise à jour de la BD
        $imageFile = $form->get('image')->getData();

        if ($imageFile) {
               $newFilename = uniqid().'.'.$imageFile->guessExtension();

               $imageFile->move(
                    $this->getParameter('habitats'),
                    $newFilename
                );

        // Met à jour l'entité avec le nouveau nom de fichier
        $item->setImage($newFilename);
        } else {
        // Ne rien faire: on garde l'image existante
        }

        $item->setUpdatedAt(new \DateTime());
        $em->flush();

        // Pour le message de modification
        $this->addFlash('edited', 'Habitat modifié avec succès');

        // Redirection vers la page des contacts
        return $this->redirectToRoute("habitat_admin");
    }

    return $this->render('main/admin/editHabitat.html.twig', [
        'formEdit' => $form->createView(),
    ]);
}





    #[Route('/admin/habitat/supp/{paramId}', name: 'supp_habitat')]
    public function suppHabitat(EntityManagerInterface $em, $paramId)
    {
        $habitatSupp = $em->getRepository(Habitat::class)->find($paramId);
        $em->remove($habitatSupp);
        $em->flush();


        // Pour le message de deleted 
        $this->addFlash('deleted', 'Habitat supprimé avec succès');

        return $this->redirectToRoute('habitat_admin');

    }

}
