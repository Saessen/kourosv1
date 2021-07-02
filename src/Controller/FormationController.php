<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'formation')]
    // TODO ajouter le repository formation
    public function index(): Response
    {
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
    // TODO ajouter le repository session et récupérer les données 
    /**
    * @Route("formation/sessionCours/", name="formation_sessionCours")
    */
    public function sessionCours():Response
    {
        return $this->render('formation/sessionCours.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
    // TODO ajouter le repository session et récupérer les données 
    /**
    * @Route("formation/sessionVenir/", name="formation_sessionVenir")
    */
    public function sessionVenir():Response
    {
        return $this->render('formation/sessionVenir.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
    // TODO ajouter le repository session et récupérer les données 
    /**
    * @Route("formation/sessionTermine/", name="formation_sessionTermine")
    */
    public function sessionTermine():Response
    {
        return $this->render('formation/sessionTermine.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
}
