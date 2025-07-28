<?php

namespace App\Controller;

use App\Document\Avis;
use App\Form\AvisType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'avis')]
    public function index(Request $request, DocumentManager $dm): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm->persist($avis);
            $dm->flush();

            $this->addFlash('success', 'Merci pour votre avis!');
            return $this->redirectToRoute('avis');
        }

        $listeAvis = $dm->getRepository(Avis::class)->findAll();
        
        return $this->render('avis/avis.html.twig', [
            'form' => $form->createView(),
            'avis' => $listeAvis,
        ]);
    }
}