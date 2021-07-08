<?php

namespace App\Controller;

use App\Repository\ConventionsRepository;
use App\Repository\DevisRepository;
use App\Repository\FormationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'gestion')]

     // TODO ajouter le repository devis et récupérer les données 
    public function index(DevisRepository $devisRepository, FormationsRepository $formationsRepository): Response
    {
        $formations= $formationsRepository->findAll();
        return $this->render('gestion/index.html.twig', [
            'controller_name' => 'GestionController',
            'devis'=>$devisRepository->findAll(),
            'formations'=>$formations,
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

    /**
    * @Route("gestion/convention/", name="gestion_convention")
    */
    public function convention(ConventionsRepository $conventionsRepository):Response
    {
        return $this->render('gestion/convention.html.twig', [
            'controller_name' => 'GestionController',
            'conventions'=>$conventionsRepository->findAll(),
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
