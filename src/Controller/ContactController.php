<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    // TODO ajouter repository prospect et récuperer les données
    #[Route('/contact', name: 'contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    // TODO ajouter le repository Client et récupérer les données 
    /**
    * @Route("contact/client/", name="contact_client")
    */
    public function client():Response
    {
        return $this->render('contact/client.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    // TODO ajouter le repository OPCO et récupérer les données 
    /**
    * @Route("contact/opco/", name="contact_opco")
    */
    public function opco():Response
    {
        return $this->render('contact/opco.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
