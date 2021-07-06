<?php

namespace App\Controller;

use App\Repository\DevisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'gestion')]

     // TODO ajouter le repository devis et récupérer les données 
    public function index(DevisRepository $devisRepository): Response
    {
        return $this->render('gestion/index.html.twig', [
            'controller_name' => 'GestionController',
            'devis'=>$devisRepository->findAll()
        ]);
    }
     // TODO ajouter le repository facture et récupérer les données 
    /**
    * @Route("gestion/facture/", name="gestion_facture")
    */
    public function facture():Response
    {
        return $this->render('gestion/facture.html.twig', [
            'controller_name' => 'GestionController',
        ]);
    }
    // TODO ajouter le repository convention et récupérer les données 
    /**
    * @Route("gestion/convention/", name="gestion_convention")
    */
    public function convention():Response
    {
        return $this->render('gestion/convention.html.twig', [
            'controller_name' => 'GestionController',
        ]);
    }
    // TODO ajouter le repository reglement et récupérer les données 
    /**
    * @Route("gestion/reglement/", name="gestion_reglement")
    */
    public function reglement():Response
    {
        return $this->render('gestion/reglement.html.twig', [
            'controller_name' => 'GestionController',
        ]);
    }
}
