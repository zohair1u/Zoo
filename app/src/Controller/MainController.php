<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\User;
use App\Form\UserTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function indexHome(EntityManagerInterface $em): Response
    {

         $listAnimals = $em->getRepository(Animal::class)->findAll();
         $listHabitats = $em->getRepository(Habitat::class)->findAll();

        return $this->render('\main\index.html.twig', [
            "animals" => $listAnimals,
            "habitats" => $listHabitats
        ]);

    }

    #[Route('/admin/users', name: 'users')]
    public function createUser(HttpFoundationRequest $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
    $user = new User();
    $form = $this->createForm(UserTypeForm::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        // Pour transformer le string en tableau mais j'ai réglé le souci sur le UserForm directement :
        // $user->setRoles([$form->get('roles')->getData()]);
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(null);
        $em->persist($user);
        $em->flush();

        $this->addFlash('success', 'Utilisateur créé avec succès.');
        return $this->redirectToRoute('users');
    }

    return $this->render('main/admin/createUser.html.twig', [
        'form' => $form->createView(),
    ]);
    }

    #[Route('/admin', name: 'dashboard')]
    public function indexAdmin(): Response
    {
        return $this->render('main/admin/dashboard.html.twig');
    }

//Redirection vers la pages des habitats : 
    #[Route('/habitats', name: 'habitats')]
    public function indexHabitat(EntityManagerInterface $em): Response
    {

         $listHabitats = $em->getRepository(Habitat::class)->findAll();

        return $this->render('\main\habitat.html.twig', [
            "habitats" => $listHabitats
        ]);

    }

// Redirection vers la page d'un habitat avec les animaux concernés : 

    #[Route('/animals/{id}', name: 'animals')]
    public function indexAnimal(EntityManagerInterface $em, $id): Response
    {
        $habitat = $em->getRepository(Habitat::class)->find($id);

        if (!$habitat) {
            throw $this->createNotFoundException('Habitat non trouvé.');
    }

        $listAnimals = $habitat->getAnimals(); // Accès direct via la relation

        return $this->render('main/animal.html.twig', [
            'animals' => $listAnimals,
            'habitat' => $habitat,
        ]);
    } 

//Redirection en fonction de type de l'utilisateur :
    #[Route('/apres-connexion', name: 'apres_connexion')]
    public function redirectionPostLogin(): Response
    {
        $user = $this->getUser();

        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return $this->redirectToRoute('dashboard');
    }

        if (in_array('ROLE_EMPLOYE', $user->getRoles(), true)) {
            return $this->redirectToRoute('employe_dashboard');
    }

        if (in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            return $this->redirectToRoute('veterinaire_dashboard');
    }

        return $this->redirectToRoute('homepage');
    }
}
